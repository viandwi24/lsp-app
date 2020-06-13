@extends('layouts.dashboard', ['title' => 'Asesor \ Asesmen \ ' . $asesmen->skema->judul ])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesi.skema') ],
    ['text' => $asesmen->skema->judul]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="FR-AC-01 : REKAMAN ASESMEN  KOMPETENSI" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <form action="" method="POST" id="form">
            @csrf
            <input type="hidden" name="bukti">

            <div class="row">
                <div class="col-12">
                    <!-- description -->
                    <div class="card shadow">
                        <div class="card-body p-0">
                            <table class="table m-0">
                                <tr>
                                    <th>Skema</th>
                                    <td>: {{ $asesmen->skema->judul }}</td>
                                </tr>
                                <tr>
                                    <th>Asesor</th>
                                    <td>: {{ $asesmen->asesor->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Admin</th>
                                    <td>: {{ $asesmen->skema->admin->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tuk</th>
                                    <td>: {{ $asesmen->tuk->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Jadwal</th>
                                    <td>: {{ $asesmen->jadwal->waktu_pelaksanaan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- other -->
                    <div class="card shadow">
                        <div class="card-body card-table">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <th width="30%">Judul Unit Kompetensi</th>
                                        <th width="10%">Observasi Demonstrasi</th>
                                        <th width="10%">Portofolio</th>
                                        <th width="10%">Pernyataan Pihak Ketiga</th>
                                        <th width="10%">Pertanyaan Lisan</th>
                                        <th width="10%">Pertanyaan Tertulis</th>
                                        <th width="10%">Proyek Kerja</th>
                                        <th width="10%">Lainnya</th>
                                    </tr>
                                    <tr v-for="(item, i) in bukti">
                                        <td>@{{ item.unit.judul }}</td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].observasi">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].portofolio">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].pernyataan_pihak_ketiga">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].pertanyaan_lisan">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].pertanyaan_tertulis">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].proyek_kerja">
                                                <i class="la la-check"></i>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="bukti[i].lainnya">
                                                <i class="la laeck"></i>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- other -->
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Keputusan</label>
                                <input readonly type="text" name="tindak_lanjut" class="form-control" value="{{ $asesmen->frac01->keputusan == 'kompeten' ? "Kompeten" : "Belum Kompeten" }}">
                            </div>
                            <div class="form-group">
                                <label>Tindak Lanjut</label>
                                <input readonly type="text" name="tindak_lanjut" class="form-control" value="{{ $asesmen->frac01->tindak_lanjut }}">
                            </div>
                            <div class="form-group">
                                <label>Komentar</label>
                                <input readonly type="text" name="komentar" class="form-control" value="{{ $asesmen->frac01->komentar }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-block btn-primary">
                            Tanda Tangani Formulir Ini.
                        </button>
                    </div>


                </div>
            </div>
        </form>
    </x-dashboard-content>
@stop


@push('js')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                bukti: @JSON($asesmen->frac01->bukti)
            },
            mounted() {
                console.log(this.bukti)
            },
            methods: {
                submit() {
                    $('input[name=bukti]').val( JSON.stringify(this.bukti) )
                    $('form#form').submit()
                }
            }
        })
    </script>
@endpush