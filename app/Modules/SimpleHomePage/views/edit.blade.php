@extends('layouts.dashboard', ['title' => 'Admin \ Simple Home Page \ Edit Home'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Simple Home Page' ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Edit Home" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    <strong>Perhatian!</strong> Jika anda mengaktifkan cache pada view,
                    setelah merubah kode ini anda harus membersihkan ulang cache.
                    Agar perubahan bisa tampil.
                </div>
                @include('TextEditor::code', [
                    'title' => 'Edit Home',
                    'filename' => 'home.blade.php',
                    'formAction' => url()->route('simplehomepage.update'),
                    'formMethod' => 'post',
                    'code' => $code
                ])
            </div>
        </div>
    </x-dashboard-content>
@endsection