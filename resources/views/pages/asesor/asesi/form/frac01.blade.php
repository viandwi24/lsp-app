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
    <x-dashboard-content-header title="FR-AC-01 : REKAMAN ASESMEN  KOMPETENSI" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <form action="{{ route('asesor.asesi.frac01.post', [$asesmen->id]) }}" method="POST" id="form">
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
                                    <th>Asesi</th>
                                    <td>: {{ $asesmen->asesi->nama }}</td>
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
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'observasi'" v-model="bukti[i].observasi">
                                                <label class="custom-control-label" :for="item.unit.kode + 'observasi'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'portofolio'" v-model="bukti[i].portofolio">
                                                <label class="custom-control-label" :for="item.unit.kode + 'portofolio'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'pernyataan_pihak_ketiga'" v-model="bukti[i].pernyataan_pihak_ketiga">
                                                <label class="custom-control-label" :for="item.unit.kode + 'pernyataan_pihak_ketiga'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'pertanyaan_lisan'" v-model="bukti[i].pertanyaan_lisan">
                                                <label class="custom-control-label" :for="item.unit.kode + 'pertanyaan_lisan'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'pertanyaan_tertulis'" v-model="bukti[i].pertanyaan_tertulis">
                                                <label class="custom-control-label" :for="item.unit.kode + 'pertanyaan_tertulis'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'proyek_kerja'" v-model="bukti[i].proyek_kerja">
                                                <label class="custom-control-label" :for="item.unit.kode + 'proyek_kerja'"></label>
                                            </div>   
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox" style="display: inline;text-align: center;">
                                                <input type="checkbox" class="custom-control-input" :id="item.unit.kode + 'lainnya'" v-model="bukti[i].lainnya">
                                                <label class="custom-control-label" :for="item.unit.kode + 'lainnya'"></label>
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
                                <select name="keputusan" class="form-control">
                                    <option value="kompeten" {{ $asesmen->frac01->keputusan == 'kompeten' ? 'selected' : '' }}>kompeten</option>
                                    <option value="belum_kompeten" {{ $asesmen->frac01->keputusan == 'belum_kompeten' ? 'selected' : '' }}>Belum Kompeten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tindak Lanjut</label>
                                <input type="text" name="tindak_lanjut" class="form-control" value="{{ $asesmen->frac01->tindak_lanjut }}">
                            </div>
                            <div class="form-group">
                                <label>Komentar</label>
                                <input type="text" name="komentar" class="form-control" value="{{ $asesmen->frac01->komentar }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button @click.prevent="submit" class="btn btn-block btn-primary">
                            Simpan Formulir
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