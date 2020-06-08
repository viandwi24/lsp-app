@extends('layouts.dashboard', ['title' => 'Asesor \ Asesmen \ ' . $asesmen->skema->judul ])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Asesmen', 'link' => route('asesor.asesi')],
    ['text' => $asesmen->skema->judul]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="FR-MAK-01 : FORMULIR PERSETUJUAN ASESMEN DAN KERAHASIAAN" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    Persetujuan Asesmen ini untuk menjamin bahwa Peserta telah 
                    diberi arahan secara rinci tentang perencanaan dan proses asesmen
                </div>
                
                <div class="card shadow">
                    <div class="card-body card-table">
                        <table class="table m-0">
                            <tr style="background: #e0e0e0;">
                                <th rowspan="2" class="text-center">Skema</th>
                                <th>Judul</th>
                                <th class="text-right">:</th>
                                <th>{{ $asesmen->skema->judul }}</th>
                            </tr>
                            <tr style="background: #e0e0e0;">
                                <th>Nomor</th>
                                <th class="text-right">:</th>
                                <th>{{ $asesmen->skema->kode }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Tuk</th>
                                <th class="text-right">:</th>
                                <td>: {{ $asesmen->tuk->nama }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Asesor</th>
                                <th class="text-right">:</th>
                                <td>{{ $asesmen->asesor->nama }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Asesi</th>
                                <th class="text-right">:</th>
                                <td>{{ $asesmen->asesi->nama }}</td>
                            </tr>
                            <tr>
                                <th colspan="2" rowspan="3">Bukti Yang Dikumpulkan</th>
                                <th class="text-right">:</th>
                                <td>Bukti TL : {{ ( $asesmen->skema->frmak01 == null) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_tl) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">:</th>
                                <td>Bukti L : {{ ( $asesmen->skema->frmak01 == null) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_l) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">:</th>
                                <td>Bukti T : {{ ( $asesmen->skema->frmak01 == null) ? "-" : implode(', ', $asesmen->skema->frmak01->bukti_t) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div><b>Pelaksanaan asesmen disepakati pada:</b></div>
                                    <div class="row">
                                        <div class="col-2"><b>Tanggal</b></div>
                                        <div class="col">: {{ $asesmen->jadwal->waktu_pelaksanaan }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2"><b>Tempat</b></div>
                                        <div class="col">: {{ $asesmen->tuk->nama }}</div>
                                    </div>
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
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="alert alert-warning">
                        <b>Perhatian!</b> Menandatangani berarti anda sudah membaca
                        dan bersedia mengikuti sesuai instruktur yang tertera.
                    </div>

                    <form action="" method="POST">
                        @csrf
                        <button class="btn btn-block btn-primary">
                            Tanda Tangani Formulir Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('css')
@endpush