<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <nav class="flex mb-5 px-4 sm:px-0" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-gray-500">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-700 transition">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('anggota.index') }}" class="ml-1 hover:text-gray-700 transition">Anggota</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-gray-400 font-semibold">{{ $anggota->kode_anggota }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                
                <div class="p-6 bg-gray-50/70 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row items-center text-center sm:text-left gap-5">
                        
                        <div class="flex-shrink-0">
                            @if($anggota->jenis_kelamin == 'Laki-laki')
                                <div class="p-4 rounded-full bg-blue-50 text-blue-600 shadow-inner">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @else
                                <div class="p-4 rounded-full bg-rose-50 text-rose-600 shadow-inner">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2 justify-center sm:justify-start">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $anggota->nama }}</h3>
                                <span class="inline-block px-2.5 py-0.5 bg-gray-200 text-gray-700 font-mono text-xs rounded border border-gray-300 self-center">
                                    {{ $anggota->kode_anggota }}
                                </span>
                            </div>

                            <div class="flex flex-wrap justify-content-center sm:justify-start gap-2">
                                @if($anggota->status == 'Aktif')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-2 h-2 mr-1.5 bg-emerald-500 rounded-full"></span>
                                        Anggota Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                        <span class="w-2 h-2 mr-1.5 bg-gray-400 rounded-full"></span>
                                        Nonaktif
                                    </span>
                                @endif

                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    Bergabung {{ $anggota->lama_anggota }} Hari
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 text-gray-900">
                    <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Informasi Personal</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Alamat Email</span>
                                <span class="text-sm font-semibold text-gray-800 break-all">{{ $anggota->email }}</span>
                            </div>
                        </div>

                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Nomor Telepon</span>
                                <span class="text-sm font-semibold text-gray-800">{{ $anggota->telepon }}</span>
                            </div>
                        </div>

                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Jenis Kelamin</span>
                                <span class="text-sm font-semibold text-gray-800">{{ $anggota->jenis_kelamin }}</span>
                            </div>
                        </div>

                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Pekerjaan</span>
                                <span class="text-sm font-semibold text-gray-800">{{ $anggota->pekerjaan ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 7V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Tanggal Lahir (Usia)</span>
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y') }}
                                    <span class="text-gray-400 font-normal">({{ $anggota->umur }} Tahun)</span>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start p-3 bg-gray-50/50 rounded-xl border border-gray-100">
                            <div class="p-2 bg-white rounded-lg shadow-sm text-gray-400 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <div>
                                <span class="block text-xs font-medium text-gray-400">Tanggal Terdaftar</span>
                                <span class="text-sm font-semibold text-gray-800">{{ \Carbon\Carbon::parse($anggota->tanggal_daftar)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2 p-4 bg-gray-50 rounded-xl border border-gray-100 mt-2">
                            <span class="block text-xs font-medium text-gray-400 mb-1">Alamat Lengkap Rumah</span>
                            <span class="text-sm font-medium text-gray-800">{{ $anggota->alamat }}</span>
                        </div>

                    </div>
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    
                    <div class="text-xs text-gray-400 space-y-0.5 text-center md:text-left">
                        <div>Dibuat: {{ $anggota->created_at->translatedFormat('d M Y, H:i') }}</div>
                        <div>Diperbarui: {{ $anggota->updated_at->translatedFormat('d M Y, H:i') }}</div>
                    </div>

                    <div class="flex flex-wrap gap-2 w-full md:w-auto justify-center">
                        
                        <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kembali
                        </a>

                        <a href="{{ route('anggota.edit', $anggota->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Data
                        </a>

                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen data anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Hapus
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>