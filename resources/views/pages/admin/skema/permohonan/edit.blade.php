@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ ' . $skema->judul . ' \ Permohonan \ Setujui'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => route('admin.home') ],
    ['text' => 'Skema', 'link' => route('admin.skema.index') ],
    ['text' => $skema->judul, 'link' => route('admin.skema.show', [$skema->id]) ],
    ['text' => 'Setujui'],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="bs-callout-info callout-border-left mb-2 p-1">
                    <strong>Perhatian!</strong>, Menyetujui Skema akan mengarahkan
                    permohonan asesi ke Skema yang disetujui. Tentukan Asesor yang 
                    akan menguji asesi juga.
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Setujui Skema</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ url()->route('admin.skema.permohonan.update', [$skema->id, $permohonan->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Skema :</label>
                                <div class="col-md-6">
                                    <input readonly value="{{ $skema->judul }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Asesi :</label>
                                <div class="col-md-6">
                                    <input readonly value="{{ $permohonan->asesi->nama }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-md-right">Asesor :</label>
                                <div class="col-md-6">
                                    <select name="asesor" class="select2 form-control" id="selectAsesor"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{ route('admin.skema.permohonan.index', [$skema->id, $permohonan->id]) }}" class="btn btn-warning">
                                        <i class="ft-chevron-left"></i> Kembali
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="ft-save"></i> Setujui
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
        $('#selectAsesor').select2({ data: @JSON($asesors->array()) });
    });
    </script>
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush