@extends('layouts.app')

@section('content')

<h2 class="mb-4">Daftar Kategori Buku</h2>

<div class="row">

    @foreach($kategori_list as $kategori)

    <div class="col-md-4 mb-4">

        <div class="card h-100 shadow-sm">

            <div class="card-body">

                <h4>{{ $kategori['nama'] }}</h4>

                <p>{{ $kategori['deskripsi'] }}</p>

                <span class="badge bg-primary">
                    {{ $kategori['jumlah_buku'] }} Buku
                </span>

                <div class="mt-3">
                    <a href="{{ route('kategori.show', $kategori['id']) }}"
                       class="btn btn-success btn-sm">
                        Detail
                    </a>
                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection