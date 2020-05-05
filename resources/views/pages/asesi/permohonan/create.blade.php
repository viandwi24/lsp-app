@extends('layouts.dashboard', ['title' => 'Admin \ Permohonan \ Buat'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Permohonan', 'link' => route('asesi.permohonan.index') ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header :title="$skema->judul" :breadcrumb="$breadcrumb" type="2-col" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="bs-callout-info callout-border-left mb-2 p-1">
                    <strong>Perhatian!</strong>
                    <p>
                        Pastikan informasi skema berikut sesuai dengan skema yang
                        ingin anda ikuti.
                    </p>
                </div>
                <div class="bs-callout-info callout-border-left mb-2 p-1">
                    <strong>Perhatian!</strong>
                    <p>
                        Formulir ini membutuhkan tanda tangan anda, membuat tanda tangan
                        bisa anda akses melalui Halaman Profil.
                    </p>
                </div>
                <x-dashboard-card title="Skema">
                    <x-slot name="heading">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- body -->
                    <div class="form">
                        <div class="form-group">
                            <label>Judul</label>
                            <input value="{{ $skema->judul }}" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode</label>
                            <input value="{{ $skema->kode }}" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Admin</label>
                            <input value="{{ $skema->admin->nama }}" type="text" class="form-control" readonly>
                        </div>

                        <table class="table table-hover table-bordered">
                            <thead>
                                <th width="8%">#</th>
                                <th>Kode</th>
                                <th>Unit</th>
                                <th width="25%">Jenis</th>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($skema->unit as $unit)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $unit->kode }}</td>
                                        <td>{{ $unit->judul }}</td>
                                        <td>{{ $unit->jenis }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-dashboard-card>

                <div class="bs-callout-info callout-border-left mt-2 mb-2 p-1">
                    <strong>Perhatian!</strong>
                    <p>
                        Isi data diri sesuai dengan asli, nama dan email dapat diubah
                        di Halaman Profil, harap diingat ketika Formulir di kirim, nama
                        dan email tidak akan bisa diubah.
                    </p>
                </div>
                <x-dashboard-card title="Data Pribadi">
                    <x-slot name="heading">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <x-slot name="content">
                        <div class="card-body mb-0 pb-0">
                            <div class="form">
                                <div class="form-group">
                                    <h4>Bagian 1 : Rincian Data Pemohon Sertifikasi</h4>
                                    <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda pada saat ini.</p>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="card-body">
                            <div class="form">
                                <div>
                                    <div class="form-group"><h3>A. Data Diri</h3></div>
                                    <div class="form-group">
                                        <label>Nama Lengkap :</label>
                                        <input value="{{ $user->nama }}" name="data_diri[nama]" readonly required placeholder="Nama Lengkap" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir :</label>
                                                <input value="{{ old('data_diri.tempat_lahir') }}" name="data_diri[tempat_lahir]" required placeholder="Tempat Lahir" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir :</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <span class="la la-calendar-o"></span>
                                                      </span>
                                                    </div>
                                                    <input value="{{ old('data_diri.tanggal_lahir') }}" name="data_diri[tanggal_lahir]" type='text' class="form-control pickadate" placeholder="Tanggal Lahir" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Jenis Kelamin :</label>
                                                <select required placeholder="Jenis Kelamin" type="text" class="form-control">
                                                    <option value="">---Jenis Kelamin---</option>
                                                    <option value="laki-laki">Laki - Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Kebangsaan :</label>
                                                <input required placeholder="Kebangsaan" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Rumah :</label>
                                        <textarea required placeholder="Alamat Rumah" class="form-control"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>No. Telp :</label>
                                                <input required placeholder="No. Telp" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Email :</label>
                                                <input value="{{ $user->email }}" readonly required placeholder="Email" type="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pendidikan Terakhir :</label>
                                        <input required placeholder="Pendidikan Terakhir" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-slot>

                    <!-- body -->
                </x-dashboard-card>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
            },
            methods: {
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
            }
        })
    </script>
@endpush

@push('css')
    <style>
        .form-section { border-bottom: 1px solid #34495e; }
    </style>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ assets('css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" href="{{ assets('css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript"></script>
@endpush