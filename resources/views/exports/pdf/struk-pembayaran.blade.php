@php
    $fmt = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);
    $fmt->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
@endphp
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran</title>
    <style>
        @page {
            size: 58mm 130mm;
            margin: 3mm 3mm 4mm;
        }

        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 9px;
            line-height: 1.25;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            text-align: center;
        }

        h1 {
            font-size: 11px;
        }

        .center {
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .mt {
            margin-top: 6px;
        }

        .muted {
            color: #666;
        }

        hr {
            border: 0;
            border-top: 1px dashed #999;
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td:first-child {
            width: 45%;
        }

        td:last-child {
            width: 55%;
            text-align: right;
        }

        td {
            vertical-align: top;
            padding: 1px 0;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>TIRTA SEJAHTERA</h1>
    <div class="center muted">Kp. Cidawolong Rt {{ $customer->rt }} Rw {{ $customer->rw }} Desa Biru-Majalaya</div>
    <div class="center bold">BUKTI PEMBAYARAN TAGIHAN<br>PENGELOLAAN AIR BERSIH</div>
    <hr>

    <table>
        <tr>
            <td>Bulan</td>
            <td class="right">{{ \Carbon\Carbon::parse($periode)->isoFormat('MMMM Y') }}</td>
        </tr>
        <tr>
            <td>No / Id Pelanggan</td>
            <td class="right">#{{ $customer->id }}</td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td class="right">{{ $customer->name }}</td>
        </tr>
        <tr>
            <td>Stand Meter (M3) :</td>
            <td></td>
        </tr>
        <tr>
            <td>Bulan Ini</td>
            <td class="right">{{ number_format($meter_ini, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bulan Lalu</td>
            <td class="right">{{ number_format($meter_lalu, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="bold">Pemakaian</td>
            <td class="right bold">{{ number_format($pakai, 0, ',', '.') }}</td>
        </tr>
    </table>

    <hr>

    <table>
        <tr>
            <td>Harga Air</td>
            <td class="right">{{ $fmt->formatCurrency($harga_air, 'IDR') }}</td>
        </tr>
        <tr>
            <td>Administrasi</td>
            <td class="right">{{ $fmt->formatCurrency($admin_fee, 'IDR') }}</td>
        </tr>
        @if ($materai > 0)
            <tr>
                <td>Materai</td>
                <td class="right">{{ $fmt->formatCurrency($materai, 'IDR') }}</td>
            </tr>
        @endif
        @if ($retribusi > 0)
            <tr>
                <td>Retribusi</td>
                <td class="right">{{ $fmt->formatCurrency($retribusi, 'IDR') }}</td>
            </tr>
        @endif
        @if ($denda > 0)
            <tr>
                <td>Denda</td>
                <td class="right">{{ $fmt->formatCurrency($denda, 'IDR') }}</td>
            </tr>
        @endif
        <tr>
            <td>Admin Loket</td>
            <td class="right">{{ $admin_loket }}</td>
        </tr>
        <tr>
            <td class="bold">Jumlah Tagihan</td>
            <td class="right bold">{{ $fmt->formatCurrency($total, 'IDR') }}</td>
        </tr>
    </table>

    <hr>
    <div class="muted">Dicetak: {{ now()->format('d/m/Y H:i') }}</div>
    <div class="center mt">Bayar semua tagihan anda<br> <span class="bold">TEPAT WAKTU</span></div>
    <div class="center mt">Pengelola Air Bersih</div>
</body>

</html>
