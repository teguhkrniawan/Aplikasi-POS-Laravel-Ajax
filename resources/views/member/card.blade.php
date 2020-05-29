<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>

    <style>
        .box {
            position: relative;
        }

        .card {
            width: 501.732pt;
            height: 147.402pt;
        }

        .kode {
            position: absolute;
            top: 90pt;
            left: 15pt;
            color: #fff;
            font-size: 15pt;
        }

        .barcode {
            position: absolute;
            top: -3pt;
            left: 280pt;
            font-size: 10pt
        }
    </style>
</head>

<body>
    <table width="100%">
        @foreach ($datamember as $data)
        <tr>
            <td align="center">
                <div class="box">
                    <img src="{{ asset('images/card.png') }}" class="card">
                    <div class="kode">{{ $data->nama }}</div>
                    <div class="barcode">
                        <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG( $data->kode_member, 'C39' ) }}"
                            height="30" width="130" alt="">
                        <span>
                            {{ $data->kode_member }}
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>