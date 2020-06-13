@extends('layouts.dashboard', ['title' => 'Asesi \ Skema \ '. $asesmen->skema->judul .' \ FR-MAK-03'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesi.skema') ],
    ['text' => $asesmen->skema->judul ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" title="FR-MAK-03 : FORMULIR BANDING ASESMEN" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row mb-4">
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

                <form action="" method="post" id="form">
                    @csrf
                    <input type="hidden" name="unit">
                    <div class="card shadow">
                        <div class="card-body card-table">
                            <table class="table table-hover table-bordered m-0">
                                <tr style="background: #e0e0e0;">
                                    <td>Jawablah dengan Ya atau Tidak pertanyaan-pertanyaan berikut ini :</td>
                                    <td>YA</td>
                                    <td>TIDAK</td>
                                </tr>
                                <tr>
                                    <td>Apakah Proses Banding telah dijelaskan kepada Anda?</td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="dijelaskanTrue" name="dijelaskan" class="custom-control-input" value="true">
                                            <label class="custom-control-label" for="dijelaskanTrue">Ya</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="dijelaskanFalse" name="dijelaskan" class="custom-control-input" value="false" checked>
                                            <label class="custom-control-label" for="dijelaskanFalse">Tidak</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah Anda telah mendiskusikan Banding dengan Asesor?</td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="diskusiTrue" name="diskusi" class="custom-control-input" value="true">
                                            <label class="custom-control-label" for="diskusiTrue">Ya</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="diskusiFalse" name="diskusi" class="custom-control-input" value="false" checked>
                                            <label class="custom-control-label" for="diskusiFalse">Tidak</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah Anda mau melibatkan “orang lain” membantu Anda dalam Proses Banding?</td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="orang_lainTrue" name="orang_lain" class="custom-control-input" value="true">
                                            <label class="custom-control-label" for="orang_lainTrue">Ya</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="orang_lainFalse" name="orang_lain" class="custom-control-input" value="false" checked>
                                            <label class="custom-control-label" for="orang_lainFalse">Tidak</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span>
                                            Banding ini diajukan atas Keputusan Asesmen 
                                            yang dibuat pada Unit Kompetensi sebagai berikut :
                                        </span>
                                        <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#exampleModal">
                                            + Tambah
                                        </button>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-hover table-bordered m-0">
                                <tr>
                                    <th>Kode</th>
                                    <th>Judul</th>
                                </tr>
                                <tr v-for="(item, i) in unit_value" :key="i">
                                    <td>@{{ item.kode }}</td>
                                    <td>@{{ item.judul }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            <div class="form">
                                <div class="form-group">
                                    <label>Alasan Pengajuan Banding :</label>
                                    <textarea name="alasan" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button @click.prevent="submit" class="btn btn-primary btn-block">Buat Banding</button>
                </form>
            </div>
        </div>
    </x-dashboard-content>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <label>Pilih unit :</label>
                            <select v-model="selectUnit" class="form-control" id="selectUnitInput">
                                <option v-for="(item, i) in getUnit" :key="item.kode" :value="item.kode">@{{ item.judul }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="tambahUnit">Tambah</button>
                </div>
            </div>
        </div>
    </div>
@stop


@push('js')
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            selectUnit: null,
            unit: @JSON($asesmen->skema->unit),
            unit_value: [],
            getUnit: [],
        },
        mounted() {
            this.updateList();
            console.log( this.getUnit );
        },
        methods: {
            updateList() {
                let select = this.unit_value;
                this.getUnit = this.unit.filter(e => {
                    let s = select.find(h => h.kode === e.kode);
                    if (typeof s != 'undefined') return false;
                    return e;
                })
            },
            tambahUnit() {
                let id = $('#selectUnitInput').val();
                if (id == null) return
                let value = this.unit.find(e => e.kode === id);
                console.log(value);
                if (typeof value == 'undefined') return

                let s = this.unit_value.find(e => e.kode === value.kode);
                console.log(s);
                if (typeof s != 'undefined') return

                this.unit_value.push(value);
                this.updateList();
                $('#exampleModal').modal('hide');
            },
            submit() {
                $('form#form input[name=unit]').val( JSON.stringify(this.unit_value) );
                $('form#form').submit();
            }
        },
    })
</script>
@endpush