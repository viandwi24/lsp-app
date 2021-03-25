<!DOCTYPE html>
<html>
<head>
	<title>FRMAK01</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "MAK-01"])

    <div class="content">
        @include('pdf.logo')
        <h6 class="title">FR-MAK-01. FORMULIR PERSETUJUAN ASESMEN DAN KERAHASIAAN</h6>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4">
                        Persetujuan Asesmen ini untuk menjamin bahwa Peserta
                        telah diberi arahan secara rinci tentang perencanaan dan proses asesmen.
                    </td>
                </tr>
            </tbody>
            <tbody style="background: greenyellow;">
                <tr>
                    <td rowspan="2" width="20%">
                        Skema Sertifikasi/ Klaster Asesmen/Unit Kompetensi
                    </td>
                    <td width="10%">Judul</td>
                    <td width="5%">:</td>
                    <td>{{ @$asesmen->skema->judul }}</td>
                </tr>
                <tr>
                    <td>Nomer</td>
                    <td width="5%">:</td>
                    <td>{{ @$asesmen->skema->kode }}</td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="2">Tuk</td>
                    <td width="5%">:</td>
                    <td>{{ @$asesmen->tuk->nama }}</td>
                </tr>
                <tr>
                    <td colspan="2">Asesor</td>
                    <td width="5%">:</td>
                    <td>{{ @$asesmen->asesor->nama }}</td>
                </tr>
                <tr>
                    <td colspan="2">Asesi</td>
                    <td width="5%">:</td>
                    <td>{{ @$asesmen->asesi->nama }}</td>
                </tr>
                <tr>
                    <th colspan="2" rowspan="3" style="vertical-align: middle;">Bukti Yang Dikumpulkan</th>
                    <th width="5%">:</th>
                    <td>Bukti TL : {{ @( !isset($asesmen->skema->frmak01->bukti_tl[0]) ) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_tl) }}</td>
                </tr>
                <tr>
                    <th width="5%">:</th>
                    <td>Bukti L : {{ @( !isset($asesmen->skema->frmak01->bukti_l[0]) ) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_l) }}</td>
                </tr>
                <tr>
                    <th width="5%">:</th>
                    <td>Bukti T : {{ @( !isset($asesmen->skema->frmak01->bukti_t[0]) ) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_t) }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div><b>Pelaksanaan asesmen disepakati pada:</b></div>
                        <table class="no-border no-margin-padding">
                            <tr>
                                <th>Tanggal</th>
                                <th>:</th>
                                <td>{{ $asesmen->jadwal->waktu_pelaksanaan }}</td>
                            </tr>
                            <tr>
                                <th>Tempat</th>
                                <th>:</th>
                                <td>{{ $asesmen->tuk->nama }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="background: #e0e0e0;">
                    <td colspan="4">
                        <div><b>Asesi :</b></div>
                        <p>
                            Saya setuju mengikuti asesmen dengan pemahaman bahwa informasi 
                            yang dikumpulkan hanya digunakan untuk pengembangan profesional 
                            dan hanya dapat diakses oleh orang tertentu saja.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div><b>Asesor :</b></div>
                        <p>
                            Menyatakan tidak akan membuka hasil pekerjaan yang saya peroleh 
                            karena penugasan saya sebagai asesor dalam pekerjaan Asesmen 
                            kepada siapapun atau organisasi apapun selain kepada pihak 
                            yang berwenang sehubungan dengan kewajiban saya sebagai Asesor 
                            yang ditugaskan oleh LSP.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered middle">
            <tr>
                <td colspan="4">
                    <table class="no-border middle">
                        <tr>
                            <td>Tanda Tangan Asesi</td>
                            <td width="5%">:</td>
                            <td>
                                <img class="ttd" src="{{ @$asesmen->asesi->data->ttd }}">
                            </td>
                            <td width="10%"></td>
                            <td>Tanggal</td>
                            <td width="5%">:</td>
                            <td>{{ \Carbon\Carbon::parse(@$asesmen->jadwal->waktu_pelaksanaan)->format('d-m-Y') }}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse(@$asesmen->frmak01->signed_asesi_at)->format('d-m-Y') }}</td> --}}
                        </tr>
                        <tr>
                            <td>Tanda Tangan Asesor</td>
                            <td width="5%">:</td>
                            <td>
                                <img class="ttd" src="{{ @$asesmen->asesor->data->ttd }}">
                            </td>
                            <td width="10%"></td>
                            <td>Tanggal</td>
                            <td width="5%">:</td>
                            <td>{{ \Carbon\Carbon::parse(@$asesmen->jadwal->waktu_pelaksanaan)->format('d-m-Y') }}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse(@$asesmen->frmak01->signed_asesor_at)->format('d-m-Y') }}</td> --}}
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>