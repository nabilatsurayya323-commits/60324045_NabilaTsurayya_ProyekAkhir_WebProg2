<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. Kartu Statistik Utama (Baris ke-1) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                @foreach([
                    ['Total Buku', $stats['total_buku'], 'bg-blue-500', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ['Anggota Aktif', $stats['total_anggota'], 'bg-green-500', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['Sedang Dipinjam', $stats['sedang_dipinjam'], 'bg-amber-500', 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                    ['Terlambat', $stats['terlambat'], 'bg-red-500', 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z']
                ] as [$label, $value, $bgColor, $iconPath])
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b-2 {{ $label === 'Terlambat' && $value > 0 ? 'border-red-500' : 'border-transparent' }}">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-lg text-white {{ $bgColor }}">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">{{ $label }}</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $value }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- 2. Kartu Statistik Operasional & Finansial (Baris ke-2) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                @foreach([
                    ['Transaksi Hari Ini', $stats['transaksi_hari_ini'], 'bg-purple-500', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['Buku Tersedia', $stats['buku_tersedia'], 'bg-teal-500', 'M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4z'],
                    ['Total Log Transaksi', $stats['total_transaksi'], 'bg-slate-600', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['Denda Bulan Ini', 'Rp ' . number_format($stats['denda_bulan_ini'], 0, ',', '.'), 'bg-emerald-600', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16H3m14 0h3']
                ] as [$label, $value, $bgColor, $iconPath])
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-lg text-white {{ $bgColor }}">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">{{ $label }}</p>
                            <p class="text-xl font-bold text-gray-900">{{ $value }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- 3. Grafik Tren (Line Chart) & Komponen Daftar Keterlambatan --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tren Transaksi (6 Bulan Terakhir)</h3>
                    <div style="height: 280px; position: relative;">
                        <canvas id="chartTransaksi"></canvas>
                    </div>
                </div>

                {{-- Komponen Daftar Keterlambatan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-red-500 p-6">
                    <h3 class="text-lg font-semibold text-red-600 mb-4">Daftar Keterlambatan Aktif</h3>
                    <div class="space-y-3 max-h-64 overflow-y-auto pr-1">
                        @forelse($transaksiTerlambat as $transaksi)
                        <div class="p-3 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-sm">
                            <strong class="text-gray-800 block truncate">{{ $transaksi->anggota->nama }}</strong>
                            <p class="text-gray-600 text-xs my-0.5 truncate">{{ $transaksi->buku->judul }}</p>
                            <span class="inline-block mt-1 text-xs font-semibold px-2 py-0.5 bg-red-200 text-red-800 rounded-full">
                                Terlambat {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(now()) }} Hari
                            </span>
                        </div>
                        @empty
                        <div class="text-center py-12 text-gray-500 text-sm">
                            <svg class="mx-auto h-12 w-12 text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tidak ada keterlambatan aktif.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- 4. Grafik Buku Populer (Pie) & Tabel Transaksi Terbaru --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Buku Populer</h3>
                    <div style="height: 250px; position: relative;" class="flex items-center justify-center">
                        <canvas id="chartBuku"></canvas>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Transaksi Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs">Kode</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs">Anggota</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs">Buku</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs">Tgl Pinjam</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase text-xs">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentTransaksi as $trx)
                                <tr>
                                    <td class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap">{{ $trx->kode_transaksi }}</td>
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $trx->anggota->nama ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $trx->buku->judul ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{-- MODIFIKASI: Deteksi status terlambat pada riwayat transaksi terbaru --}}
                                        @if($trx->status == 'Dipinjam' && \Carbon\Carbon::parse($trx->tanggal_kembali)->isPast())
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Terlambat
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $trx->status == 'Dipinjam' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $trx->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Grafik Terintegrasi --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Line Chart — Grafik Tren Transaksi
    new Chart(document.getElementById('chartTransaksi'), {
        type: 'line',
        data: {
            labels: @json($chartData->pluck('bulan')),
            datasets: [
                { label: 'Peminjaman', data: @json($chartData->pluck('pinjam')), borderColor: '#3b82f6', backgroundColor: 'transparent', tension: 0.3 },
                { label: 'Pengembalian', data: @json($chartData->pluck('kembali')), borderColor: '#10b981', backgroundColor: 'transparent', tension: 0.3 }
            ]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Pie Chart — Buku Terpopuler
    new Chart(document.getElementById('chartBuku'), {
        type: 'pie',
        data: {
            labels: @json($bukuPopuler->pluck('judul')),
            datasets: [{
                data: @json($bukuPopuler->pluck('transaksis_count')),
                backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444','#8b5cf6']
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } } } 
        }
    });
    </script>
    @endpush
</x-app-layout>