<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>FRAI01</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "AI-01"])

    <div class="content">
        @include('pdf.logo')
        <h5 class="title">FR-AI-01. CEKLIS OBSERVASI UNTUK AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</h5>
        
        <!-- keterangan -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="highlight" width="25%">Asesi</th>
                    <td>{{ @$asesmen->asesi->nama }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Asesor</th>
                    <td>{{ @$asesmen->asesor->nama }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Skema</th>
                    <td>{{ @$asesmen->skema->judul }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Tempat Uji</th>
                    <td>{{ @$asesmen->tuk->nama }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Waktu Pelaksanaan</th>
                    <td>{{ @(\Carbon\Carbon::parse($asesmen->jadwal->waktu_pelaksanaan))->format('d-m-Y') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- perunit -->
        @php $data = $asesmen->frai01->data; @endphp
        @foreach ($data as $unit)
            <table class="table table-bordered middle">
                <thead>
                    <tr class="highlight">
                        <td colspan="7">{{ @$unit->kode }} {{ @$unit->judul }}</td>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Elemen</th>
                        <th>Kriteria Unjuk Kerja</th>
                        <th>Benchmark (SOP / spesifikasi produk industri)</th>
                        <th>K</th>
                        <th>BK</th>
                        <th>Penilaian Lanjut</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($unit->elemen as $elemen)
                        <tr>
                            <td rowspan="{{ count($elemen->kuk) }}">{{ $i++ }}</td>
                            <td rowspan="{{ count($elemen->kuk) }}">{{ @$elemen->elemen }}</td>
                            <td>{{ @$elemen->kuk[0]->kuk }}</td>
                            <td>{{ @$elemen->kuk[0]->benchmark }}</td>
                            <td>{!! @($elemen->kuk[0]->pilihan) ? '<div class="check"></div>' : "" !!}</td>
                            <td>{!! @(!$elemen->kuk[0]->pilihan) ? '<div class="check"></div>' : "" !!}</td>
                            <td>{{ @$elemen->kuk[0]->penilaian }}</td>
                        </tr>
                        @foreach ($elemen->kuk as $index => $kuk)
                            @php if($index == 0) continue; @endphp
                            <tr>
                                <td>{{ @$kuk->kuk }}</td>
                                <td>{{ @$kuk->benchmark }}</td>
                                <td>{!! @($kuk->pilihan) ? '<div class="check"></div>' : "" !!}</td>
                                <td>{!! @(!$kuk->pilihan) ? '<div class="check"></div>' : "" !!}</td>
                                <td>{{ @$kuk->penilaian }}</td>
                            </tr>                             
                        @endforeach
                    @endforeach
                </tbody>
            </table>                
        @endforeach

        <!-- kesimpulan -->
        <table class="table table-bordered m-0">
            <tbody>
                <tr>
                    <th class="highlight" width="50%">Kinerja Kandidat adalah :</th>
                    <td width="25%">
                        @if (@$asesmen->frai01->kinerja == "memuaskan")
                            <div class="check"></div>
                            <b>Memuaskan</b>
                        @elseif (@$asesmen->frai01->kinerja == "tidak_memuaskan")
                            <strike>Memuaskan</strike>
                        @else
                            Memuaskan
                        @endif
                    </td>
                    <td width="25%">
                        @if (@$asesmen->frai01->kinerja == "tidak_memuaskan")
                            <div class="check"></div>
                            <b>Tidak Memuaskan</b>
                        @elseif (@$asesmen->frai01->kinerja == "memuaskan")
                            <strike>Tidak Memuaskan</strike>
                        @else
                            Tidak Memuaskan
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Umpan Balik</th>
                    <td colspan="2">{{ @$asesmen->frai01->catatan }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Tanda Tangan Asesi</th>
                    <td colspan="2">
                        <img class="ttd" src="{{ @$asesmen->asesi->data->ttd }}">
                    </td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Tanda Tangan Asesor</th>
                    <td colspan="2">
                        <img class="ttd" src="{{ @$asesmen->asesor->data->ttd }}">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>