<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #000;
            padding: 12px 14px;
        }

        /* table { table-layout: fixed; } */

        /* ══ HEADER ══ */
        .header-outer { width: 100%; border-collapse: collapse; border: 1px solid #000; }
        .header-outer td { border: 1px solid #000; padding: 0; vertical-align: middle; }

        .logo-cell { width: 100px; text-align: center; padding: 6px 4px; vertical-align: middle; }
        .logo-cell img { width: 95px; height: 60px; }

        .title-formulir   { text-align: center; font-weight: bold; font-size: 11px; padding: 5px 2px; vertical-align: middle; }
        .title-permintaan { text-align: center; font-weight: bold; font-size: 11px; padding: 5px 2px; vertical-align: middle; }

        .meta-cell { width: 250px; padding: 0; vertical-align: top; }
        .meta-div  { padding: 3px 2px; font-size: 9px; border-bottom: 1px solid #000; }
        .meta-div:last-child { border-bottom: none; }

        /* ══ IDENTITY ══ */
        .identity-table { width: 100%; border-collapse: collapse; border: 1px solid #000; border-top: none; }
        .identity-table td { padding: 4px 10px; border: none; width: 50%; font-size: 9px; }
        .id-label { display: inline-block; min-width: 120px; }

        /* ══ SECTION HEADING ══ */
        .section-heading {
            border: 1px solid #000; border-top: none;
            text-align: center; font-weight: bold; font-size: 9.5px; padding: 3px;
        }

        /* ══ KUALIFIKASI TABLE ══ */
        .kual-table { width: 100%; border-collapse: collapse; border: 1px solid #000; border-top: none; }
        .kual-table td { border: 1px solid #000; padding: 4px 7px; vertical-align: top; font-size: 9px; }

        .lbl  { font-weight: normal; margin-bottom: 2px; color: #222; }
        .left-half  { width: 50%; }
        .right-half { width: 50%; }

        /* Item list */
        .item-list { margin: 0; padding: 0; list-style: none; }
        .item-list li { font-size: 9px; line-height: 1.4; padding: 0; }
        .item-no { display: inline-block; font-weight: bold; min-width: 14px; color: #555; }

        /* ══ CHECKBOX ══ */
        .cb-wrap { display: inline-block; margin-right: 7px; white-space: nowrap; }
        .cb-box {
            display: inline-block; width: 9px; height: 9px;
            border: 1px solid #000; vertical-align: middle;
            margin-right: 2px; text-align: center; line-height: 9px; font-size: 7px;
        }

        .equip-item { margin-bottom: 3px; padding-bottom: 3px; }
        .equip-item:last-child { margin-bottom: 0; padding-bottom: 0; }
        .equip-item-label { font-size: 8.5px; color: #555; margin-bottom: 2px; }

        /* ══ FULL-WIDTH BOX ══ */
        .full-box { width: 100%; border-collapse: collapse; border: 1px solid #000; border-top: none; }
        .full-box td { padding: 5px 7px; vertical-align: top; font-size: 9px; height: 100px; }

        .placeNDate { margin-top: 24px; margin-bottom: 2px; font-size: 9px; }

        /* ══ APPROVAL ══ */
        .approval-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .approval-table td { border: 1px solid #000; padding: 4px 7px; vertical-align: top; font-size: 9px; width: 25%; }
        .sign-header { font-weight: bold; text-align: center; }
        .sign-space  { height: 70px; }
    </style>
</head>
<body>

@php
    /* ── embed logo sebagai base64 agar DomPDF bisa render ── */
    $logoPath = public_path('logo/acs-logo.png');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    }
@endphp

{{-- ══ HEADER ══ --}}
<table class="header-outer">
    <tr>
        <td class="logo-cell" rowspan="2">
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" alt="Logo ABACUS">
            @else
                <span style="font-size:9px; font-weight:bold;">ABACUS</span>
            @endif
        </td>
        <td class="title-formulir" style="border-bottom:1px solid #000;">FORMULIR</td>
        <td class="meta-cell" rowspan="2">
            <div class="meta-div">
                Nomor Dokumen Formulir :<br>
                <strong>01B/ACS-HCM/FRM/2024</strong>
            </div>
            <div class="meta-div">Revisi : 01</div>
            <div class="meta-div">Tanggal Efektif : 1 Januari 2024</div>
            <div class="meta-div">Biro : Human Capital Management</div>
        </td>
    </tr>
    <tr>
        <td class="title-permintaan">PERMINTAAN SDM</td>
    </tr>
</table>

{{-- ══ IDENTITY ══ --}}
<table class="identity-table">
    <tr>
        <td><span class="id-label">Nama</span>: {{ $record->applicant_name }}</td>
        <td><span class="id-label">No. Permintaan SDM</span>: {{ $record->fps_number }}</td>
    </tr>
    <tr>
        <td><span class="id-label">Jabatan</span>: {{ ucwords(strtolower($record->applicant_position)) }}</td>
        <td><span class="id-label">Tanggal Permintaan</span>: {{ $record->request_date->locale('id')->translatedFormat('d F Y') }}</td>
    </tr>
    <tr>
        <td><span class="id-label">Wilayah</span>: {{ ucwords(strtolower($record->applicant_region)) }}</td>
        <td><span class="id-label">Tanggal Dibutuhkan</span>: {{ $record->needed_date->locale('id')->translatedFormat('d F Y') }}</td>
    </tr>
</table>

{{-- ══ PERMINTAAN & KUALIFIKASI SDM ══ --}}
<div class="section-heading">Permintaan &amp; Kualifikasi SDM</div>

<table class="kual-table">

    {{-- GRUP 1: Jumlah + Jabatan | Persyaratan rowspan=2 --}}
    <tr>
        <td class="left-half" style="border-bottom:1px solid #000;">
            <div class="lbl">Jumlah Permintaan :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->request_quantity }} Orang</li>
                @endforeach
            </ul>
        </td>
        <td class="right-half" rowspan="2" style="vertical-align:top;">
            <div class="lbl">Persyaratan/Pengalaman Kerja/Kompetensi :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->work_requirements ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="left-half">
            <div class="lbl">Jabatan :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ ucwords(strtolower($item->position->name ?? '-')) }}</li>
                @endforeach
            </ul>
        </td>
    </tr>

    {{-- GRUP 2: Pendidikan + Jurusan | Keahlian rowspan=2 --}}
    <tr>
        <td class="left-half" style="border-bottom:1px solid #000;">
            <div class="lbl">Tingkat Pendidikan :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->education_level ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
        <td class="right-half" rowspan="2" style="vertical-align:top;">
            <div class="lbl">Keahlian/Keterampilan Khusus :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->special_skills ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="left-half">
            <div class="lbl">Jurusan :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->major ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>

    {{-- GRUP 3: Kelamin + Status Kawin | Uraian Tugas rowspan=2 --}}
    <tr>
        <td class="left-half" style="border-bottom:1px solid #000;">
            <div class="lbl">Jenis Kelamin :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span>
                    @if($item->gender==='L') Laki-laki
                    @elseif($item->gender==='P') Perempuan
                    @else Laki-laki/Perempuan @endif
                </li>
                @endforeach
            </ul>
        </td>
        <td class="right-half" rowspan="2" style="vertical-align:top;">
            <div class="lbl">Uraian Tugas :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->job_description ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="left-half">
            <div class="lbl">Status Perkawinan :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->marital_status ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>

    {{-- GRUP 4: Usia | Pertanggungjawaban --}}
    <tr>
        <td class="left-half">
            <div class="lbl">Usia :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->age_range ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
        <td class="right-half">
            <div class="lbl">Pertanggungjawaban Tugas Kepada :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span> {{ $item->report_to ?? '-' }}</li>
                @endforeach
            </ul>
        </td>
    </tr>

    {{-- GRUP 5: Status HK | Kebutuhan Perlengkapan --}}
    <tr>
        <td class="left-half" style="vertical-align:top;">
            <div class="lbl">Status Hubungan Kerja :</div>
            <ul class="item-list">
                @foreach($record->items as $i => $item)
                <li><span class="item-no">{{ $i+1 }}.</span>
                    @if($item->employment_status==='intern') Pemagang
                    @elseif($item->employment_status==='contract') Kontrak
                    @elseif($item->employment_status==='permanent') Tetap
                    @else {{ $item->employment_status }} @endif
                </li>
                @endforeach
            </ul>
        </td>
        <td class="right-half" style="vertical-align:top;">
            <div class="lbl">Kebutuhan Perlengkapan/Peralatan Kerja :</div>
            @foreach($record->items as $i => $item)
            <div class="equip-item">
                <div class="equip-item-label">{{ $i+1 }}. {{ ucwords(strtolower($item->position->name ?? '-')) }}</div>
                <br>
                <div>
                    <span class="cb-wrap">
                        <span class="cb-box">{{ $item->need_work_desk ? 'V':'' }}</span>Meja Kerja
                    </span>
                    <span class="cb-wrap">
                        <span class="cb-box">{{ $item->need_computer_laptop ? 'V':'' }}</span>Komputer/Laptop
                    </span>
                    <span class="cb-wrap">
                        <span class="cb-box">{{ $item->need_uniform ? 'V':'' }}</span>Seragam
                    </span>
                    <span class="cb-wrap">
                        <span class="cb-box">{{ $item->need_email ? 'V':'' }}</span>Email
                    </span>
                    <span class="cb-wrap">
                        <span class="cb-box">{{ $item->other_needs ? 'V':'' }}</span>Lainnya {{ $item->other_needs }}
                    </span>
                </div>
            </div>
            @endforeach
        </td>
    </tr>
</table>

{{-- ══ ALASAN PERMINTAAN ══ --}}
<div class="section-heading">Alasan Permintaan Penambahan/Penggantian SDM</div>
<table class="full-box">
    <tr>
        <td>
            <strong>Penjelasan :</strong> {{ $record->request_reason }}
        </td>
    </tr>
</table>

{{-- ══ ALASAN DISETUJUI / DITOLAK ══ --}}
<div class="section-heading">Alasan (Disetujui/Ditolak)</div>
<table class="full-box">
    <tr>
        <td>
            <strong>Catatan :</strong>
            @if($record->result_reason) {{ $record->result_reason }} @endif
        </td>
    </tr>
</table>

<div class="placeNDate">_____________ , _______________________</div>

{{-- ══ TANDA TANGAN ══ --}}
<table class="approval-table">
    <tr>
        <td class="sign-header">Dibuat,</td>
        <td class="sign-header" colspan="2">Diketahui,</td>
        <td class="sign-header">Disetujui,</td>
    </tr>
    <tr>
        <td class="sign-space"></td>
        <td class="sign-space"></td>
        <td class="sign-space"></td>
        <td class="sign-space"></td>
    </tr>
    <tr>
        <td>
            Nama &nbsp;&nbsp;: {{ $record->applicant_name }}<br>
            Jabatan : {{ ucwords(strtolower($record->applicant_position)) }}
        </td>
        <td>
            Nama &nbsp;&nbsp;: ________________<br>
            Jabatan : Kepala Wilayah
        </td>
        <td>
            Nama &nbsp;&nbsp;: ________________<br>
            Jabatan : Kepala Biro HCM
        </td>
        <td>
            Nama &nbsp;&nbsp;: ________________<br>
            Jabatan : Kadiv/Wakadiv/Direktur
        </td>
    </tr>
</table>

</body>
</html>
