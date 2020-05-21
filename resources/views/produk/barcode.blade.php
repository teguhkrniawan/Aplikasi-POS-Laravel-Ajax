<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>
</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $data)
            <td align="center" style="border" 1px solid #ccc>
                {{ $data->merk }} - Rp. {{ format_uang($data->harga_jual) }}
                </span>
                <br>
                <br>
                <img src="data:image/png;base64, {{  DNS1D::getBarcodePNG($data->kode_produk, 'C39')}}" height="60"
                    width="100">
                <br>
                {{ $data->kode_produk }}
                <br>
                <br>
                <br>
            </td>
            @if ( $no++ % 3 == 0 )
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>


    </table>
</body>

</html>