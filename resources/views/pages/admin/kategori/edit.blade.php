@extends('layouts.dashboard', ['title' => 'Admin \ Kategori \ Edit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Kategori', 'link' => url()->route('admin.kategori.index') ],
    ['text' => 'Edit Kategori' ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Kategori" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Kategori</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ url()->route('admin.kategori.update', [$kategori->id]) }}" class="form">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input value="{{ $kategori->nama }}" type="text" name="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input value="{{ $kategori->deskripsi }}" type="text" name="deskripsi" class="form-control">
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