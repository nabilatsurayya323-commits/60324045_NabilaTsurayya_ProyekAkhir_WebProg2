<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'kategori', 
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }

    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        }
        return '<span class="badge bg-success">Aman</span>';
    }

    public function getTahunLabelAttribute(): string
    {
        $batasTahunBaru = date('Y') - 2;
        return $this->tahun_terbit >= $batasTahunBaru ? 'Buku Baru' : 'Buku Lama';
    }

    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }

    public function scopeFilterKategoriNama($query, $kategori = null)
    {
        if ($kategori) {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }

    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', date('Y') - 2);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'buku_id', 'id');
    }
}