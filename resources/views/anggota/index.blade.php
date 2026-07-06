<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Anggota
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Header Judul & Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-lg shadow-sm">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-people text-indigo-600"></i>
                    Daftar Anggota
                </h1>

                <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                    <a href="{{ route('anggota.export', request()->all()) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase rounded-lg tracking-widest transition-colors shadow-sm">
                        EXPORT EXCEL
                    </a>

                    <a href="{{ route('anggota.create') }}" class="flex-1 sm:flex-none inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition gap-2 text-center">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Anggota
                    </a>
                </div>
            </div>
            
            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Anggota</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalAnggota }}</h2>
                        </div>
                        <i class="bi bi-people-fill text-green-500" style="font-size: 3rem;"></i>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Anggota Aktif</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $anggotaAktif }}</h2>
                        </div>
                        <i class="bi bi-person-check-fill text-blue-500" style="font-size: 3rem;"></i>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-gray-400 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Anggota Nonaktif</h6>
                            <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $anggotaNonaktif }}</h2>
                        </div>
                        <i class="bi bi-person-x-fill text-gray-400" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>

            {{-- Form Pencarian & Filter --}}
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('anggota.search') }}" method="GET">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 items-end">
                        <div class="lg:col-span-3">
                            <input type="text" name="keyword" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Cari nama/email/telepon" value="{{ request('keyword') }}">
                        </div>

                        <div class="lg:col-span-2">
                            <select name="jenis_kelamin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="lg:col-span-2">
                            <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Semua Status</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="lg:col-span-2">
                            <input type="text" name="kode_anggota" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Kode Anggota" value="{{ request('kode_anggota') }}">
                        </div>

                        <div class="lg:col-span-3 flex gap-2 w-full">
                            <button type="submit" class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 transition sm:text-sm">
                                Cari
                            </button>

                            <a href="{{ route('anggota.index') }}" class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition sm:text-sm text-center">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            
            {{-- Tabel Anggota --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($anggotas as $anggota)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{-- Penomoran dinamis yang mendukung sistem Pagination --}}
                                            {{ ($anggotas->currentPage() - 1) * $anggotas->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-indigo-600 bg-indigo-50 rounded px-1.5 inline-block my-2">
                                            {{ $anggota->kode_anggota }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $anggota->nama }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <i class="bi bi-envelope text-gray-400 mr-1"></i> {{ $anggota->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <i class="bi bi-telephone text-gray-400 mr-1"></i> {{ $anggota->telepon }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if ($anggota->jenis_kelamin == 'Laki-laki')
                                                <i class="bi bi-gender-male text-blue-500 mr-1"></i>
                                            @else
                                                <i class="bi bi-gender-female text-pink-500 mr-1"></i>
                                            @endif
                                            {{ $anggota->jenis_kelamin }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($anggota->status == 'Aktif')
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    <i class="bi bi-check-circle mr-1"></i> Aktif
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    <i class="bi bi-x-circle mr-1"></i> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <a href="{{ route('anggota.show', $anggota->id) }}" class="px-3 py-1.5 bg-blue-500 text-white rounded-l-md hover:bg-blue-600 text-xs transition" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="px-3 py-1.5 bg-amber-500 text-white rounded-r-md hover:bg-amber-600 text-xs transition" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <i class="bi bi-inbox text-3xl text-gray-300"></i>
                                                <span>Tidak ada data anggota ditemukan</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Link Pagination Utama --}}
                    <div class="mt-4">
                        {{ $anggotas->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>