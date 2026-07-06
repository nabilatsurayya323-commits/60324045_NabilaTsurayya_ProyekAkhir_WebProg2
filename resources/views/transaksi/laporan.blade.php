<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold">
                Laporan Transaksi
            </h2>
        </div>
    </x-slot>

    <div class="container py-4">

        <div class="card mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('transaksi.laporan') }}">

                    <div class="row">

                        <div class="col-md-3">
                            <label>Dari</label>
                            <input type="date"
                                   name="dari"
                                   value="{{ request('dari') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Sampai</label>
                            <input type="date"
                                   name="sampai"
                                   value="{{ request('sampai') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="">Semua</option>

                                <option value="Dipinjam"
                                    {{ request('status')=='Dipinjam'?'selected':'' }}>
                                    Dipinjam
                                </option>

                                <option value="Dikembalikan"
                                    {{ request('status')=='Dikembalikan'?'selected':'' }}>
                                    Dikembalikan
                                </option>

                            </select>

                        </div>

                        <div class="col-md-2">

                            <label>Anggota</label>

                            <select name="anggota_id" class="form-control">

                                <option value="">Semua</option>

                                @foreach($anggotas as $anggota)

                                    <option value="{{ $anggota->id }}"
                                        {{ request('anggota_id')==$anggota->id?'selected':'' }}>

                                        {{ $anggota->nama }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2 d-flex align-items-end">

                            <button class="btn btn-primary w-100">
                                Filter
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>

        <div class="mb-3">

            <a href="{{ route('transaksi.laporan.pdf', request()->query()) }}"
               class="btn btn-danger">
               <i class="bi bi-file-earmark-pdf"></i>
                Export PDF

            </a>

        </div>

        <div class="card">

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Kode</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th>Denda</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($transaksis as $transaksi)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $transaksi->kode_transaksi }}</td>

                            <td>{{ $transaksi->anggota->nama }}</td>

                            <td>{{ $transaksi->buku->judul }}</td>

                            <td>{{ $transaksi->tanggal_pinjam->format('d-m-Y') }}</td>

                            <td>{{ $transaksi->status }}</td>

                            <td>

                                Rp {{ number_format($transaksi->denda,0,',','.') }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center">

                                Tidak ada data

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <hr>

                <h5>Total Transaksi : {{ $totalTransaksi }}</h5>

                <h5>Total Denda : Rp {{ number_format($totalDenda,0,',','.') }}</h5>

            </div>

        </div>

    </div>

</x-app-layout>