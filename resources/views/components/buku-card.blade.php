<div class="card h-100 shadow-sm">
<div class="card-body">

    <div class="text-center mb-3">
        <i class="bi bi-book text-primary" style="font-size: 4rem;"></i>
    </div>

    {{-- Badge Kategori --}}
    <div class="mb-2">
        <span class="badge bg-info">
            {{ $buku->kategori }}
        </span>
    </div>

    {{-- Judul --}}
    <h5 class="card-title">
        {{ $buku->judul }}
    </h5>

    {{-- Pengarang --}}
    <p class="mb-2">
        <strong>Pengarang:</strong>
        {{ $buku->pengarang }}
    </p>

    {{-- Penerbit --}}
    @if($buku->penerbit)
        <p class="mb-2">
            <strong>Penerbit:</strong>
            {{ $buku->penerbit }}
        </p>
    @endif

    {{-- Tahun Terbit --}}
    @if($buku->tahun_terbit)
        <p class="mb-2">
            <strong>Tahun:</strong>
            {{ $buku->tahun_terbit }}
        </p>
    @endif

    {{-- Harga --}}
    <p class="mb-2">
        <strong>Harga:</strong>
        Rp {{ number_format($buku->harga, 0, ',', '.') }}
    </p>

    {{-- Stok --}}
    <p class="mb-2">
        <strong>Stok:</strong>
        {{ $buku->stok }}
    </p>

    {{-- Status --}}
    <div class="mt-3">
        @if($buku->stok > 0)
            <span class="badge bg-success">
                <i class="bi bi-check-circle"></i>
                Tersedia
            </span>
        @else
            <span class="badge bg-danger">
                <i class="bi bi-x-circle"></i>
                Habis
            </span>
        @endif
    </div>

</div>

@if($showActions)
<div class="card-footer d-flex gap-2">

    <a href="{{ route('buku.show', $buku->id) }}"
       class="btn btn-info btn-sm text-white flex-fill">
        <i class="bi bi-eye"></i>
        Detail
    </a>
</div>
@endif

</div>