<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Barang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        h3 {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h3>DATA BARANG</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $item->kode_barang ?? '-' }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->category->nama_kategori ?? '-' }}</td>
            <td align="center">{{ $item->stok }}</td>
            <td>{{ $item->kondisi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
