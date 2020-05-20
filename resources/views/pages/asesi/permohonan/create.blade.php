@extends('layouts.dashboard', ['title' => 'Admin \ Permohonan \ Buat'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Permohonan', 'link' => route('asesi.permohonan.index') ],
    ['text' => 'Buat']
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row mb-4">
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
                        <div class="table-responsive">
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
                    </div>
                </x-dashboard-card>

                {{-- form --}}
                <form action="{{ route('asesi.permohonan.store', [$skema->id]) }}" method="POST">
                    @csrf
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
                            {{-- data diri --}}
                            <div class="card-body mb-0 pb-0">
                                <div class="form">
                                    <div class="form-group">
                                        <h4>Bagian 1 : Rincian Data Pemohon Sertifikasi</h4>
                                        <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal yang tepat.</p>
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
                                                    <select name="data_diri[jenis_kelamin]" required placeholder="Jenis Kelamin" type="text" class="form-control">
                                                        <option value="">---Jenis Kelamin---</option>
                                                        <option value="laki-laki" {{ old('data_diri.jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                                                        <option value="perempuan" {{ old('data_diri.jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Kebangsaan :</label>
                                                    <input value="{{ old('data_diri.kebangsaan') }}" name="data_diri[kebangsaan]" required placeholder="Kebangsaan" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Rumah :</label>
                                            <textarea name="data_diri[alamat]" required placeholder="Alamat Rumah" class="form-control">{{ old('data_diri.alamat') }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>No. Telp :</label>
                                                    <input value="{{ old('data_diri.no_telp') }}" name="data_diri[no_telp]" required placeholder="No. Telp" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Email :</label>
                                                    <input value="{{ $user->email }}" name="data_diri[email]" readonly required placeholder="Email" type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir :</label>
                                            <input value="{{ old('data_diri.pendidikan_terakhir') }}" name="data_diri[pendidikan_terakhir]" required placeholder="Pendidikan Terakhir" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- kerja --}}
                            <hr>
                            <div class="card-body mb-0 pb-0">
                                <div class="form-group">
                                    <h3>B. Data Pekerjaan Sekarang</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form">
                                    <div>
                                        <div class="form-group text-center">
                                            <div class="custom-control custom-radio mr-4" style="display: inline-block;">
                                                <input class="custom-control-input" value="1" name="bekerja" name="bekerja" type="radio" id="bekerja_true" v-model="bekerja" checked>
                                                <label class="custom-control-label" for="bekerja_true">Saya Bekerja</label>
                                            </div>
                                            <div class="custom-control custom-radio" style="display: inline-block;">
                                                <input class="custom-control-input" value="0" name="bekerja" name="bekerja" type="radio" id="bekerja_false" v-model="bekerja">
                                                <label class="custom-control-label" for="bekerja_false">Saya Tidak Bekerja</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lembaga / Perusahaan :</label>
                                            <input required :disabled="bekerja == 0" placeholder="Nama Lembaga / Perusahaan" type="text" name="data_pekerjaan[nama]" value="{{ old('data_pekerjaan.nama') }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan :</label>
                                            <input required :disabled="bekerja == 0" placeholder="Jabatan" type="text" name="data_pekerjaan[jabatan]" value="{{ old('data_pekerjaan.jabatan') }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Kantor :</label>
                                            <textarea required :disabled="bekerja == 0" placeholder="Alamat Kantor" name="data_pekerjaan[alamat]" class="form-control">{{ old('data_pekerjaan.alamat') }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>No. Telp :</label>
                                                    <input required :disabled="bekerja == 0" placeholder="No. Telp" type="text" name="data_pekerjaan[no_telp]" value="{{ old('data_pekerjaan.no_telp') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Email :</label>
                                                    <input required :disabled="bekerja == 0" placeholder="Email" type="email" name="data_pekerjaan[email]" value="{{ old('data_pekerjaan.email') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-slot>
                    </x-dashboard-card>

                    {{-- bagian 2 --}}
                    <div class="bs-callout-info callout-border-left mt-2 mb-2 p-1">
                        <strong>Perhatian!</strong>
                        <p>
                            Isi tujuan yang sesuai dengan tujuan anda untuk mengikuti
                            asesmen ini.
                        </p>
                    </div>
                    <x-dashboard-card title="Sertifikasi">
                        <x-slot name="heading">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </x-slot>

                        <x-slot name="content">
                            <div class="card-body mb-0 pb-0">
                                <div class="form">
                                    <div class="form-group">
                                        <h4>Bagian 2 : Data Sertifikasi</h4>
                                        <p>
                                            Tuliskan Judul dan Nomor Skema Sertifikasi, Tujuan Asesmen serta Daftar Unit Kompetensi sesuai kemasan 
                                            pada skema sertifikasi yang anda ajukan untuk mendapatkan pengakuan sesuai dengan latar belakang 
                                            pendidikan, pelatihan serta pengalaman kerja yang anda miliki.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="card-body">
                                <div class="form">
                                    <div>
                                        <div class="form-group"><h3>A. Sertifikasi</h3></div>
                                        @php
                                            $tujuan = ['sertifikasi' => 'Sertifikasi', 'sertifikasi_ulang' => 'Sertifikasi Ulang', 'lainnya' => 'Lainnya'];
                                        @endphp
                                        <div class="form-group">
                                            <label>Tujuan Asesmen :</label>
                                            <select placeholder="Tujuan" required name="tujuan_asesmen" class="form-control">
                                                <option value="">---Pilih Tujuan Asesmen---</option>
                                                @foreach ($tujuan as $key => $value)
                                                    <option value="{{ $key }}" {{ old('tujuan_asesmen') == $key ? 'selected' : '' }}>{{ $value }}</option>                                                    
                                                @endforeach
                                            </select>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-slot>
                    </x-dashboard-card>
                    
                    

                    {{-- bagian 2 --}}
                    <div class="bs-callout-info callout-border-left mt-2 mb-2 p-1">
                        <strong>Perhatian!</strong>
                        <ul>
                            <li>File yang diupload harus sesuai rule.</li>
                            <li>Maksimal Size File adalah 40mb.</li>
                            <li>Upload File bisa dilakukan di menu Berkas.</li>
                        </ul>
                    </div>
                    <x-dashboard-card title="Berkas Persyaratan & Pendukung" classBody="card-table">
                        <x-slot name="heading">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </x-slot>

                        <!-- body -->
                        @php
                            // dd($skema->berkas);
                        @endphp
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th width="14%">Jenis</th>
                                <th>Nama Dokumen</th>
                                <th>Format</th>
                                <th>Pilih Berkas</th>
                            </thead>
                            <tbody>
                                @foreach ($skema->berkas as $berkas)
                                    <tr>
                                        <td>Berkas {{ ucfirst($berkas->jenis) }}</td>
                                        <td>
                                            @if ($berkas->tipe == 'kustom')
                                                <input type="text" name="berkas_nama[]" class="form-control form-control-sm" placeholder="Kosongkan jika tidak mengupload file, isi nama dokumen jika melampirkan file.">
                                            @else
                                                <input type="text" name="berkas_nama[]" class="form-control form-control-sm" value="{{ $berkas->nama }}" {{ ($berkas->tipe == 'ditentukan') ? 'readonly' : '' }}>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($berkas->tipe == 'kustom')
                                                <div class="badge badge-primary">Apapun</div>
                                            @else
                                                <div class="badge badge-primary">{{ implode(',', $berkas->format) }}</div>                                                
                                            @endif
                                        </td>
                                        <td>
                                            <select name="berkas_file[]" class="select2 form-control berkas-file" style="width: 100%;"></select>
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </x-dashboard-card>


                    {{-- bagian asesment pribadi --}}
                    <div class="bs-callout-info callout-border-left mt-2 mb-2 p-1">
                        <strong>Perhatian!</strong> lakukan asesmen mandiri dengan 
                        mencentang kolom "bisa" jika sesuai.
                    </div>
                    <x-dashboard-card title="Asesmen Mandiri" classBody="card-table">
                        <x-slot name="heading">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </x-slot>

                        <!-- body -->
                        @php
                            // dd($skema->unit);
                        @endphp
                        @foreach ($skema->unit as $unit_index => $unit)
                            <table class="table table-hover table-bordered m-0">
                                <tbody>
                                    <tr style="background: #e0e0e0;">
                                        <th class="text-right" width="15%">Unit Kompetensi :</th>
                                        <th>{{ $unit->kode }} {{ $unit->judul }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-hover table-bordered m-0">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Dapatkan saya ?</th>
                                        <th width="7%">BK</th>
                                        <th width="7%">K</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    @foreach ($unit->elemen as $elemen_index => $elemen)
                                        <tr>
                                            <td colspan="4">{{ $elemen->elemen }}</td>
                                        </tr>

                                        @foreach ($elemen->kuk as $kuk_index => $kuk)
                                            <tr>
                                                <td width="5%">{{ $unit_index }}.{{ $elemen_index }}</td>
                                                <td>{{ $kuk->kuk }}</td>
                                                <td>
                                                    <input type="radio" name="kuk[{{ $unit_index }}][{{ $elemen_index }}][{{ $kuk_index }}]" value="true" checked>
                                                </td>
                                                <td>
                                                    <input type="radio" name="kuk[{{ $unit_index }}][{{ $elemen_index }}][{{ $kuk_index }}]" value="false">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    </x-dashboard-card>


                    {{-- submit --}}
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="ft-upload"></i> Kirim Permohonan
                    </button>
                </form>
                {{-- form:end --}}

            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                bekerja: {{ old('bekerja', 0) }}
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

                $('.berkas-file').select2({ data: @JSON($berkass->array()) });
            }
        })
    </script>
@endpush

@push('css')
    <style>
        .form-section { border-bottom: 1px solid #34495e; }
        tbody { border: 0!important; }
    </style>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ assets('css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" href="{{ assets('css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.date.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/picker.time.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/pickadate/legacy.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush