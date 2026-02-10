<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman Lengkap</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #3b82f6;
            color: white;
            padding: 8px;
            text-transform: uppercase;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 10px;
        }

        .footer {
            margin-top: 30px;
            float: right;
            width: 200px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2 style="margin: 0;">REKAPITULASI PEMINJAMAN BUKU</h2>
        <h3 style="margin: 5px 0;">Perpustakaan Digital Modern</h3>
        <p>Periode: {{ date('d M Y', strtotime($request->tgl_mulai)) }} s/d {{ date('d M Y', strtotime($request->tgl_selesai)) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $totalDenda = 0; @endphp
            @foreach($data as $p)
            @php
            $denda = 0;
            $tgl_kembali = \Carbon\Carbon::parse($p->TanggalPengembalian);
            $tgl_sekarang = now();

            // Hitung denda jika status masih dipinjam dan lewat tanggal kembali
            if($p->StatusPeminjaman == 'Dipinjam' && $tgl_sekarang > $tgl_kembali) {
            $hari_terlambat = $tgl_sekarang->diffInDays($tgl_kembali);
            $denda = $hari_terlambat * 1000;
            }
            $totalDenda += $denda;
            @endphp
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td><b>{{ $p->user->nama_lengkap }}</b></td>
                <td>{{ $p->buku->Judul }}</td>
                <td>{{ date('d/m/Y', strtotime($p->TanggalPeminjaman)) }}</td>
                <td>{{ date('d/m/Y', strtotime($p->TanggalPengembalian)) }}</td>
                <td>{{ $p->StatusPeminjaman }}</td>
                <td class="text-right">Rp {{ number_format($denda, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #eee;">
                <td colspan="6" class="text-right">TOTAL PENDAPATAN DENDA :</td>
                <td class="text-right">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Bogor, {{ date('d F Y') }}</p>
        <p>Petugas Perpustakaan,</p>
        <br><br><br>
        <p><b>( _________________ )</b></p>
    </div>
</body>

</html>