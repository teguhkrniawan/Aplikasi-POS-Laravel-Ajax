<!doctype html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
</head>

<body>


    <style>
        .text-center {
            text-align: center
        }

        .tabel {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1111111;
            color: #fffffff;
            padding: 10px;
        }

        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <br>
    <h3 class="text-center">Laporan Pendapatan</h3>
    <h4 class="text-center">Tanggal : {{ tanggal_indonesia($tanggal_awal, false) }} s/d
        {{ tanggal_indonesia($tanggal_akhir, false) }}
    </h4>

    <table class="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                @foreach ($row as $col)
                <td>{{ $col }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>


    </table>


</body>

</html>