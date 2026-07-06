<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaksi Peminjaman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                {{-- Card Header --}}
                <div class="px-6 py-4 bg-indigo-600 font-bold text-white flex items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-circle text-lg"></i>
                    <h3 class="text-base font-semibold uppercase tracking-wider">Form Peminjaman Buku</h3>
                </div>

                {{-- Card Body --}}
                <div class="p-6 sm:p-8 text-gray-900">
                    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
                        @csrf
                            
                        {{-- Pilih Anggota --}}
                        <div>
                            <label for="anggota_id" class="block text-sm font-medium text-gray-700">
                                Pilih Anggota <span class="text-red-500">*</span>
                            </label>
                            <select name="anggota_id" 
                                    id="anggota_id" 
                                    class="mt-1 block w-full rounded-md shadow-sm transition focus:ring-2 focus:ring-offset-1 text-sm @error('anggota_id') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror">
                                <option value="">-- Pilih Anggota --</option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->kode_anggota }} - {{ $anggota->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-400 italic">Hanya anggota dengan status Aktif yang dapat meminjam</p>
                        </div>
                        
                        {{-- Pilih Buku --}}
                        <div>
                            <label for="buku_id" class="block text-sm font-medium text-gray-700">
                                Pilih Buku <span class="text-red-500">*</span>
                            </label>
                            <select name="buku_id" 
                                    id="buku_id" 
                                    class="mt-1 block w-full rounded-md shadow-sm transition focus:ring-2 focus:ring-offset-1 text-sm @error('buku_id') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror">
                                <option value="">-- Pilih Buku --</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }} - (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            </select>
                            @error('buku_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-400 italic">Hanya buku dengan stok tersedia yang dapat dipinjam</p>
                        </div>
                        
                        {{-- Tanggal Pinjam --}}
                        <div>
                            <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">
                                Tanggal Pinjam <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="tanggal_pinjam" 
                                   id="tanggal_pinjam" 
                                   class="mt-1 block w-full rounded-md shadow-sm transition focus:ring-2 focus:ring-offset-1 text-sm @error('tanggal_pinjam') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror"
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}">
                            @error('tanggal_pinjam')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-400 italic">Tanggal kembali otomatis 7 hari dari tanggal pinjam</p>
                        </div>
                        
                        {{-- Keterangan --}}
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea name="keterangan" 
                                      id="keterangan" 
                                      rows="3" 
                                      class="mt-1 block w-full rounded-md shadow-sm transition focus:ring-2 focus:ring-offset-1 text-sm @error('keterangan') border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500 @else border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @enderror"
                                      placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Info Box --}}
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-md">
                            <div class="flex items-start gap-2">
                                <i class="bi bi-info-circle text-blue-700 mt-0.5"></i>
                                <div>
                                    <h4 class="text-sm font-bold text-blue-800">Informasi Peminjaman:</h4>
                                    <ul class="list-disc list-inside text-xs text-blue-700 mt-1.5 space-y-1">
                                        <li>Durasi peminjaman: <span class="font-semibold text-blue-900">7 hari</span></li>
                                        <li>Denda keterlambatan: <span class="font-semibold text-blue-900">Rp 5.000/hari</span></li>
                                        <li>Stok buku akan berkurang otomatis setelah peminjaman</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="border-gray-200">
                        
                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between gap-4">
                            <a href="{{ route('transaksi.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition gap-2">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition gap-2 cursor-pointer">
                                <i class="bi bi-save"></i> Proses Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>