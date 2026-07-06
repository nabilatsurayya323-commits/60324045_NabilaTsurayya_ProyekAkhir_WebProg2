<?php
 
namespace App\Http\Controllers;
 
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Carbon\Carbon;
 
class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik utama (Jumlah terlambat sudah terhitung di sini lewat $stats['terlambat'])
        $stats = [
            'total_buku'         => Buku::count(),
            'total_anggota'      => Anggota::where('status', 'Aktif')->count(),
            'total_transaksi'    => Transaksi::count(),
            'sedang_dipinjam'    => Transaksi::where('status', 'Dipinjam')->count(),
            'terlambat'          => Transaksi::where('status', 'Dipinjam')
                                            ->where('tanggal_kembali', '<', now())->count(),
            'denda_bulan_ini'    => Transaksi::whereMonth('tanggal_dikembalikan', now()->month)
                                            ->sum('denda'),
            'transaksi_hari_ini'=> Transaksi::whereDate('tanggal_pinjam', today())->count(),
            'buku_tersedia'      => Buku::where('stok', '>', 0)->count(),
        ];
 
        // 2. Data chart: transaksi 6 bulan terakhir
        $chartData = collect(range(5, 0))->map(function ($i) {
            $date = now()->subMonths($i);
            return [
                'bulan' => $date->translatedFormat('M Y'),
                'pinjam' => Transaksi::whereMonth('tanggal_pinjam', $date->month)
                                     ->whereYear('tanggal_pinjam', $date->year)->count(),
                'kembali' => Transaksi::whereMonth('tanggal_dikembalikan', $date->month)
                                      ->whereYear('tanggal_dikembalikan', $date->year)->count(),
            ];
        });
 
        // 3. Top 5 buku populer
        $bukuPopuler = Buku::withCount('transaksis')
                           ->orderByDesc('transaksis_count')
                           ->take(5)->get();
 
        // 4. Top 5 anggota aktif
        $anggotaAktif = Anggota::withCount('transaksis')
                               ->orderByDesc('transaksis_count')
                               ->take(5)->get();
 
        // 5. Transaksi terbaru
        $recentTransaksi = Transaksi::with(['anggota', 'buku'])
                                    ->latest()->take(5)->get();

        // 6. List data anggota & buku yang terlambat untuk widget tabel
        $transaksiTerlambat = Transaksi::with(['anggota', 'buku'])
                                    ->where('status', 'Dipinjam')
                                    ->where('tanggal_kembali', '<', now())
                                    ->latest()
                                    ->get();
 
        // Kirim semua data ke dashboard view
        return view('dashboard', compact(
            'stats', 
            'chartData', 
            'bukuPopuler',
            'anggotaAktif', 
            'recentTransaksi', 
            'transaksiTerlambat'
        ));
    }
}