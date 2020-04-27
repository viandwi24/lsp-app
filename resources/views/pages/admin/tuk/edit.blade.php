@extends('layouts.dashboard', ['title' => 'Admin \ Tempat Uji Kompetensi \ Edit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Tuk', 'link' => url()->route('admin.tuk.index') ],
    ['text' => 'Edit Tuk' ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Tuk" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Tuk</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ url()->route('admin.tuk.update', [$tuk->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input value="{{ $tuk->nama }}" type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input value="{{ $tuk->alamat }}" type="text" name="alamat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>No Telp</label>
                                <input value="{{ $tuk->no_telp }}" type="number" name="no_telp" class="form-control" onkeypress="return isNumber(event)" onpaste="return false;">
                            </div>
                            <button class="btn btn-primary float-right">
                                <i class="ft-save"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ( (charCode > 31 && charCode < 48) || charCode > 57) {
                return false;
            }
            return true;
        }
    </script>
@endpush