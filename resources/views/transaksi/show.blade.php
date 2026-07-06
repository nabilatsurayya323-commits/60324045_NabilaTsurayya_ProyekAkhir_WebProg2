<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Card Header --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 font-bold text-gray-700">
                    Detail Transaksi #{{ $transaksi->kode_transaksi }}
                </div>

                <div class="p-6 text-gray-900 space-y-6">

                    {{-- 1. Alert Keterlambatan (MODIFIKASI: Menggunakan Carbon secara dinamis) --}}
                    @if($transaksi->status === 'Dipinjam' && \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast())
                        @php
                            $hariTerlambat = \Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(now());
                        @endphp
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded animate-pulse" role="alert">
                            <p class="font-bold">Perhatian!</p>
                            <p>Buku terlambat dikembalikan selama <span class="font-bold">{{ $hariTerlambat }} hari.</span></p>
                        </div>
                    @endif

                    {{-- 2. KOTAK INFORMASI DETAIL (Selalu Muncul, Tidak Tergantung Status) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Kode Transaksi</span>
                            <span class="text-sm font-mono font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded inline-block mt-1">{{ $transaksi->kode_transaksi }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Nama Anggota</span>
                            <span class="text-sm font-semibold text-gray-800 block mt-1">{{ $transaksi->anggota->nama }}</span>
                        </div>

                        <div class="md:col-span-2">
                            <span class="block text-xs font-medium text-gray-500 uppercase">Judul Buku</span>
                            <span class="text-sm font-semibold text-gray-800 block mt-1">{{ $transaksi->buku->judul }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Tanggal Pinjam</span>
                            <span class="text-sm text-gray-700 block mt-1"><i class="bi bi-calendar-check mr-1 text-gray-400"></i> {{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d M Y') }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Tanggal Kembali</span>
                            <span class="text-sm text-gray-700 block mt-1"><i class="bi bi-calendar-x mr-1 text-gray-400"></i> {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') }}</span>
                        </div>

                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Status</span>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transaksi->status === 'Dipinjam' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                                {{ $transaksi->status }}
                            </span>
                        </div>

                        <div>
                            <span class="block text-xs font-medium text-gray-500 uppercase">Denda Saat Ini</span>
                            <span class="text-sm block mt-1 {{ $transaksi->denda > 0 ? 'text-red-600 font-bold' : 'text-gray-700' }}">
                                Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    {{-- 3. TOMBOL AKSI & STATUS PENGEMBALIAN --}}
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        @if($transaksi->status === 'Dipinjam')
                            {{-- Tampilkan tombol kembalikan jika status masih DIPINJAM --}}
                            <button type="button" class="inline-flex justify-center items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition gap-2 cursor-pointer" id="btn-kembalikan">
                                <i class="bi bi-arrow-return-left"></i> Kembalikan Buku
                            </button>
                        
                            <form id="form-kembalikan" action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT') 
                            </form>
                        @else
                            {{-- Tampilkan info detail pengembalian jika status sudah DIKEMBALIKAN --}}
                            @php
                                $tglKembali = \Carbon\Carbon::parse($transaksi->tanggal_kembali);
                                $tglDikembalikan = \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan);
                            @endphp

                            @if($tglDikembalikan->lte($tglKembali))
                                <div class="w-full bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded text-sm">
                                    <i class="bi bi-check-circle mr-1"></i> Dikembalikan tepat waktu pada 
                                    <span class="font-semibold">{{ $tglDikembalikan->format('d M Y (H:i)') }}</span>
                                </div>
                            @else
                                <div class="w-full bg-amber-50 border-l-4 border-amber-500 text-amber-700 p-3 rounded text-sm">
                                    <i class="bi bi-exclamation-triangle mr-1"></i> Terlambat dikembalikan pada 
                                    <span class="font-semibold">{{ $tglDikembalikan->format('d M Y (H:i)') }}</span>!<br>
                                    <strong class="text-red-700">Total Denda Dibayar:</strong> Rp {{ number_format($transaksi->denda, 0, ',', '.') }}
                                </div>
                            @endif
                        @endif

                        <a href="{{ route('transaksi.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition text-center">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

{{-- 4. JAVASCRIPT DIRECT INJECTION (Tanpa Menggunakan @push) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnKembalikan = document.getElementById('btn-kembalikan');
    const formKembalikan = document.getElementById('form-kembalikan');

    if (btnKembalikan && formKembalikan) {
        btnKembalikan.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Pengembalian',
                text: 'Apakah Anda yakin ingin mengembalikan buku ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#4b5563',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    formKembalikan.submit();
                }
            });
        });
    }
});
</script>