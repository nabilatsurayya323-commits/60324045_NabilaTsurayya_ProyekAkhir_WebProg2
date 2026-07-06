<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px; /* Dikecilkan sedikit agar pas di kertas */
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px 8px; /* Lebih proporsional untuk ukuran cetak */
            text-align: left;
        }

        th {
            background-color: #f2f2f2; /* Memberi warna abu-abu tipis pada header agar terlihat professional */
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }

        .summary-box {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <h2>Laporan Transaksi Perpustakaan</h2>
    <p style="text-align: center; margin: 0 0 20px 0; font-size: 11px; color: #666;">Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="4%">No</th>
                <th>Kode</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th class="text-center">Status</th>
                <th class="text-right">Denda</th>
            </tr>
        </thead>

        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><strong>{{ $transaksi->kode_transaksi }}</strong></td>
                    
                    {{-- Proteksi ?? 'Siswa Luar' atau '-' agar jika data anggota/buku pernah dihapus, sistem tidak eror --}}
                    <td>{{ $transaksi->anggota->nama ?? 'Umum/Terhapus' }}</td>
                    <td>{{ $transaksi->buku->judul ?? 'Buku Terhapus' }}</td>
                    
                    {{-- Menggunakan strtotime agar format tanggal 100% aman dari eror query string --}}
                    <td>{{ date('d-m-Y', strtotime($transaksi->tanggal_pinjam)) }}</td>
                    
                    <td class="text-center">{{ $transaksi->status }}</td>
                    <td class="text-right">Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <p><strong>Total Transaksi :</strong> {{ $transaksis->count() }} data</p>
        <p><strong>Total Keseluruhan Denda :</strong> Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
    </div>

</body>
</html>