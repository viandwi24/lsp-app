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
                        <div class="form-group">
                            <label class="col-sm-4 col-form-label text-md-right">
                                <b>Bukti Yang Akan Dikumpulkan:</b>
                            </label>
                        </div>

                            @php
                                $buktis = [
                                    [
                                        "judul" => "Bukti TL",
                                        "items" => ["vp", "dpw"],
                                    ],
                                    [
                                        "judul" => "Bukti L",
                                        "items" => ["clo", "ppo", "dit"],
                                    ],
                                    [
                                        "judul" => "Bukti T",
                                        "items" => ["dpt", "dpl"],
                                    ],
                                ];
                            @endphp
                            
                            @foreach ($buktis as $bukti)
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label text-md-right">{{ $bukti['judul'] }} :</label>
                                    <div class="col-md-6">
                                        @foreach ($bukti['items'] as $item)
                                            @php
                                                $item = strtoupper($item);
                                                $key  = str_replace(" ", "_", strtolower($bukti['judul']));
                                            @endphp
                                            <div class="custom-control custom-checkbox">
                                                <input name="{{ $item }}" type="checkbox" class="custom-control-input" id="customCheck{{ $key }}{{ $item }}" {{ (in_array($item, $skema->frmak01->{$key}) ? 'checked' : '') }}>
                                                <label class="custom-control-label" for="customCheck{{ $key }}{{ $item }}">{{ $item }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>                                
                            @endforeach

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