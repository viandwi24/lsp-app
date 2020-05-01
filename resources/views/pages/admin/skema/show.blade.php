@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ Tambah'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => route('admin.home') ],
    ['text' => 'Skema', 'link' => route('admin.skema.index') ],
    ['text' => 'Manajemen' ]
];
@endphp

@section('content') 
    <div class="row">    
        <div class="col-xl-9 col-lg-6 col-md-12 col-sm-12">
            <!-- header -->
            <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />

            <!-- content -->
            <x-dashboard-content>
                <div class="row">
                    <x-statistic-card col="xl-4,12" title="Unit" :value="count($skema->unit)" bg="bg-info" icon="ft-list" fg="text-primary" />
                    <x-statistic-card col="xl-4,12" title="Asesor" :value="$skema->asesor()->count()" bg="bg-success" icon="ft-users" fg="text-success" />
                    <x-statistic-card col="xl-4,12" title="Tempat Uji" :value="$skema->tuk()->count()" bg="bg-danger" icon="ft-map-pin" fg="text-danger" />
                    <x-statistic-card col="xl-4,12" title="Jadwal" :value="$skema->jadwal()->count()" bg="bg-warning" icon="ft-calendar" fg="text-warning" />
                </div>
                @foreach ($dashboardWidget as $item)
                    {!! $item !!}
                @endforeach

            </x-dashboard-content>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Umum</div>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-book"></i> Edit Skema</a>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) . '?tab=unit' }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-list"></i> Edit Unit</a>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) . '?tab=berkas' }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-folder"></i> Edit Berkas</a>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) . '?tab=asesor' }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-users"></i> Edit Asesor</a>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) . '?tab=tuk' }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-map-pin"></i> Edit Tuk</a>
                    <a href="{{ route('admin.skema.edit', [$skema->id]) . '?tab=jadwal' }}" class="btn btn-sm btn-block btn-outline-info"><i class="ft-calendar"></i> Edit Jadwal</a>
                </div>
                <div class="card-body" style="border-top: 1px solid #F9FAFD;">
                    <div class="card-title">Tambahan</div>
                    @foreach ($dashboardMenu as $item)
                        <a href="{{ $item['link'] }}" class="btn btn-sm btn-block btn-outline-info">{!! $item['text'] !!}</a>
                    @endforeach
                    {{-- <a href="#" class="btn btn-sm btn-block btn-outline-info"><i class="ft-book"></i> Assesment</a>
                    <a href="#" class="btn btn-sm btn-block btn-outline-info"><i class="ft-book"></i> Feedback</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>.list-group:first-child, .list-group-item:first-child { border-radius: 0; }</style>
@endpush