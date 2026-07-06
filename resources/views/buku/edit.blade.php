<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-gray-200">
                <div class="max-w-xl">
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center gap-2">
                            <span class="p-2 bg-amber-100 text-amber-700 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </span>
                            Edit Buku: {{ $buku->judul }}
                        </h2>
                    </header>

                    <form action="{{ route('buku.update', $buku->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Kode Buku --}}
                            <div class="md:col-span-1">
                                <label for="kode_buku" class="block font-medium text-sm text-gray-700">Kode Buku <span class="text-red-500">*</span></label>
                                <input type="text" name="kode_buku" id="kode_buku" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('kode_buku') border-red-500 @enderror" value="{{ old('kode_buku', $buku->kode_buku) }}">
                                @error('kode_buku')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Judul --}}
                            <div class="md:col-span-2">
                                <label for="judul" class="block font-medium text-sm text-gray-700">Judul Buku <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('judul') border-red-500 @enderror" value="{{ old('judul', $buku->judul) }}">
                                @error('judul')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {{-- Kategori --}}
                            <div>
                                <label for="kategori" class="block font-medium text-sm text-gray-700">Kategori <span class="text-red-500">*</span></label>
                                <select name="kategori" id="kategori" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('kategori_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori_list as $kategori)
                                        <option value="{{ $kategori }}" {{ old('kategori', $buku->kategori) == $kategori ? 'selected' : '' }}>
                                            {{ $kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Pengarang --}}
                            <div>
                                <label for="pengarang" class="block font-medium text-sm text-gray-700">Pengarang <span class="text-red-500">*</span></label>
                                <input type="text" name="pengarang" id="pengarang" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('pengarang') border-red-500 @enderror" value="{{ old('pengarang', $buku->pengarang) }}">
                                @error('pengarang')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Penerbit --}}
                            <div>
                                <label for="penerbit" class="block font-medium text-sm text-gray-700">Penerbit <span class="text-red-500">*</span></label>
                                <input type="text" name="penerbit" id="penerbit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('penerbit') border-red-500 @enderror" value="{{ old('penerbit', $buku->penerbit) }}">
                                @error('penerbit')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {{-- Tahun Terbit --}}
                            <div>
                                <label for="tahun_terbit" class="block font-medium text-sm text-gray-700">Tahun <span class="text-red-500">*</span></label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('tahun_terbit') border-red-500 @enderror" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') }}">
                                @error('tahun_terbit')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- ISBN --}}
                            <div>
                                <label for="isbn" class="block font-medium text-sm text-gray-700">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('isbn') border-red-500 @enderror" value="{{ old('isbn', $buku->isbn) }}">
                                @error('isbn')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Bahasa --}}
                            <div>
                                <label for="bahasa" class="block font-medium text-sm text-gray-700">Bahasa <span class="text-red-500">*</span></label>
                                <select name="bahasa" id="bahasa" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('bahasa') border-red-500 @enderror">
                                    <option value="Indonesia" {{ old('bahasa', $buku->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Inggris" {{ old('bahasa', $buku->bahasa) == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                                </select>
                                @error('bahasa')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            {{-- Harga --}}
                            <div>
                                <label for="harga" class="block font-medium text-sm text-gray-700">Harga <span class="text-red-500">*</span></label>
                                <input type="number" name="harga" id="harga" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('harga') border-red-500 @enderror" value="{{ old('harga', $buku->harga) }}" min="0" step="1000">
                                @error('harga')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div class="w-full md:w-1/4">
                            <label for="stok" class="block font-medium text-sm text-gray-700">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stok" id="stok" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('stok') border-red-500 @enderror" value="{{ old('stok', $buku->stok) }}" min="0">
                            @error('stok')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Deskripsi --}}
                        <div>
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="pt-4 border-t border-gray-200 flex justify-between items-center">
                            <a href="{{ route('buku.show', $buku->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 text-xs text-gray-500 space-y-1">
                <p class="font-semibold text-gray-700 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 1.063 1.06 l-.041.02-.01.008a3 3 0 0 1-4.077-4.077l.008-.01a.75.75 0 0 1 1.06.041l.02.041a1.5 1.5 0 0 0 2.372 1.737l.02.041Zm-.02 2.75-.041.02a.75.75 0 1 0 1.063-1.06l-.041-.02-.01-.008a3 3 0 0 0-4.077 4.077l.008.01a.75.75 0 0 0 1.06-.041l.02-.041a1.5 1.5 0 0 1 2.372-1.737l.02-.041ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Informasi Log Data
                </p>
                <p>Buku ditambahkan: <span class="font-medium text-gray-600">{{ $buku->created_at->format('d M Y H:i') }}</span></p>
                <p>Terakhir diupdate: <span class="font-medium text-gray-600">{{ $buku->updated_at->format('d M Y H:i') }}</span></p>
            </div>

        </div>
    </div>
</x-app-layout>