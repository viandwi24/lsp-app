<!DOCTYPE html>
<html>
<head>
	<title>FRMAK03</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @include('pdf.css')
</head>
<body>
    @include('pdf.footer', ['form' => "MAK-03"])

    <div class="content">
        @include('pdf.logo')
        <h5 class="title">FR-MAK-03. FORMULIR BANDING ASESMEN</h5>
        
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


        <table class="table table-bordered">
            <tr class="highlight">
                <td>Jawablah dengan Ya atau Tidak pertanyaan-pertanyaan berikut ini :</td>
                <td>YA</td>
                <td>TIDAK</td>
            </tr>
            <tr>
                <td>Apakah Proses Banding telah dijelaskan kepada Anda?</td>
                <td class="text-center">
                    {!! (@$asesmen->frmak03->dijelaskan) ? '<div class="check"></div>' : '' !!}
                </td>
                <td class="text-center">
                    {!! (!@$asesmen->frmak03->dijelaskan) ? '<div class="check"></div>' : '' !!}
                </td>
            </tr>
            <tr>
                <td>Apakah Anda telah mendiskusikan Banding dengan Asesor?</td>
                <td class="text-center">
                    {!! (@$asesmen->frmak03->diskusi) ? '<div class="check"></div>' : '' !!}
                </td>
                <td class="text-center">
                    {!! (!@$asesmen->frmak03->diskusi) ? '<div class="check"></div>' : '' !!}
                </td>
            </tr>
            <tr>
                <td>Apakah Anda mau melibatkan “orang lain” membantu Anda dalam Proses Banding?</td>
                <td class="text-center">
                    {!! (@$asesmen->frmak03->orang_lain) ? '<div class="check"></div>' : '' !!}
                </td>
                <td class="text-center">
                    {!! (!@$asesmen->frmak03->orang_lain) ? '<div class="check"></div>' : '' !!}
                </td>
            </tr>
        </table>

        <table class="table table-bordered">
            <tr>
                <td colspan="2" class="text-center highlight">
                    Banding ini diajukan atas Keputusan Asesmen 
                    yang dibuat pada Unit Kompetensi sebagai berikut :
                </td>
            </tr>
            <tr>
                <th class="highlight">Kode Unit</th>
                <th class="highlight">Judul Unit</th>
            </tr>
            @foreach (@$asesmen->frmak03->unit as $unit)
                <tr>
                    <td>{{ @$unit->kode }}</td>
                    <td>{{ @$unit->judul }}</td>
                </tr>                
            @endforeach
        </table>

        <table class="table table-bordered">
            <tr>
                <th class="highlight">Alasan pengajuan banding sebagai berikut :</th>
                <td>{{ @$asesmen->frmak03->alasan }}</td>
            </tr>
            <tr>
                <td colspan="2">
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
                            <td>{{ \Carbon\Carbon::parse(@$asesmen->frmak03->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>



    </div>
</body>
</html>