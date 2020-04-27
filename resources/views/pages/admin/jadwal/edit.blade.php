@extends('layouts.dashboard', ['title' => 'Admin \ Jadwal \ Edit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Jadwal', 'link' => url()->route('admin.jadwal.index') ],
    ['text' => 'Edit Jadwal' ]
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
                        <h4 class="card-title">Edit Jadwal</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form id="form" method="POST" action="{{ url()->route('admin.jadwal.update', [$jadwal->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input value="{{ $jadwal->nama }}" type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pengumuman</label>
                                <textarea id="summernote" type="text" name="pengumuman" class="summernote">{{  $jadwal->pengumuman }}</textarea>
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
                                        <th width="6%">...</th>
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
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/editors/summernote/summernote.js') }}"></script>
@endpush

@push('js')
    <script>
    $(document).ready(function() { $('#summernote').summernote({height: 300}); });
    var vm = new Vue({
        el: '#app',
        data: {
            acara: @json($jadwal->acara)
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
        }
    })
    </script>
@endpush