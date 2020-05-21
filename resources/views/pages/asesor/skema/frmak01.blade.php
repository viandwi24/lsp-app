@extends('layouts.dashboard', ['title' => 'Asesor \ Skema \ '. $skema->judul .' \ FR-MAK-01'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesor.skema') ],
    ['text' => 'FR-MAK-01' ],
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
                <x-dashboard-card title="Edit Formulir FR-MAK-01" classBody="card-table">
                    <x-slot name="heading">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
                    <form method="POST" action="{{ route('asesor.skema.frmak01.update', [$skema->id]) }}" class="form" id="form">
                        @csrf
                        @method('put')
                        <input type="hidden" class="hidden" value="" name="unit">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Bukti Yang Akan Dikumpulkan:</label>
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input name="bukti_tl" type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Bukti TL (Bukti Tidak Langsung) : VP, DPW</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="bukti_l" type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Bukti L (Bukti Tidak) : CLO, PPO, DIT</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input name="bukti_t" type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Bukti T (Bukti Tidak) : DPT, DPL</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </x-dashboard-card>




                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <a href="{{ route('asesor.skema', [$skema->id]) }}" class="btn btn-block btn-warning">
                            <i class="ft-chevron-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <button onclick="$('form#form').submit();" class="btn btn-block btn-primary">
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
        
    </script>
@endpush

@push('css')
@endpush