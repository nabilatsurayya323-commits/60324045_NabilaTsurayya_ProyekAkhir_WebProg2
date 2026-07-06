<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Notifikasi --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r shadow-sm flex justify-between items-center" x-data="{ show: true }" x-show="show">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-900 font-bold hover:text-green-700">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm flex justify-between items-center" x-data="{ show: true }" x-show="show">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="text-red-900 font-bold hover:text-red-700">&times;</button>
                </div>
            @endif

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 height-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Daftar Buku
                    </h2>
                </div>

            {{-- Pembungkus Tombol Aksi --}}
            <div class="flex gap-2 w-full sm:w-auto">
                @if(isset($kategoriId) && $kategoriId != '')
                {{-- Jika sedang memfilter kategori --}}
                <a href="{{ route('buku.export') }}?kategori={{ $kategoriId }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-md shadow-sm transition w-full sm:w-auto">
                    Export CSV
                </a>
            @else
            {{-- Jika sedang melihat semua data buku --}}
            <a href="{{ route('buku.export', ['kategori' => request('kategori') ?? $kategoriNama ?? '']) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                Export Excel
            </a>
            @endif
            
            {{-- Tombol Tambah Buku yang tadinya hilang --}}
            <a href="{{ route('buku.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow-sm transition w-full sm:w-auto">
                + Tambah Buku
            </a>
        </div>
    </div>

            {{-- Grid Kartu Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 shadow-sm rounded-lg border-l-4 border-blue-500">
                    <h6 class="text-sm font-medium text-gray-500 uppercase">Total Buku</h6>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $totalBuku }}</h2>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg border-l-4 border-green-500">
                    <h6 class="text-sm font-medium text-gray-500 uppercase">Buku Tersedia</h6>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $bukuTersedia }}</h2>
                </div>

                <div class="bg-white p-6 shadow-sm rounded-lg border-l-4 border-red-500">
                    <h6 class="text-sm font-medium text-gray-500 uppercase">Buku Habis</h6>
                    <h2 class="text-3xl font-bold text-gray-900 mt-1">{{ $bukuHabis }}</h2>
                </div>
            </div>

            {{-- Filter Kategori --}}
            <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6">
                <h6 class="text-xs font-bold uppercase text-gray-400 mb-3 flex items-center gap-1">
                    Filter Kategori
                </h6>
                <div class="flex flex-wrap gap-2">
                    {{-- Tombol Semua --}}
                    <a href="{{ route('buku.index') }}" class="px-3 py-1.5 text-xs font-semibold rounded-md transition {{ empty($kategoriId) ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-50 hover:bg-gray-100 text-gray-600' }}">Semua</a>
                    
                    {{-- Looping List Kategori --}}
                    @foreach($kategori_list as $kat)
                    <a href="{{ route('buku.kategori', $kat) }}" 
                    class="px-3 py-1.5 text-xs font-semibold rounded-md transition {{ (isset($kategoriNama) && $kategoriNama == $kat) ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-50 hover:bg-gray-100 text-gray-600' }}">
                    {{ $kat }}
                </a>
                @endforeach
                </div>
            </div>

            {{-- Form Bulk Delete Tersembunyi --}}
            <form id="bulk-delete-form" action="{{ route('buku.bulk-delete') }}" method="POST" style="display: none;">
                @csrf
            </form>

            {{-- Wadah Tabel Konten --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                {{-- Batas Atas Kontrol Tabel --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="select-all" class="text-sm text-gray-600 font-medium cursor-pointer">Pilih Semua</label>
                    </div>

                    <button
                        type="button"
                        id="btn-bulk-delete"
                        class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded shadow-sm transition"
                    >
                        Hapus Terpilih
                    </button>
                </div>

                {{-- Struktur Data Tabel --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="w-12 px-6 py-3"></th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase text-xs">Kode</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase text-xs">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase text-xs">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase text-xs">Pengarang</th>
                                <th class="px-4 py-3 text-center font-semibold text-gray-600 uppercase text-xs">Stok</th>
                                <th class="px-6 py-3 text-center font-semibold text-gray-600 uppercase text-xs w-64">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bukus as $buku)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td class="px-6 py-4 text-center">
                                        <input
                                            type="checkbox"
                                            name="buku_ids[]"
                                            value="{{ $buku->id }}"
                                            class="cb-buku rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                        >
                                    </td>

                                    <td class="px-4 py-4 font-mono font-bold text-gray-900 whitespace-nowrap">{{ $buku->kode_buku }}</td>
                                    <td class="px-4 py-4 text-gray-800 font-medium">{{ $buku->judul }}</td>
                                    
                                    <td class="px-4 py-4 text-gray-500 whitespace-nowrap">
                                        {{ $buku->kategori }}
                                    </td>
                                    
                                    <td class="px-4 py-4 text-gray-500 whitespace-nowrap">{{ $buku->pengarang }}</td>
                                    <td class="px-4 py-4 text-center font-semibold text-gray-900">{{ $buku->stok }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-xs font-medium space-x-1">
                                        <a href="{{ route('buku.show', $buku->id) }}"
                                           class="text-blue-600 hover:text-blue-900 px-2 py-1 bg-blue-50 rounded">
                                            Detail
                                        </a>

                                        <a href="{{ route('buku.edit', $buku->id) }}"
                                           class="text-amber-600 hover:text-amber-900 px-2 py-1 bg-amber-50 rounded">
                                            Edit
                                        </a>

                                        <button
                                            type="button"
                                            class="text-red-600 hover:text-red-900 px-2 py-1 bg-red-50 rounded btn-delete"
                                            data-id="{{ $buku->id }}"
                                            data-judul="{{ $buku->judul }}"
                                        >
                                            Hapus
                                        </button>

                                        <form id="delete-form-{{ $buku->id }}"
                                              action="{{ route('buku.destroy', $buku->id) }}"
                                              method="POST"
                                              style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400 italic">
                                        Tidak ada data buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Logic Checkbox Pilih Semua
document.getElementById('select-all').addEventListener('change', function() {
    document.querySelectorAll('.cb-buku').forEach(cb => {
        cb.checked = this.checked;
    });
});

// Penanganan Tombol Hapus Terpilih (Bulk Delete)
document.getElementById('btn-bulk-delete').addEventListener('click', function() {
    const checkedBoxes = document.querySelectorAll('.cb-buku:checked');
    
    if (checkedBoxes.length === 0) {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Silakan pilih minimal satu buku yang ingin dihapus dengan mencentang kotak.',
            icon: 'warning',
            confirmButtonColor: '#3b82f6'
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Hapus Massal',
        text: `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} buku yang dipilih?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('bulk-delete-form');
            form.querySelectorAll('input[name="buku_ids[]"]').forEach(el => el.remove());

            checkedBoxes.forEach(cb => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'buku_ids[]';
                hiddenInput.value = cb.value;
                form.appendChild(hiddenInput);
            });

            form.submit();
        }
    });
});

// Konfirmasi Hapus Satuan dengan SweetAlert
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const judul = this.dataset.judul;

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    });
});
</script>
@endpush