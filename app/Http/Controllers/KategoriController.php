<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua data kategori beserta jumlah buku di dalamnya.
     */
    public function index(Request $request)
    {
        // Fitur pencarian kategori dari UI jika diperlukan
        $query = Kategori::withCount('bukus');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori_list = $query->latest()->paginate(10);

        return view('kategori.index', compact('kategori_list'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Simpan data kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
            'deskripsi'     => 'nullable|string',
            'icon'          => 'nullable|string|max:50', // Misal isi: bi-code-slash atau fa-book
            'warna'         => 'nullable|string|max:20', // Misal isi: bg-blue-500 atau #ff0000
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kategori beserta daftar buku yang memiliki kategori ini.
     */
    public function show($id)
    {
        // Mengambil kategori sekalian memuat (Eager Loading) relasi buku-buku di dalamnya
        $kategori = Kategori::with('bukus')->findOrFail($id);
        
        // Memisahkan daftar buku agar konsisten dengan struktur variabel Anda sebelumnya
        $buku_list = $kategori->bukus;

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    /**
     * Tampilkan form untuk mengedit data kategori.
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui data kategori di database.
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string',
            'icon'          => 'nullable|string|max:50',
            'warna'         => 'nullable|string|max:20',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Data kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        // Eksekusi penghapusan
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}