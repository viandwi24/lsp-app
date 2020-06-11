<!DOCTYPE html>
<html>
<head>
	<title>FRAI02</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "AI-02"])

    <div class="content">
        @include('pdf.logo')
        <h5 class="title">FR-AI-02. PERTANYAAN UNTUK MENDUKUNG OBSERVASI</h5>
        
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

        <!-- pertanyaan -->
        @foreach ($asesmen->frai02->data as $unit)
            <table class="table table-bordered">
                <tr class="highlight">
                    <td colspan="3">{{ $unit->kode }} / {{ $unit->judul }}</td>
                </tr>
                <tr>
                    <td colspan="2">Pertanyaan yang harus dijawab oleh kandidat</td>
                    <td width="25%">Respon yang memuaskan<br>Ya/Tidak</td>
                </tr>
                @if (count($unit->pertanyaan) == 0)
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada pertanyaan.</td>
                    </tr>
                @endif
                @php $i = 1; @endphp
                @foreach ($unit->pertanyaan as $pertanyaan)
                    <tr>
                        <td rowspan="2" class="highlight" width="5%" style="vertical-align: middle;">{{ $i++ }}</td>
                        <td><b>{{ $pertanyaan->pertanyaan }}</b></td>
                        <td rowspan="2">{{ ($pertanyaan->memuaskan) ? "Ya" : "Tidak" }}</td>
                    </tr>
                    <tr>
                        <td><b>Tanggapan : </b> {{ $pertanyaan->jawaban }}</td>
                    </tr>
                @endforeach
            </table>
        @endforeach

        <!-- kesimpulan -->
        <table class="table table-bordered m-0">
            <tbody>
                <tr>
                    <th class="highlight" width="50%">Pengetahuan Kandidat adalah :</th>
                    <td width="25%">
                        @if (@$asesmen->frai02->pengetahuan == "memuaskan")
                            <div class="check"></div>
                            <b>Memuaskan</b>
                        @elseif (@$asesmen->frai02->pengetahuan == "tidak_memuaskan")
                            <strike>Memuaskan</strike>
                        @else
                            Memuaskan
                        @endif
                    </td>
                    <td width="25%">
                        @if (@$asesmen->frai02->pengetahuan == "tidak_memuaskan")
                            <div class="check"></div>
                            <b>Tidak Memuaskan</b>
                        @elseif (@$asesmen->frai02->pengetahuan == "memuaskan")
                            <strike>Tidak Memuaskan</strike>
                        @else
                            Tidak Memuaskan
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Umpan Balik</th>
                    <td colspan="2">{{ @$asesmen->frai02->catatan }}</td>
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