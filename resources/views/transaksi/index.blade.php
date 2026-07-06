<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <i class="bi bi-arrow-left-right text-indigo-600"></i>
                    Daftar Transaksi Peminjaman
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh transaksi peminjaman dan pengembalian buku
                </p>
            </div>

            <div class="flex items-center gap-2">
    <a href="{{ route('transaksi.export-pdf') }}"
        class="inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition gap-2 shadow-sm">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>

    <a href="{{ route('transaksi.create') }}"
        class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition gap-2 shadow-sm">
        <i class="bi bi-plus-circle"></i> Pinjam Buku
    </a>
</div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $transaksis->count() }}</h2>
                        </div>
                        <i class="bi bi-arrow-left-right text-blue-500" style="font-size:3rem;"></i>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg mb-4">
    <div class="p-4 flex flex-wrap items-center gap-3">

        <form action="{{ route('transaksi.index') }}" method="GET" class="flex items-center gap-2">

            <select name="kategori" class="border-gray-300 rounded-md shadow-sm">
                <option value="">Semua Kategori</option>
                
                @foreach($kategori_list as $kategori)
                <option value="{{ $kategori->nama_kategori }}"
                {{ request('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>

            <button
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Filter
            </button>

            @if(request('kategori'))
                <a href="{{ route('transaksi.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md">
                    Reset
                </a>
            @endif

        </form>

    </div>
</div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-amber-500 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Sedang Dipinjam</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">
                                {{ $transaksis->where('status','Dipinjam')->count() }}
                            </h2>
                        </div>
                        <i class="bi bi-book-half text-amber-500" style="font-size:3rem;"></i>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Sudah Dikembalikan</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">
                                {{ $transaksis->where('status','Dikembalikan')->count() }}
                            </h2>
                        </div>
                        <i class="bi bi-check-circle-fill text-green-500" style="font-size:3rem;"></i>
                    </div>
                </div>
            </div>

            {{-- Tabel Transaksi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h5 class="text-md font-semibold text-gray-700 flex items-center gap-2">
                        <i class="bi bi-table text-indigo-600"></i>
                        Data Transaksi
                    </h5>
                </div>

                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 align-middle">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($transaksis as $transaksi)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-indigo-600 bg-indigo-50 rounded px-1.5 inline-block my-2">
                                            {{ $transaksi->kode_transaksi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $transaksi->anggota->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $transaksi->buku->judul }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $transaksi->tanggal_pinjam->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $transaksi->tanggal_kembali->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{-- MODIFIKASI: Hitung selisih keterlambatan secara dinamis dengan Carbon --}}
                                            @if($transaksi->status == 'Dipinjam' && \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast())
                                                @php
                                                    $hariTerlambat = \Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(now());
                                                @endphp
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 animate-pulse">
                                                    <i class="bi bi-exclamation-triangle mr-1"></i> Terlambat {{ $hariTerlambat }} Hari
                                                </span>
                                            @elseif($transaksi->status == 'Dipinjam')
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                    <i class="bi bi-clock mr-1"></i> Dipinjam
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <i class="bi bi-check-circle mr-1"></i> Dikembalikan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
                                            <div class="inline-flex rounded-md shadow-sm gap-1">
                                                {{-- Tombol Detail --}}
                                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs transition" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                {{-- Tombol Kembalikan --}}
                                                @if($transaksi->status == 'Dipinjam')
                                                    <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 text-xs transition" onclick="return confirm('Yakin buku dikembalikan?')">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <i class="bi bi-inbox text-3xl text-gray-300"></i>
                                                <span>Belum ada transaksi peminjaman.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>