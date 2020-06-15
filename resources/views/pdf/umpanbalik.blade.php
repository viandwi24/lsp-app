<!DOCTYPE html>
<html>
<head>
	<title>UMPANBALIK</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "MAK-03"])

    <div class="content">
        @include('pdf.logo')
        <h5 class="title">FORMULIR UMPAN BALIK</h5>
        
        <!-- keterangan -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th rowspan="2" class="highlight" width="25%">Skema Sertifikasi/ Klaster Asesmen</th>
                    <th class="highlight">Judul</th>
                    <td>{{ @$asesmen->skema->judul }}</td>
                </tr>
                <tr>
                    <th class="highlight">Kode</th>
                    <td>{{ @$asesmen->skema->kode }}</td>
                </tr>
                <tr>
                    <th colspan="2" class="highlight" width="25%">Asesi</th>
                    <td>{{ @$asesmen->asesi->nama }}</td>
                </tr>
                <tr>
                    <th colspan="2" class="highlight" width="25%">Asesor</th>
                    <td>{{ @$asesmen->asesor->nama }}</td>
                </tr>
                <tr>
                    <th colspan="2" class="highlight" width="25%">Tempat Uji</th>
                    <td>{{ @$asesmen->tuk->nama }}</td>
                </tr>
                <tr>
                    <th colspan="2" class="highlight" width="25%">Tanggal Asesmen</th>
                    <td>{{ @(\Carbon\Carbon::parse($asesmen->jadwal->waktu_pelaksanaan))->format('d-m-Y') }}</td>
                </tr>
            </tbody>
        </table>


        <table class="table table-bordered normal">
            <thead>
                <tr class="text-center highlight">
                    <th rowspan="2" style="vertical-align: middle;">Komponen Umpan Balik</th>
                    <th colspan="2" style="vertical-align: middle;">Hasil</th>
                    <th rowspan="2" style="vertical-align: middle;">Catatan/Komentar Peserta</th>
                </tr>
                <tr class="text-center highlight">
                    <th style="vertical-align: middle;">Ya</th>
                    <th style="vertical-align: middle;">Tidak</th>
                </tr>
            </thead>
            @foreach ($asesmen->umpanbalik->data as $item)       
            <tr>
                <td>{{ @$item->pertanyaan }}</td>
                <td>{!! (@$item->hasil) ? '<div class="check"></div>' : '' !!}</td>
                <td>{!! (@!$item->hasil) ? '<div class="check"></div>' : '' !!}</td>
                <td>{{ @$item->komentar }}</td>
            </tr>        
            @endforeach
            <tr>
                <td colspan="4">
                    <div>
                        <p><b>Catatan/komentar lainnya (apabila ada)</b></p>
                        {{ @$asesmen->umpanbalik->catatan }}
                    </div>
                </td>
            </tr>
        </table>



    </div>
</body>
</html>