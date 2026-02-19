<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid black; padding: 5px; vertical-align: top; }
        .header-table td { border: none; }
        .no-border { border: none; }
        .title { text-align: center; font-weight: bold; font-size: 14px; }
        .gray-bg { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td width="20%"><img src="logo.png" width="100"></td>
            <td width="50%" class="title">FORMULIR PERMINTAAN SDM</td>
            <td width="30%">
                No Dokumen: 01B/ACS-HCM/FRM/2024<br>
                Revisi: 01<br>
                Tgl Efektif: 1 Jan 2024
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="no-border">Nama: {{ $record->applicant_name }}</td>
            <td class="no-border">No. FPS: {{ $record->fps_number }}</td>
        </tr>
        <tr>
            <td class="no-border">Jabatan: {{ $record->applicant_position }}</td>
            <td class="no-border">Tgl Permintaan: {{ $record->request_date->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="no-border">Wilayah: {{ $record->applicant_region }}</td>
            <td class="no-border">Tgl Dibutuhkan: {{ $record->needed_date->format('d/m/Y') }}</td>
        </tr>
    </table>

    <table class="gray-bg">
        <tr>
            <th colspan="4">PERMINTAAN & KUALIFIKASI SDM</th>
        </tr>
    </table>

    @foreach($record->items as $item)
    <table>
        <tr>
            <td width="25%">Jabatan:</td>
            <td width="25%">{{ $item->position->name }}</td>
            <td width="25%">Jumlah:</td>
            <td width="25%">{{ $item->request_quantity }} Orang</td>
        </tr>
        </table>
    @endforeach

    <table style="margin-top: 30px;">
        <tr style="text-align: center;">
            <td>Dibuat Oleh,</td>
            <td>Diketahui Oleh,</td>
            <td>Disetujui Oleh,</td>
        </tr>
        <tr style="height: 60px;">
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="text-align: center;">
            <td>( {{ $record->applicant_name }} )</td>
            <td>( ________________ )</td>
            <td>( ________________ )</td>
        </tr>
    </table>
</body>
</html>
