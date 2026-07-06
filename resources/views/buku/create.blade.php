<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-200 rounded-lg">
                
                <div class="bg-indigo-600 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-white flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Form Tambah Buku Baru
                    </h3>
                </div>

                <div class="p-6 bg-white">
                    {{-- Alert penangkap error global jika ada validasi yang gagal --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 roundedshadow-sm">
                            <strong class="block font-bold mb-1">Gagal menyimpan data:</strong>
                            <ul class="list-disc pl-5 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="md:col-span-1">
                                <label for="kode_buku" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kode Buku <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode_buku" id="kode_buku" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_buku') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('kode_buku') }}" placeholder="Contoh: BK-001">
                                @error('kode_buku')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Buku <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="judul" id="judul" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('judul') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('judul') }}" placeholder="Masukkan judul lengkap buku">
                                @error('judul')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="kategori" id="kategori" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kategori') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori_list as $kategori)
                                        <option value="{{ $kategori->nama_kategori }}" {{ old('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="pengarang" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pengarang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="pengarang" id="pengarang" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('pengarang') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('pengarang') }}" placeholder="Nama pengarang">
                                @error('pengarang')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-2">
                                    Penerbit <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="penerbit" id="penerbit" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('penerbit') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('penerbit') }}" placeholder="Nama penerbit">
                                @error('penerbit')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                            <div>
                                <label for="tahun_terbit" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tahun Terbit <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="tahun_terbit" id="tahun_terbit" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('tahun_terbit') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('tahun_terbit', date('Y')) }}" min="1900" max="{{ date('Y') }}">
                                @error('tahun_terbit')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('isbn') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('isbn') }}" placeholder="978-xxx-xxx">
                                @error('isbn')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-2">
                                    Bahasa <span class="text-red-500">*</span>
                                </label>
                                <select name="bahasa" id="bahasa" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('bahasa') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    <option value="Indonesia" {{ old('bahasa', 'Indonesia') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                    <option value="Inggris" {{ old('bahasa') == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                                </select>
                                @error('bahasa')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stok" id="stok" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('stok') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                    value="{{ old('stok', 0) }}" min="0">
                                @error('stok')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Buku (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga" id="harga" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('harga') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                value="{{ old('harga', 0) }}" min="0" step="1000">
                            @error('harga')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('deskripsi') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Deskripsi singkat tentang buku (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="border-t border-gray-200 my-6"></div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('buku.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                ← Kembali
                            </a>
                            <button type="submit" id="btn-submit"
                                class="inline-flex items-center px-5 py-2.2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150">
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    document.getElementById('harga').addEventListener('blur', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = value;
    });

    document.querySelector('form').addEventListener('submit', function() {
        const submitBtn = document.getElementById('btn-submit');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            `;
        }
    });
</script>
@endpush