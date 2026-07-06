<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BukuExport implements FromQuery, WithHeadings, WithMapping
{
    protected $kategori;

    public function __construct($kategori = null)
    {
        $this->kategori = $kategori;
    }

    public function query()
    {
        $query = Buku::query();

        if ($this->kategori) {
            $query->where('kategori', $this->kategori);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID Buku',
            'Kode Buku',
            'Judul Buku',
            'Kategori',
            'Pengarang',
            'Stok'
        ];
    }

    public function map($buku): array
    {
        return [
            $buku->id,
            $buku->kode_buku,
            $buku->judul,
            $buku->kategori,
            $buku->pengarang,
            $buku->stok,
        ];
    }
}