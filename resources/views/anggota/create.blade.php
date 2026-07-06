<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota') }}
        </h2>
    </x-slot>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                
                <div class="bg-emerald-600 px-6 py-4 text-white flex items-center gap-2">
                    <i class="bi bi-person-plus text-xl"></i>
                    <h3 class="text-lg font-medium">Tambah Anggota Baru</h3>
                </div>
                
                <div class="p-6 bg-white">
                    {{-- KOTAK PELACAK EROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                            <strong class="block font-bold mb-1">Gagal menyimpan data karena:</strong>
                            <ul class="list-disc pl-5 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/anggota" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="kode_anggota" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kode Anggota
                                </label>
                                <input type="text"
                                       name="kode_anggota"
                                       id="kode_anggota"
                                       class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-500 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm @error('kode_anggota') border-rose-500 @enderror"
                                       value="{{ old('kode_anggota', $kodeAnggota ?? '') }}"
                                       readonly>
                                <p class="mt-1 text-xs text-gray-400">Otomatis oleh sistem</p>
                                @error('kode_anggota')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       id="nama" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('nama') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('nama') }}"
                                       placeholder="Nama lengkap anggota">
                                @error('nama')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('email') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="email@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Telepon <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="telepon" 
                                       id="telepon" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('telepon') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('telepon') }}"
                                       placeholder="081234567890">
                                @error('telepon')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-400">Format: 08xxxxxxxxxx atau +628xxxxxxxxxx</p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="alamat" 
                                      id="alamat" 
                                      rows="3" 
                                      class="w-full rounded-md shadow-sm sm:text-sm @error('alamat') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                      placeholder="Alamat lengkap dengan kota dan kode pos">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Lahir <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" 
                                       name="tanggal_lahir" 
                                       id="tanggal_lahir" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('tanggal_lahir') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('tanggal_lahir') }}"
                                       max="{{ date('Y-m-d') }}">
                                @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Kelamin <span class="text-rose-500">*</span>
                                </label>
                                <select name="jenis_kelamin" 
                                        id="jenis_kelamin" 
                                        class="w-full rounded-md shadow-sm sm:text-sm @error('jenis_kelamin') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" 
                                       name="pekerjaan" 
                                       id="pekerjaan" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('pekerjaan') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('pekerjaan') }}"
                                       placeholder="Contoh: Mahasiswa, Pegawai, dll">
                                @error('pekerjaan')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="tanggal_daftar" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Pendaftaran <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" 
                                       name="tanggal_daftar" 
                                       id="tanggal_daftar" 
                                       class="w-full rounded-md shadow-sm sm:text-sm @error('tanggal_daftar') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror"
                                       value="{{ old('tanggal_daftar', date('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}">
                                @error('tanggal_daftar')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-rose-500">*</span>
                                </label>
                                <select name="status" 
                                        id="status" 
                                        class="w-full rounded-md shadow-sm sm:text-sm @error('status') border-rose-500 focus:border-rose-500 focus:ring-rose-500 @else border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @enderror">
                                    <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <hr class="border-gray-200 mb-6">
                        
                        <div class="flex justify-between items-center">
                            <a href="{{ route('anggota.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                <i class="bi bi-arrow-left mr-2"></i> Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center px-5 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-150">
                                Simpan Anggota
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    flatpickr("#tanggal_lahir", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        locale: "id",
        altInput: true,
        altFormat: "d F Y",
    });
    
    flatpickr("#tanggal_daftar", {
        dateFormat: "Y-m-d",
        maxDate: "today",
        locale: "id",
        altInput: true,
        altFormat: "d F Y",
        defaultDate: "today",
    });
    
    document.getElementById('telepon').addEventListener('input', function() {
        this.value = this.value.replace(/[^\d+]/g, '');
    });
</script>
@endpush