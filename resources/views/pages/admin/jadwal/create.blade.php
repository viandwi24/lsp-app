@extends('layouts.dashboard', ['title' => 'Admin \ Jadwal \ Tambah'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Jadwal', 'link' => url()->route('admin.jadwal.index') ],
    ['text' => 'Tambah' ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Jadwal" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Jadwal</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form id="form" method="POST" action="{{ url()->route('admin.jadwal.store') }}" class="form">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Pelaksanaan :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="la la-calendar-o"></span>
                                                </span>
                                            </div>
                                            <input value="" name="tanggal" type='text' class="form-control pickadate" placeholder="Tanggal Pelaksanaan" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Waktu Pelaksanaan :</label>
                                        <input type="text" name="jam" class="form-control timepicki" placeholder="Waktu Pelaksanaan" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Pengumuman</label>
                                <textarea id="summernote" type="text" name="pengumuman" class="summernote"></textarea>
                                {{-- <div id="summernote"></div> --}}
                            </div>
                            <div class="form-group">
                                <label>Acara</label>
                                <input type="hidden" name="acara">
                                <hr>
                                <button type="button" @click="addNewRow" class="btn btn-sm btn-success"> <i class="ft-plus"></i> Tambah </button>
                                <table class="table table-hover table-bordered mt-2">
                                    <thead>
                                        <th width="5%">#</th>
                                        <th>Waktu</th>
                                        <th>Kegiatan</th>
                                        <th>...</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, i) in acara">
                                            <td>@{{ i+1 }}</td>
                                            <td>
                                                <input placeholder="Ex: 16/04/2020 - 24/04/2002" v-model="acara[i].waktu" type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input placeholder="Ex: sebuah kegiatan" v-model="acara[i].kegiatan" type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <button type="button" @click="remove(i)" class="btn btn-sm btn-danger"><i class="ft-x"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" @click="submit" class="btn btn-primary float-right">
                                <i class="ft-save"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('css-library')
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/timepicki/css/timepicki.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ assets('css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" href="{{ assets('css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/editors/summernote/summernote.js') }}"></script>
    <script src="{{ assets('vendors/timepicki/js/timepicki.js') }}"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('js')
    <script>
    $(document).ready(function() { $('#summernote').summernote({height: 300}); });
    var vm = new Vue({
        el: '#app',
        data: {
            acara: [
                { waktu: '', kegiatan: '' }
            ]
        },
        methods: {
            addNewRow() {
                this.acara.push({ waktu: '', kegiatan: '' })
            },
            remove(index) {
                if (this.acara.length == 1) return
                this.acara.splice(index, 1)
            },
            submit() {
                $('input[name=acara]').val(JSON.stringify(this.acara))
                $('form#form').submit()
            }
        },
        mounted() {
            $('.pickadate').pickadate({
                format: 'dd-mm-yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenPrefix: 'prefix__',
                hiddenSuffix: '__suffix',
                selectMonths: true,
                selectYears: true
            });
            $(".timepicki").timepicki();
        }
    })
    </script>
@endpush