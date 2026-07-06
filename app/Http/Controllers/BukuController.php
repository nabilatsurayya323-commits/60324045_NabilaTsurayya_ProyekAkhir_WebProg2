<?php

namespace App\Http\Controllers;

use App\Exports\BukuExport;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Teks daftar kategori statis sebagai acuan komponen di View
     */
    private function getKategoriList()
    {
        return ['Programming', 'Database', 'Web Design', 'Networking', 'Data Science'];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::latest()->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();
        $kategori_list = $this->getKategoriList(); 

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori_list'
        ));
    }

    public function create()
    {
        $kategori_list = $this->getKategoriList();
        return view('buku.create', compact('kategori_list'));
    }

    public function store(StoreBukuRequest $request)
    {
        Buku::create($request->validated());

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategori_list = $this->getKategoriList();

        return view('buku.edit', compact('buku', 'kategori_list'));
    }

    public function update(UpdateBukuRequest $request, string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->update($request->validated());

            return redirect()->route('buku.show', $buku->id)
                ->with('success', 'Buku berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate buku: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $judulBuku = $buku->judul;
            $buku->delete();

            return redirect()->route('buku.index')
                ->with('success', "Buku '{$judulBuku}' berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }

    /**
     * Filter buku berdasarkan nama Teks Kategori
     */
    public function filterKategori($kategoriNama)
    {
        $bukus = Buku::where('kategori', $kategoriNama)
            ->latest()
            ->get();

        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();
        $kategori_list = $this->getKategoriList();

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori_list',
            'kategoriNama'
        ));
    }

    /**
     * Search & Filter Buku Advanced
     */
    public function search(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                    ->orWhere('pengarang', 'like', '%' . $request->keyword . '%')
                    ->orWhere('penerbit', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        if ($request->status === 'tersedia') {
            $query->where('stok', '>', 0);
        }

        if ($request->status === 'habis') {
            $query->where('stok', 0);
        }

        $bukus = $query->latest()->get();

        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', 0)->count();
        $kategori_list = $this->getKategoriList();

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori_list'
        ));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->buku_ids;

        if (!$ids) {
            return redirect()->route('buku.index')
                ->with('error', 'Pilih minimal satu buku.');
        }

        Buku::whereIn('id', $ids)->delete();

        return redirect()->route('buku.index')
            ->with('success', count($ids) . ' buku berhasil dihapus!');
    }

    /**
     * Export data ke Excel berdasarkan nama string Kategori
     */
    public function export(Request $request)
    {
        $kategoriTerpilih = $request->query('kategori');

        if ($kategoriTerpilih) {
            $fileName = 'daftar_buku_' . Str::slug($kategoriTerpilih) . '_' . date('Y-m-d') . '.xlsx';
        } else {
            $fileName = 'daftar_buku_semua_' . date('Y-m-d') . '.xlsx';
        }

        return Excel::download(new BukuExport($kategoriTerpilih), $fileName);
    }
}