<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Breadcrumb --}}
            <nav class="flex text-sm text-gray-600 bg-gray-50 px-4 py-3 rounded-lg border border-gray-200" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center hover:text-indigo-600 transition">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <span class="mx-2 text-gray-400">/</span>
                            <a href="{{ route('buku.index') }}" class="hover:text-indigo-600 transition">Buku</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <span class="mx-2 text-gray-400">/</span>
                            <span class="text-gray-400 truncate max-w-xs md:max-w-md">{{ $buku->judul }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            {{-- Grid Utama --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Kolom Kiri: Info Buku (Mengambil 2/3 space pada desktop) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="bg-indigo-600 text-white px-6 py-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <h5 class="font-semibold text-lg">Detail Buku</h5>
                        </div>

                        <div class="p-6 space-y-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 leading-tight mb-3">{{ $buku->judul }}</h2>
                                
                                {{-- Badge Kategori --}}
                                @php
                                    $badgeColors = [
                                        'Programming' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'Database' => 'bg-green-100 text-green-800 border-green-200',
                                        'Web Design' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
                                        'Networking' => 'bg-amber-100 text-amber-800 border-amber-200',
                                    ];
                                    $currentStyle = $badgeColors[$buku->kategori] ?? 'bg-red-100 text-red-800 border-red-200';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium border {{ $currentStyle }}">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    {{ $buku->kategori }}
                                </span>
                            </div>
                            
                            {{-- Informasi Detail Table --}}
                            <div class="border-t border-gray-100 pt-4">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Kode Buku</dt>
                                        <dd class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded inline-block border border-gray-100">{{ $buku->kode_buku }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Pengarang</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $buku->pengarang }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $buku->penerbit }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $buku->tahun_terbit }}</dd>
                                    </div>
                                    @if ($buku->isbn)
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                            <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $buku->isbn }}</dd>
                                        </div>
                                    @endif
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Bahasa</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $buku->bahasa }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Harga</dt>
                                        <dd class="mt-1 text-base font-semibold text-emerald-600">{{ $buku->harga_format }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Ketersediaan Stok</dt>
                                        <dd class="mt-1 text-sm text-gray-900 flex items-center gap-2">
                                            <span class="font-bold">{{ $buku->stok }}</span> buku
                                            @if ($buku->stok > 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Tersedia</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Habis</span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                            
                            {{-- Deskripsi --}}
                            <div class="border-t border-gray-100 pt-4">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Deskripsi</h4>
                                @if ($buku->deskripsi)
                                    <p class="text-sm text-gray-600 leading-relaxed text-justify">{{ $buku->deskripsi }}</p>
                                @else
                                    <p class="text-sm text-gray-400 italic flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.063 1.06l-.041.02-.01.008a3 3 0 0 1-4.077-4.077l.008-.01a.75.75 0 0 1 1.06.041l.02.041a1.5 1.5 0 0 0 2.372 1.737l.02.041Zm-.02 2.75-.041.02a.75.75 0 1 0 1.063-1.06l-.041-.02-.01-.008a3 3 0 0 0-4.077 4.077l.008.01a.75.75 0 0 0 1.06-.041l.02-.041a1.5 1.5 0 0 1 2.372-1.737l.02-.041ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Tidak ada deskripsi untuk buku ini
                                    </p>
                                @endif
                            </div>
                            
                            {{-- Timestamps Log --}}
                            <div class="border-t border-gray-100 pt-4 flex flex-col sm:flex-row justify-between text-xs text-gray-400 gap-2">
                                <div>Ditambahkan: <span class="text-gray-500 font-medium">{{ $buku->created_at->format('d M Y H:i') }}</span></div>
                                <div>Terakhir diupdate: <span class="text-gray-500 font-medium">{{ $buku->updated_at->format('d M Y H:i') }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Kolom Kanan: Actions & Status (Mengambil 1/3 space pada desktop) --}}
                <div class="space-y-4">
                    
                    {{-- Card Actions --}}
                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 border-b border-gray-200 px-4 py-3">
                            <h6 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.827m11.379-8.16l1.15-.827M8.14 21.27l.707-1.03m7.45-.808l.707-1.03M12 3v1.5m0 15V21m4.743-10l-1.149-.827M7.406 15.215l-1.149-.827m9.605-7.248l-1.41.513M8.138 15.345l-1.41.513M9.543 18.215l-.707 1.03m7.451-8.106l-.707 1.03" />
                                </svg>
                                Panel Kendali
                            </h6>
                        </div>
                        <div class="p-4 space-y-2">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md font-medium text-sm shadow transition duration-150">
                                Edit Informasi Buku
                            </a>
                            
                            @if ($buku->stok > 0)
                                <button class="w-full inline-flex justify-center items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium text-sm shadow transition duration-150">
                                    Ajukan Pinjam Buku
                                </button>
                            @else
                                <button class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-200 text-gray-400 rounded-md font-medium text-sm cursor-not-allowed" disabled>
                                    Stok Buku Habis
                                </button>
                            @endif
                            
                            <a href="{{ route('buku.index') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-md font-medium text-sm shadow-sm transition duration-150">
                                Kembali ke Daftar
                            </a>
                            
                            <div class="pt-2 border-t border-gray-100">
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 rounded-md font-medium text-sm transition duration-150">
                                        Hapus Buku
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Card Alerter Status Stok --}}
                    @if ($buku->stok == 0)
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-800 flex gap-2">
                            <span class="font-semibold">Stok Habis!</span> Buku ini sedang tidak dapat dipinjam oleh member.
                        </div>
                    @elseif ($buku->stok <= 5)
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-sm text-amber-800 flex gap-2">
                            <span class="font-semibold">Stok Kritis!</span> Hanya tersisa {{ $buku->stok }} buku di rak penyimpanan.
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-sm text-green-800 flex gap-2">
                            <span class="font-semibold">Stok Aman!</span> Buku siap didistribusikan untuk transaksi pinjam.
                        </div>
                    @endif
                    
                    {{-- Card Buku Serupa --}}
                    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">
                        <div class="bg-gray-800 text-white px-4 py-2.5">
                            <h6 class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                Rekomendasi Buku Sejenis
                            </h6>
                        </div>
                        <div class="p-4 space-y-4">
                            @php
                                $bukuSerupa = App\Models\Buku::where('kategori', $buku->kategori)
                                              ->where('id', '!=', $buku->id)
                                              ->take(3)
                                              ->get();
                            @endphp
                            
                            @forelse ($bukuSerupa as $item)
                                <div class="group">
                                    <a href="{{ route('buku.show', $item->id) }}" class="block">
                                        <h6 class="text-sm font-semibold text-indigo-600 group-hover:text-indigo-800 transition line-clamp-1 mb-0.5">{{ $item->judul }}</h6>
                                    </a>
                                    <span class="text-xs text-gray-500">{{ $item->pengarang }}</span>
                                </div>
                                @if (!$loop->last)
                                    <div class="border-t border-gray-100 my-2"></div>
                                @endif
                            @empty
                                <p class="text-xs text-gray-400 italic">Tidak ada buku penunjang lain dengan kategori ini.</p>
                            @endforelse
                        </div>
                    </div>

                </div> {{-- End Kolom Kanan --}}
            </div> {{-- End Grid Utama --}}

        </div>
    </div>
</x-app-layout>