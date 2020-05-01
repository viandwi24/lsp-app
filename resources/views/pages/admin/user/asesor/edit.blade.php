@extends('layouts.dashboard', ['title' => 'Admin \ User \ Asesor \ Edit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Asesor', 'link' => url()->route('admin.user.asesor.index') ],
    ['text' => 'Edit Asesor' ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Asesor" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Asesor</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form id="form" method="POST" action="{{ url()->route('admin.user.asesor.update', [$user->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input value="{{ $user->nama }}" type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input value="{{ $user->email }}" type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control">
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