@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ Edit \ Berkas'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('admin.skema.index') ],
    ['text' => 'Edit' ],
    ['text' => 'Berkas' ],
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
                        <h4 class="card-title">Edit Berkas</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a class="btn btn-sm btn-success" href="#" @click.prevent="tambahBerkas"><i class="ft-plus"></i> Tambah Berkas</a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form id="form-berkas" method="POST" action="{{ url()->route('admin.skema.update', [$skema->id]) . '?tab=berkas' }}" class="form">
                            @method('put')
                            @csrf
                            <input type="hidden" name="berkas">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="3%">#</th>
                                        <th class="text-center" width="16%">Jenis Berkas</th>
                                        <th class="text-center" width="18%">Tipe Berkas</th>
                                        <th class="text-center" width="41%">Nama</th>
                                        <th class="text-center" width="20%">Format</th>
                                        <th class="text-center" width="3%">...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, i) in berkas">
                                        <td>@{{ i+1 }}</td>
                                        <td>
                                            <select v-model="berkas[i].jenis" class="form-control">
                                                <option value="syarat">Syarat</option>
                                                <option value="pendukung">Pendukung</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select v-model="berkas[i].tipe" class="form-control">
                                                <option value="ditentukan">Ditentukan</option>
                                                <option value="kustom">Kustom</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input v-if="berkas[i].tipe == 'ditentukan'" v-model="berkas[i].nama" type="text" class="form-control form-control-sm">
                                            <input v-else placeholder="Nama Akan Dikustomisasi User Sendiri" type="text" class="form-control form-control-sm" readonly disabled>
                                        </td>
                                        <td>
                                            <select :disabled="berkas[i].tipe == 'kustom'" v-model="berkas[i].format" v-select2 class="select2 form-control" multiple="multiple" style="width: 100%;"></select>
                                        </td>
                                        <td>
                                            <button @click.prevent="hapusBerkas(i)" class="btn btn-sm btn-danger">
                                                <i class="ft-x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <a href="#" @click.prevent="tes">awe</a> --}}

                            <div class="text-right mt-2">
                                <a href="{{ route('admin.skema.show', [$skema->id]) }}" class="btn btn-warning">
                                    <i class="ft-chevron-left"></i> Kembali
                                </a>
                                <button @click.prevent="submit" class="btn btn-primary">
                                    <i class="ft-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection


@push('js')
    <script src="{{ assets('js/scripts/vue-select2.js') }}"></script>
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                berkas: @JSON($skema->berkas),
                formatSelect: [
                    { id: 'jpg', text: '.jpg' },
                    { id: 'png', text: '.png' },
                    { id: 'bmp', text: '.bmp' },
                    { id: 'jpeg', text: '.jpeg' },
                    { id: 'pdf', text: '.pdf' },
                    { id: 'doc', text: '.doc' },
                    { id: 'docx', text: '.docx' },
                ]
            },
            methods: {
                tambahBerkas() {
                    this.berkas.push({ jenis: 'syarat', tipe: 'ditentukan', nama: 'Example Document', format: []  });
                    setTimeout(() => $('.select2').select2({ data: this.formatSelect }), 10);
                },
                hapusBerkas(index) {
                    this.berkas.splice(index, 1)
                },
                submit() {
                    let result = [];
                    this.berkas.forEach(el => {
                        if (el.tipe == 'kustom')
                        {
                            el.nama = null;
                            el.format = [];
                        }
                        result.push({...el});                    
                    });
                    $('input[name=berkas]').val(JSON.stringify(result));
                    $('form#form-berkas').submit();
                },
                tes() {
                    this.berkas.push({})
                    this.berkas.splice(this.berkas.length-1, 1)
                }
            },
            mounted() {
                setTimeout(() => $('.select2').select2({ data: this.formatSelect }).trigger('change'), 200);
            }
        })
    </script>
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush
