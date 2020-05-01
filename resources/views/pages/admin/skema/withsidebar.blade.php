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
    <x-dashboard-content-sidebar type="right" :sticky="true">
        <div class="category-title pb-1">
          <h6>Menu</h6>
        </div>
    </x-dashboard-content-sidebar>

    <x-dashboard-content-wrapper type="left">
        <!-- header -->
        <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />
        
        <!-- content -->
        <x-dashboard-content>
            <div class="row">
                <x-statistic-card col="xl-4,12" title="Unit" value="10" bg="bg-info" icon="ft-save" fg="text-primary" />
                <x-statistic-card col="xl-4,12" title="Asesor" value="10" bg="bg-success" icon="ft-save" fg="text-success" />
                <x-statistic-card col="xl-4,12" title="Asesi" value="10" bg="bg-danger" icon="ft-save" fg="text-danger" />
            </div>
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </x-dashboard-content>
    </x-dashboard-content-wrapper>
@endsection

@section('body')
    <body class="vertical-layout vertical-menu-modern content-right-sidebar menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="content-right-sidebar">
@endsection

@push('js')
    <script>
        $('.app-content').html( $('.content-wrapper').html() )
    </script>
@endpush