@extends('layouts.dashboard', ['title' => 'Super Admin \ PraAsesmen \ Setup'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Super Admin', 'link' => url()->current() ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="PraAsesmen Setup" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <b>Setup akan membuat perubahan baru :</b>
                        </p>
                        <ul>
                            <li>Migrasi Tabel Baru "Permohonan"</li>
                        </ul>
                        <a href="{{ route('PraAsesmen.setup.install') }}" class="btn btn-block btn-primary">Install</a>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection