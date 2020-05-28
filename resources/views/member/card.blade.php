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
            top: 110pt;
            left: 10pt;
            color: #fff;
            font-size: 15pt;
        }

        .barcode {
            position: absolute;
            top: 15pt;
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
                    <img src="{{ asset('images/card.png') }}" alt="">
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>