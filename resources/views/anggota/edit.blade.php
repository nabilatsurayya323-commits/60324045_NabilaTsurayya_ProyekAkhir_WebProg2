<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Anggota') }}
        </h2>
    </x-slot>

    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 bg-amber-50 border-b border-amber-100 flex items-center gap-2 text-amber-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <h3 class="text-lg font-bold">Edit Anggota: {{ $anggota->nama }}</h3>
                </div>

                <div class="p-6">
                    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <label for="kode_anggota" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kode Anggota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode_anggota" id="kode_anggota" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('kode_anggota') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('kode_anggota', $anggota->kode_anggota) }}">
                                @error('kode_anggota')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" id="nama" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('nama') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('nama', $anggota->nama) }}">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('email', $anggota->email) }}">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nomor Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="telepon" id="telepon" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('telepon') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('telepon', $anggota->telepon) }}">
                                @error('telepon')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                                Alamat Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" id="alamat" rows="3" 
                                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('alamat') border-red-500 focus:ring-red-500 @enderror">{{ old('alamat', $anggota->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('tanggal_lahir') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('tanggal_lahir', $anggota->tanggal_lahir?->format('Y-m-d')) }}">
                                @error('tanggal_lahir')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select name="jenis_kelamin" id="jenis_kelamin" 
                                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('jenis_kelamin') border-red-500 focus:ring-red-500 @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    @foreach(['Laki-laki', 'Perempuan'] as $jk)
                                        <option value="{{ $jk }}" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == $jk ? 'selected' : '' }}>
                                            {{ $jk }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('pekerjaan') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('pekerjaan', $anggota->pekerjaan) }}">
                                @error('pekerjaan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tanggal_daftar" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggal Pendaftaran <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_daftar" id="tanggal_daftar" 
                                       class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('tanggal_daftar') border-red-500 focus:ring-red-500 @enderror"
                                       value="{{ old('tanggal_daftar', $anggota->tanggal_daftar?->format('Y-m-d')) }}">
                                @error('tanggal_daftar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" id="status" 
                                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:ring-red-500 @enderror">
                                    @foreach(['Aktif', 'Nonaktif'] as $st)
                                        <option value="{{ $st }}" {{ old('status', $anggota->status) == $st ? 'selected' : '' }}>
                                            {{ $st }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-5 flex justify-between items-center">
                            <a href="{{ route('anggota.show', $anggota->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 text-xs text-gray-500 space-y-1">
                <p class="font-bold text-gray-700 mb-1">ℹ️ Log Informasi Sistem:</p>
                <p>• Anggota terdaftar sejak: {{ $anggota->created_at->translatedFormat('d M Y H:i') }} WIB</p>
                <p>• Pembaruan data terakhir: {{ $anggota->updated_at->translatedFormat('d M Y H:i') }} WIB</p>
                <p>• Durasi keanggotaan berjalan: {{ $anggota->lama_anggota }} hari (~{{ round($anggota->lama_anggota / 365, 1) }} tahun)</p>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                });
            });
        </script>
    </x-slot>
</x-app-layout>