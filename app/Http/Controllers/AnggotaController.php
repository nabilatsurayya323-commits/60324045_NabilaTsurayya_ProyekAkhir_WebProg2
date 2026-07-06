<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // PERBAIKAN: Menggunakan paginate() menggantikan get()
        $anggotas = Anggota::latest()->paginate(10);

        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }

    public function search(Request $request)
    {
        $query = Anggota::query();

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('telepon', 'like', '%' . $request->keyword . '%')
                    ->orWhere('kode_anggota', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->kode_anggota) {
            $query->where('kode_anggota', 'like', '%' . $request->kode_anggota . '%');
        }

        // PERBAIKAN: Hitung statistik TOTAL sebelum data di-paginate
        $totalAnggota = $query->count();
        $anggotaAktif = (clone $query)->where('status', 'Aktif')->count();
        $anggotaNonaktif = (clone $query)->where('status', 'Nonaktif')->count();

        // PERBAIKAN: Menggunakan paginate() menggantikan get() untuk hasil pencarian
        $anggotas = $query->latest()->paginate(10);

        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.show', compact('anggota'));
    }

    public function create()
{
    // 1. Ambil tahun saat ini (misal: 2026)
    $tahun = date('Y'); 
    $prefix = "AGT-" . $tahun . "-";

    // 2. Cari kode terakhir di database yang mirip dengan 'AGT-2026-'
    $anggotaTerakhir = \App\Models\Anggota::where('kode_anggota', 'LIKE', $prefix . '%')
                        ->orderBy('kode_anggota', 'DESC')
                        ->first();

    if ($anggotaTerakhir) {
        // Jika ketemu, ambil 3 digit terakhir (misal dari 'AGT-2026-002' diambil '002')
        $nomorTerakhir = substr($anggotaTerakhir->kode_anggota, -3);
        // Ubah jadi angka, lalu tambahkan 1 (002 + 1 = 3)
        $nomorBaru = (int)$nomorTerakhir + 1;
    } else {
        // Jika belum ada anggota sama sekali di tahun ini, mulai dari 1
        $nomorBaru = 1;
    }

    // 3. Format kembali angka menjadi 3 digit (misal: 3 jadi '003')
    $kodeAnggota = $prefix . str_pad($nomorBaru, 3, '0', STR_PAD_LEFT);

    // 4. Lempar variabel $kodeAnggota ke halaman view
    return view('anggota.create', compact('kodeAnggota'));
}

    public function store(StoreAnggotaRequest $request)
{
    // Kita matikan try-catch agar Laravel memuntahkan halaman eror merah kalau gagal
    Anggota::create($request->validated());

    return redirect()->route('anggota.index')
        ->with('success', 'Anggota berhasil ditambahkan!');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggotaRequest $request, string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);

            $anggota->update($request->validated());

            return redirect()
                ->route('anggota.show', $anggota->id)
                ->with('success', 'Data anggota berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate anggota: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $namaAnggota = $anggota->nama;

            $anggota->delete();

            return redirect()
                ->route('anggota.index')
                ->with('success', "Anggota '{$namaAnggota}' berhasil dihapus!");

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }

    /**
     * Generate kode anggota otomatis.
     */
    private function generateKodeAnggota()
    {
        $tahun = date('Y');

        $lastAnggota = Anggota::whereYear('created_at', $tahun)
            ->orderBy('kode_anggota', 'desc')
            ->first();

        if ($lastAnggota) {
            $lastNumber = intval(substr($lastAnggota->kode_anggota, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'AGT-' . $tahun . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
    
    public function exportExcel(Request $request)
{
    // 1. Inisialisasi Query dasar dari tabel Anggota
    $query = Anggota::query();

    // 2. Jalankan penyaringan otomatis jika input form diisi oleh user
    
    // Filter berdasarkan Kata Kunci (Nama, Email, atau Nomor Telepon)
    if ($request->filled('q')) {
        $keyword = $request->input('q');
        $query->where(function($w) use ($keyword) {
            $w->where('nama', 'LIKE', "%{$keyword}%")
              ->orWhere('email', 'LIKE', "%{$keyword}%")
              ->orWhere('telepon', 'LIKE', "%{$keyword}%");
        });
    }

    // Filter berdasarkan Jenis Kelamin
    if ($request->filled('jenis_kelamin')) {
        $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
    }

    // Filter berdasarkan Status (Aktif / Nonaktif)
    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    // Filter berdasarkan Input Kode Anggota
    if ($request->filled('kode_anggota')) {
        $query->where('kode_anggota', 'LIKE', "%{$request->input('kode_anggota')}%");
    }

    // 3. Eksekusi query untuk mengambil data hasil filter ke database
    $dataAnggota = $query->get();

    // 4. Siapkan format file spreadsheet (.csv yang support langsung ke MS Excel)
    $fileName = 'daftar_anggota_export_' . date('Y-m-d_H-i-s') . '.csv';

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Susunan nama kolom header di Excel nanti
    $columns = ['Kode Anggota', 'Nama Lengkap', 'Email', 'Telepon', 'Jenis Kelamin', 'Status', 'Pekerjaan'];

    // 5. Proses streaming data langsung menjadi file unduhan tanpa membebani memori server
    $callback = function() use($dataAnggota, $columns) {
        $file = fopen('php://output', 'w');
        
        // Agar Excel membaca karakter spesial/bahasa Indonesia dengan benar (BOM)
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        
        fputcsv($file, $columns); // Menulis baris header utama

        foreach ($dataAnggota as $anggota) {
            fputcsv($file, [
                $anggota->kode_anggota ?? '-',
                $anggota->nama,
                $anggota->email,
                $anggota->telepon ?? '-',
                $anggota->jenis_kelamin ?? '-',
                $anggota->status ?? '-',
                $anggota->pekerjaan ?? '-'
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}