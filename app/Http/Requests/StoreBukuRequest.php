<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\KodeBukuFormat;

class StoreBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'kode_buku' => [
            'required',
            'string',
            'max:20',
            'unique:buku,kode_buku', // Jika di phpMyAdmin nama tabelnya 'bukus', ganti jadi 'unique:bukus,kode_buku'
            new KodeBukuFormat(),
        ],
        'judul'        => 'required|string|max:200',
        'kategori'     => 'required|string', // <-- DIUBAH: Hapus aturan 'in:...' agar tipe teks apa pun bisa lolos
        'pengarang'    => 'required|string|max:100',
        'penerbit'     => 'required|string|max:100',
        'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        'isbn'         => 'nullable|string|max:20',
        'harga'        => 'required|numeric|min:0',
        'stok'         => 'required|integer|min:0', // <-- DIUBAH: Hapus fungsi pembatas stok sebelum tahun 2000
        'deskripsi'    => 'nullable|string',
        'bahasa'       => 'required|string|max:20', // <-- DIUBAH: Hapus aturan wajib bahasa Inggris untuk Programming
    ];
}

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'kode_buku.required' => 'Kode buku wajib diisi dan tidak boleh kosong.',
            'kode_buku.unique' => 'Kode buku sudah digunakan di database, silakan buat kode lain.',
            'kode_buku.max' => 'Kode buku tidak boleh lebih dari 20 karakter.',
            
            'judul.required' => 'Judul buku wajib diisi dan tidak boleh kosong.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 200 karakter.',
            
            'kategori.required' => 'Kategori wajib dipilih dan tidak boleh kosong.',
            'kategori.in' => 'Pilihan kategori buku tidak valid.',
            
            'pengarang.required' => 'Nama pengarang wajib diisi dan tidak boleh kosong.',
            'penerbit.required' => 'Nama penerbit wajib diisi dan tidak boleh kosong.',
            
            'tahun_terbit.required' => 'Tahun terbit wajib diisi dan tidak boleh kosong.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa format angka bulat.',
            'tahun_terbit.min' => 'Tahun terbit minimal dimulai dari tahun 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang (' . date('Y') . ').',
            
            'isbn.max' => 'ISBN tidak boleh lebih dari 20 karakter.',
            
            'harga.required' => 'Harga buku wajib diisi dan tidak boleh kosong.',
            'harga.numeric' => 'Harga harus berupa nilai angka.',
            'harga.min' => 'Harga tidak boleh bernilai negatif atau minus.',
            
            'stok.required' => 'Stok wajib diisi dan tidak boleh kosong.',
            'stok.integer' => 'Stok harus berupa nilai angka bulat.',
            'stok.min' => 'Stok tidak boleh bernilai negatif atau minus.',
            
            'bahasa.required' => 'Bahasa buku wajib diisi dan tidak boleh kosong.',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'kode_buku' => 'kode buku',
            'judul' => 'judul buku',
            'kategori' => 'kategori',
            'pengarang' => 'nama pengarang',
            'penerbit' => 'nama penerbit',
            'tahun_terbit' => 'tahun terbit',
            'isbn' => 'ISBN',
            'harga' => 'harga',
            'stok' => 'stok',
            'bahasa' => 'bahasa',
        ];
    }
}