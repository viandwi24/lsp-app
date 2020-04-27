@extends('layouts.dashboard', ['title' => 'Admin \ Home'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Home" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-blue" role="alert" style="color: white!important;">
                    <strong>Welcome!</strong> Selamat Datang di <b>LSP APP</b>,
                    Aplikasi LSP dari <b>SMKN 1 Mojokerto</b>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection