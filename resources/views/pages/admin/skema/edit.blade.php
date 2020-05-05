@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ Edit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('admin.skema.index') ],
    ['text' => 'Edit' ],
    ['text' => 'Skema' ],
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
                        <h4 class="card-title">Edit Skema</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ url()->route('admin.skema.update', [$skema->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Judul :</label>
                                <div class="col-md-6">
                                    <input value="{{ $skema->judul }}" name="judul" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Kode :</label>
                                <div class="col-md-6">
                                    <input value="{{ $skema->kode }}" name="kode" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Admin :</label>
                                <div class="col-md-6">
                                    <select name="admin_id" class="select2 form-control" id="selectAdmin"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Kategori :</label>
                                <div class="col-md-6">
                                    <select name="kategori_id[]" class="select2 form-control" id="selectKategori" multiple="multiple"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('admin.skema.show', [$skema->id]) }}" class="btn btn-warning">
                                        <i class="ft-chevron-left"></i> Kembali
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="ft-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
    $(document).ready(() => {
        $('#selectAdmin').select2({ data: @JSON($admins->array()) });
        $('#selectAdmin').val({{ $skema->admin_id }}).trigger('change');
        $('#selectKategori').select2({ data: @JSON($kategoris->array()) });
        $('#selectKategori').val(@JSON($skema->kategori->pluck('id'))).trigger('change');
    });
    </script>
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush