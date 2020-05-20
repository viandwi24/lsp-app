@extends('layouts.dashboard', ['title' => 'Asesor \ Skema \ '. $skema->judul .' \ FR-PAAP-01'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesor.skema') ],
    ['text' => 'FR-PAAP-01' ],
    ['text' => 'Asesor' ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendekatan Asesmen</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        
                        {{-- wae --}}
                        @php $frpaap01 = $skema->frpaap01; @endphp
                        <form method="POST" action="{{ route('asesor.skema.frpaap01.update', [$skema->id]) }}" class="form" id="form">
                            @csrf
                            @method('put')
                            <input type="hidden" class="hidden" value="" name="unit">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Asesi :</label>
                                <div class="col-md-6">
                                    <select name="asesi" class="form-control">
                                        @foreach ($selection['asesi'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->asesi ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Tujuan Asesmen :</label>
                                <div class="col-md-6">
                                    <select name="tujuan_asesmen" class="form-control">
                                        @foreach ($selection['tujuan_asesmen'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->tujuan_asesmen ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">konteks_asesmen_lingkungan :</label>
                                <div class="col-md-6">
                                    <select name="konteks_asesmen_lingkungan" class="form-control">
                                        @foreach ($selection['konteks_asesmen_lingkungan'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->konteks_asesmen_lingkungan ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">konteks_asesmen_peluang_mengumpulan_bukti :</label>
                                <div class="col-md-6">
                                    <select name="konteks_asesmen_peluang_mengumpulan_bukti" class="form-control">
                                        @foreach ($selection['konteks_asesmen_peluang_mengumpulan_bukti'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->konteks_asesmen_peluang_mengumpulan_bukti ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">konteks_asesmen_hubungan_standar_kompetensi :</label>
                                <div class="col-md-6">
                                    <select name="konteks_asesmen_hubungan_standar_kompetensi" class="form-control">
                                        @foreach ($selection['konteks_asesmen_hubungan_standar_kompetensi'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->konteks_asesmen_hubungan_standar_kompetensi ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">konteks_asesmen_pelaku_asesmen :</label>
                                <div class="col-md-6">
                                    <select name="konteks_asesmen_pelaku_asesmen" class="form-control">
                                        @foreach ($selection['konteks_asesmen_pelaku_asesmen'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->konteks_asesmen_pelaku_asesmen ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">relevan_dikonfirmasi :</label>
                                <div class="col-md-6">
                                    <select name="relevan_dikonfirmasi" class="form-control">
                                        @foreach ($selection['relevan_dikonfirmasi'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->relevan_dikonfirmasi ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">tolak_ukur :</label>
                                <div class="col-md-6">
                                    <select name="tolak_ukur" class="form-control">
                                        @foreach ($selection['tolak_ukur'] as $item)
                                            <option value="{{ $item }}" {{ $item == $frpaap01->tolak_ukur ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


                <x-dashboard-card title="Rencana Asesmen" classBody="card-table">
                    <x-slot name="heading">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
                                {{-- <th class="vertical"><p>Observasi langsung</p></th>
                                <th class="vertical"><p>Kegiatan Struktur</p></th>
                                <th class="vertical"><p>Tanya Jawab</p></th>
                                <th class="vertical"><p>Verifikasi Portfolio</p></th>
                                <th class="vertical"><p>Review Produk</p></th> --}}
                    <div v-for="(unit, i) in units" :key="i">
                        <table class="table table-bordered m-0">
                            <tbody style="background: gray; color: white;">
                                <tr>
                                    <td width="20%;">Unit kompetensi</td>
                                    <td>: @{{ unit.judul }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered m-0 table-hover">
                            <tbody v-for="(elemen, j) in unit.elemen" :key="j">
                                <tr style="background: gainsboro;">
                                    <th width="50%">
                                        <span>Elemen @{{ j+1 }} : @{{ elemen.elemen }}</span>
                                    </th>
                                    <th width="50%"></th>
                                </tr>
                                <tr>
                                    <th>KUK</th>
                                    <th>...</th>
                                </tr>
                                <tr v-for="(kuk, k) in elemen.kuk" :key="k">
                                    <td>@{{ k+1 }}. @{{ kuk.kuk }}</td>
                                    <td>
                                        <div class="row form">
                                            <div class="col-12">
                                                <b>Hasil Observasi</b>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Jenis Bukti :</label>
                                                    <select v-model="units[i].elemen[j].kuk[k].rencana_asesmen.observasi.jenis_bukti" class="form-control form-control-sm">
                                                        <option value="L">L</option>
                                                        <option value="TL">TL</option>
                                                        <option value="T">T</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Metode dan Perangkat Asesmen :</label>
                                                    <select v-model="units[i].elemen[j].kuk[k].rencana_asesmen.observasi.metode" class="form-control form-control-sm">
                                                        <option value="CL">CL</option>
                                                        <option value="DIT">DIT</option>
                                                        <option value="DPL">DPL</option>
                                                        <option value="DPT">DPT</option>
                                                        <option value="VP">VP</option>
                                                        <option value="CUP">CUP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <b>Hasil Jawaban</b>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Jenis Bukti :</label>
                                                    <select v-model="units[i].elemen[j].kuk[k].rencana_asesmen.jawaban.jenis_bukti" class="form-control form-control-sm">
                                                        <option value="L">L</option>
                                                        <option value="TL">TL</option>
                                                        <option value="T">T</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Metode dan Perangkat Asesmen :</label>
                                                    <select v-model="units[i].elemen[j].kuk[k].rencana_asesmen.jawaban.metode" class="form-control form-control-sm">
                                                        <option value="CL">CL</option>
                                                        <option value="DIT">DIT</option>
                                                        <option value="DPL">DPL</option>
                                                        <option value="DPT">DPT</option>
                                                        <option value="VP">VP</option>
                                                        <option value="CUP">CUP</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </x-dashboard-card>


                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <a href="{{ route('asesor.skema', [$skema->id]) }}" class="btn btn-block btn-warning">
                            <i class="ft-chevron-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <button @click.prevent="submit" class="btn btn-block btn-primary">
                            <i class="ft-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection



@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                units: @JSON($skema->unit)
            },
            mounted() {
                console.log( this.units )
            },
            methods: {
                tambahUnit() {
                    let count = this.units.length + 1
                    this.units.push({ 
                        judul: 'Contoh Unit ' + count, 
                        kode: 'Contoh Kode ' + count, 
                        jenis: 'SKKNI ' + count, 
                        elemen: [
                            { elemen: 'Contoh Elemen ' + count, kuk: ['Contoh Kuk ' + count] }
                        ]
                    })
                },
                hapusUnit(index) {
                    this.units.splice(index, 1)
                },
                tambahElemen(unit) {
                    let count = this.units[unit].elemen.length + 1
                    this.units[unit].elemen.push({ elemen: 'Contoh Elemen ' + count, kuk: ['Contoh Kuk ' + count] })
                },
                hapusElemen(unit, index) {
                    if (this.units[unit].elemen.length == 1) return 
                    this.units[unit].elemen.splice(index, 1)
                },
                tambahKuk(unit, elemen) {
                    let count = this.units[unit].elemen[elemen].kuk.length + 1
                    this.units[unit].elemen[elemen].kuk.push('Contoh Kuk ' + count)
                },
                hapusKuk(unit, elemen, index) {
                    if (this.units[unit].elemen[elemen].kuk.length == 1) return 
                    this.units[unit].elemen[elemen].kuk.splice(index, 1)
                },
                submit() {
                    $('input[name=unit]').val( JSON.stringify(this.units) )
                    $('form#form').submit()
                }
            },
        })
    </script>
@endpush

@push('css')
    <style>
        .table tbody + tbody { border-top: none; }
        th.vertical, td.vertical {
            text-align:center;
            white-space:nowrap;
            g-origin:50% 50%;
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
        }
        th.vertical p, td.vertical p {
            margin:0 -100% ;
            display:inline-block;
        }
        th.vertical p:before, td.vertical p {
            content:'';
            width:0;
            padding-top:110%;/* takes width as reference, + 10% for faking some extra padding */
            display:inline-block;
            vertical-align:middle;
        }
    </style>
@endpush