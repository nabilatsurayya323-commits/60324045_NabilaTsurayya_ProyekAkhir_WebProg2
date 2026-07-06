<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'icon',
        'warna'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke model Buku (One to Many)
     * Satu kategori bisa dimiliki oleh banyak data buku sekaligus
     */
    public function bukus()
    {
        // Parameter kedua adalah nama foreign key di tabel buku, parameter ketiga adalah local key di tabel kategori
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }
}