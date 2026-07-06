<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencarian Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Hasil Pencarian Untuk</p>
                <h1 class="text-3xl font-bold text-gray-900 mt-1">“{{ $keyword }}”</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-emerald-600 px-5 py-4 text-white flex justify-between items-center">
                        <div class="flex items-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.746 18.477 18.154 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span>Katalog Buku</span>
                        </div>
                        <span class="bg-emerald-700 text-xs px-2.5 py-1 rounded-full font-bold">{{ $results['buku']->count() }}</span>
                    </div>
                    
                    <div class="p-5 divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                        @if($results['buku']->isEmpty())
                            <div class="text-center py-8 text-gray-400">
                                <p class="text-sm">Tidak ada buku ditemukan</p>
                            </div>
                        @else
                            @foreach($results['buku'] as $buku)
                                <div class="py-3 first:pt-0 last:pb-0">
                                    <h4 class="font-semibold text-gray-800 text-sm hover:text-emerald-600 transition-colors cursor-pointer">{{ $buku->judul }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">Penulis: <span class="font-medium text-gray-700">{{ $buku->penulis ?? 'Tidak ada' }}</span></p>
                                    <p class="text-[11px] text-gray-400 font-mono mt-0.5">ISBN: {{ $buku->isbn ?? '-' }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-blue-600 px-5 py-4 text-white flex justify-between items-center">
                        <div class="flex items-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span>Data Anggota</span>
                        </div>
                        <span class="bg-blue-700 text-xs px-2.5 py-1 rounded-full font-bold">{{ $results['anggota']->count() }}</span>
                    </div>
                    
                    <div class="p-5 divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                        @if($results['anggota']->isEmpty())
                            <div class="text-center py-8 text-gray-400">
                                <p class="text-sm">Tidak ada anggota ditemukan</p>
                            </div>
                        @else
                            @foreach($results['anggota'] as $anggota)
                                <div class="py-3 flex items-center gap-3 first:pt-0 last:pb-0">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xs uppercase">
                                        {{ substr($anggota->nama, 0, 2) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $anggota->nama }}</h4>
                                        <p class="text-xs text-gray-500 truncate">{{ $anggota->email }}</p>
                                        <p class="text-[10px] bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded inline-block font-mono mt-1">ID: {{ $anggota->kode_anggota ?? $anggota->nim }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-amber-500 px-5 py-4 text-white flex justify-between items-center">
                        <div class="flex items-center gap-2 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            <span>Log Transaksi</span>
                        </div>
                        <span class="bg-amber-600 text-xs px-2.5 py-1 rounded-full font-bold">{{ $results['transaksi']->count() }}</span>
                    </div>
                    
                    <div class="p-5 divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                        @if($results['transaksi']->isEmpty())
                            <div class="text-center py-8 text-gray-400">
                                <p class="text-sm">Tidak ada transaksi ditemukan</p>
                            </div>
                        @else
                            @foreach($results['transaksi'] as $transaksi)
                                <div class="py-3 first:pt-0 last:pb-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="font-mono text-xs font-bold text-amber-600">{{ $transaksi->kode_transaksi }}</span>
                                        <span class="text-[10px] px-2 py-0.5 rounded-full {{ $transaksi->status == 'Kembali' ? 'bg-green-100 text-green-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $transaksi->status ?? 'Dipinjam' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-700 font-medium">Peminjam: <span class="text-gray-900">{{ $transaksi->anggota->nama ?? 'N/A' }}</span></p>
                                    <p class="text-xs text-gray-500 truncate">Buku: {{ $transaksi->buku->judul ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>