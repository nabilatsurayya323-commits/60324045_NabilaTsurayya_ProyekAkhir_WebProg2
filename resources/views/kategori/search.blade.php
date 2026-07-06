@extends('layouts.app')

@section('content')

<h2>
    Hasil Pencarian:
    <span class="text-danger">{{ $keyword }}</span>
</h2>

<div class="row mt-4">

    @forelse($kategori_list as $kategori)

    <div class="col-md-4 mb-4">

        <div class="card">

            <div class="card-body">

                <h4>
                    {!! str_ireplace(
                        $keyword,
                        '<mark>'.$keyword.'</mark>',
                        $kategori['nama']
                    ) !!}
                </h4>

                <p>{{ $kategori['deskripsi'] }}</p>

                <span class="badge bg-success">
                    {{ $kategori['jumlah_buku'] }} Buku
                </span>

            </div>

        </div>

    </div>

    @empty

    <div class="alert alert-danger">
        Data kategori tidak ditemukan.
    </div>

    @endforelse

</div>

@endsection