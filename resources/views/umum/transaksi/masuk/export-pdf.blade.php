<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Masuk</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>LAPORAN TRANSAKSI MASUK</h3>

<p>
    Filter : {{ ucfirst($filter) }} <br>
    Tanggal : {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Merk / Tipe</th>
            <th>Kategori</th>
            <th>Transaksi</th>
            <th>Qty</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksis as $t)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $t->barang->kode_barang ?? '-' }}</td>
            <td>{{ $t->barang->nama_barang ?? '-' }}</td>
            <td>{{ $t->barang->merk ?? '-' }}</td>
            <td>{{ $t->barang->category->nama_kategori ?? '-' }}</td>
            <td align="center">{{ $t->jenis_transaksi }}</td>
            <td align="center">{{ $t->jumlah }}</td>
            <td>{{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
