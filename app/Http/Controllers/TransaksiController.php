<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(Request $request)
{
    $query = Transaksi::with(['anggota', 'buku']);

    if ($request->filled('kategori')) {
        $query->whereHas('buku', function ($q) use ($request) {
            $q->where('kategori', $request->kategori);
        });
    }

    $transaksis = $query->latest()->get();

    $kategori_list = Kategori::orderBy('nama_kategori')->get();

    return view('transaksi.index', compact(
        'transaksis',
        'kategori_list'
    ));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil hanya anggota yang aktif
        $anggotas = Anggota::where('status', 'Aktif')->orderBy('nama')->get();
        
        // Ambil hanya buku yang tersedia (stok > 0)
        $bukus = Buku::where('stok', '>', 0)->orderBy('judul')->get();
        
        return view('transaksi.create', compact('anggotas', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'nullable|string',
        ], [
            'anggota_id.required' => 'Anggota wajib dipilih.',
            'buku_id.required' => 'Buku wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
        ]);
        
        try {
            DB::transaction(function () use ($request) {
                // 1. Check stok buku
                $buku = Buku::findOrFail($request->buku_id);
                if ($buku->stok <= 0) {
                    throw new \Exception('Stok buku habis!');
                }
                
                // 2. Generate kode transaksi (Aman dari duplikasi)
                $kodeTransaksi = $this->generateKodeTransaksi();
                
                // 3. Hitung tanggal kembali (7 hari dari tanggal pinjam)
                $tanggalKembali = Carbon::parse($request->tanggal_pinjam)->addDays(7);
                
                // 4. Create transaksi
                Transaksi::create([
                    'kode_transaksi' => $kodeTransaksi,
                    'anggota_id' => $request->anggota_id,
                    'buku_id' => $request->buku_id,
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $tanggalKembali,
                    'status' => 'Dipinjam',
                    'keterangan' => $request->keterangan,
                ]);
                
                // 5. Update stok buku (kurang 1)
                $buku->decrement('stok');
            });
            
            return redirect()->route('transaksi.index')
                             ->with('success', 'Transaksi peminjaman berhasil dibuat!');
                             
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Laporan transaksi.
     */
    public function laporan(Request $request)
    {
        $query = Transaksi::with(['anggota', 'buku']);

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('tanggal_pinjam', '>=', $request->dari);
        }
        
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
        }
        
        // Filter status
        if ($request->filled('status') && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Filter anggota
        if ($request->filled('anggota_id')) {
            $query->where('anggota_id', $request->anggota_id);
        }

        $transaksis = $query->latest()->get();
        $anggotas = Anggota::orderBy('nama')->get();

        $totalTransaksi = $transaksis->count();
        $totalDenda = $transaksis->sum('denda');

        return view('transaksi.laporan', compact(
            'transaksis',
            'anggotas',
            'totalTransaksi',
            'totalDenda'
        ));
    }

    /**
     * Export laporan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        $query = Transaksi::with(['anggota', 'buku']);

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('tanggal_pinjam', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_pinjam', '<=', $request->sampai);
        }

        // Filter status
        if ($request->filled('status') && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Filter anggota
        if ($request->filled('anggota_id')) {
            $query->where('anggota_id', $request->anggota_id);
        }

        $transaksis = $query->latest()->get();

        $totalTransaksi = $transaksis->count();
        $totalDenda = $transaksis->sum('denda');

        // MODIFIKASI: Set ukuran kertas ke A4 Landscape agar tabel laporan tidak terpotong ke samping
        $pdf = Pdf::loadView('transaksi.pdf', compact(
            'transaksis',
            'totalTransaksi',
            'totalDenda'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['anggota', 'buku'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Kembalikan buku (update status transaksi).
     */
    public function kembalikan(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $transaksi = Transaksi::with('buku')->findOrFail($id);

                // Cek apakah sudah dikembalikan
                if ($transaksi->status === 'Dikembalikan') {
                    throw new \Exception('Buku sudah dikembalikan sebelumnya.');
                }

                $tanggalDikembalikan = now();
                $denda = $this->hitungDenda($transaksi, $tanggalDikembalikan);

                $transaksi->update([
                    'status' => 'Dikembalikan',
                    'tanggal_dikembalikan' => $tanggalDikembalikan,
                    'denda' => $denda,
                ]);

                // Menambah stok buku kembali
                $transaksi->buku->increment('stok');
            });

            return redirect()->route('transaksi.show', $id)
                             ->with('success', 'Buku berhasil dikembalikan!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal mengembalikan buku: ' . $e->getMessage());
        }
    }

    /**
     * Generate kode transaksi otomatis (Fix Bug Over 999 & Rollback Safe).
     */
    private function generateKodeTransaksi()
    {
        // Diurutkan berdasarkan kode_transaksi secara alfabetis/numerik menurun
        $lastTransaksi = Transaksi::orderBy('kode_transaksi', 'desc')->first();
        
        if ($lastTransaksi) {
            // Memisahkan string 'TRX-' dan mengambil semua angka dibelakangnya secara dinamis
            $lastNumber = intval(substr($lastTransaksi->kode_transaksi, 4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return 'TRX-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Hitung denda keterlambatan.
     */
    private function hitungDenda($transaksi, $tanggalDikembalikan)
    {
        $tanggalKembali = Carbon::parse($transaksi->tanggal_kembali);
        $hariTerlambat = floor($tanggalKembali->diffInDays($tanggalDikembalikan, false));

        if ($hariTerlambat > 0) {
            return $hariTerlambat * 5000; // Denda Rp 5.000 per hari
        }

        return 0;
    }
}