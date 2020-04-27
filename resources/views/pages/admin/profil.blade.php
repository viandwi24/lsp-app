@extends('layouts.dashboard', ['title' => 'Admin \ Profil'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Profil" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                
            </div>
        </div>
    </x-dashboard-content>
@endsection