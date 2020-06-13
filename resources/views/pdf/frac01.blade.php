<!DOCTYPE html>
<html>
<head>
	<title>FRAC01</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "AC-01"])

    <div class="content">
        @include('pdf.logo')
        <h5 class="title">FR-AC-01. FORMULIR REKAMAN ASESMEN KOMPETENSI</h5>
        
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
                    <th class="highlight" width="25%">Tanggal Mulainya Asesmen</th>
                    <td>{{ @(\Carbon\Carbon::parse($asesmen->jadwal->waktu_pelaksanaan))->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Tanggal Selesainya Asesmen</th>
                    <td>{{ @(\Carbon\Carbon::parse($asesmen->jadwal->waktu_pelaksanaan))->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="highlight" width="25%">
                        <b>Tindak lanjut yang dibutuhkan</b><br>
                        <span>
                            (Masukkan pekerjaan tambahan dan asesmen yang diperlukan
                            untuk mencapai kompetensi)
                        </span>
                    </td>
                    <td>{{ @$asesmen->frac01->tindak_lanjut }}</td>
                </tr>
                <tr>
                    <th class="highlight" width="25%">Komentar/ Observasi oleh asesor</th>
                    <td>{{ @$asesmen->frac01->komentar }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered middle m-0" style="width: 100%">
            <tr>
                <td class="highlight" width="10%">Unit kompetensi</td>
                <td class="highlight" width="10%">Observasi demonstrasi</td>
                <td class="highlight" width="10%">Portofolio</td>
                <td class="highlight" width="10%">Pertanyaan pihak ketiga</td>
                <td class="highlight" width="10%">Pertanyaan lisan</td>
                <td class="highlight" width="10%">Pertanyaan tertulis</td>
                <td class="highlight" width="10%">Proyek kerja</td>
                <td class="highlight" width="10%">Lainnya</td>
            </tr>
            @foreach ($asesmen->frac01->bukti as $bukti)
                <tr>
                    <td>{{ $bukti->unit->judul }}</td>
                    <td class="text-center">{!! ($bukti->observasi) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->portofolio) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->pernyataan_pihak_ketiga) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->pertanyaan_lisan) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->pertanyaan_tertulis) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->proyek_kerja) ? '<div class="check"></div>' : '' !!}</td>
                    <td class="text-center">{!! ($bukti->lainnya) ? '<div class="check"></div>' : '' !!}</td>
                </tr>
            @endforeach
        </table>

        <table class="table table-bordered">
            <tr>
                <td class="highlight" width="50%">Tanda Tangan Asesi</td>
                <td width="50%">
                    @if (@$asesmen->frac01->signed_asesi_at != null)
                        <img class="ttd" src="{{ @$asesmen->asesi->data->ttd }}">
                    @endif
                </td>
                <td class="highlight" width="50%">Tanggal</td>
                <td width="50%">{{ \Carbon\Carbon::parse(@$asesmen->frac01->signed_asesi_at)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="highlight" width="50%">Tanda Tangan Asesor</td>
                <td width="50%">
                    <img class="ttd" src="{{ @$asesmen->asesor->data->ttd }}">
                </td>
                <td class="highlight" width="50%">Tanggal</td>
                <td width="50%">
                    @if (@$asesmen->frac01->signed_asesor_at != null)
                        {{ \Carbon\Carbon::parse(@$asesmen->frac01->signed_asesor_at)->format('d-m-Y') }}
                    @endif
                </td>
            </tr>
        </table>

    </div>
</body>
</html>