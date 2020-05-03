@extends('layouts.dashboard', ['title' => 'Super Admin \ Module'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Super Admin', 'link' => url()->route('superadmin.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Module" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Module Terdaftar</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">...</th>
                            </thead>
                            <tbody>
                                @foreach ($modules as $item)
                                    <tr>
                                        <td>{{ $item->info->name }}</td>
                                        <td>{{ $item->info->description }}</td>
                                        <td class="text-center">
                                            @if ($item->state == 'ready')
                                                <span class="badge badge-success">
                                            @elseif ($item->state == 'not_ready')
                                                <span class="badge badge-warning">
                                            @else
                                                <span class="badge badge-danger">
                                            @endif
                                                {{ $item->state }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->state == 'ready')
                                                <a href="{{ url()->route('superadmin.module.action') .'?action=disable&name=' . $item->name }}" class="link red">Nonaktifkan</a>
                                            @elseif ($item->state == 'not_ready')
                                                <a href="{{ $item->setup }}" class="link success">Setup Now</a> |
                                                <a href="{{ url()->route('superadmin.module.action') .'?action=disable&name=' . $item->name }}" class="link red">Nonaktifkan</a>
                                            @elseif ($item->state == 'error')
                                                <a href="javascript:void" onclick="showError('{{ $item->info->name }}', '{{ $item->error }}')" class="link red">Lihat Error</a> |
                                                <a href="{{ url()->route('superadmin.module.action') .'?action=disable&name=' . $item->name }}" class="link red">Nonaktifkan</a>
                                            @elseif ($item->state == 'disable')
                                                <a href="{{ url()->route('superadmin.module.action') .'?action=enable&name=' . $item->name }}" class="link text-success">Aktifkan</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="errorcontainer"></div>

                <div class="alert alert-primary">
                    <p>
                        <strong>Penjelasan Status :</strong>
                        <ul>
                            <li>
                                <span class="badge badge-success">ready</span>
                                Keadaan Module sudah diload dengan sempurna
                            </li>
                            <li>
                                <span class="badge badge-warning">not_ready</span>
                                Keadaan Module sudah diload tetapi membutuhkan setup
                            </li>
                            <li>
                                <span class="badge badge-danger">error</span>
                                Keadaan Module sudah diload tetapi memiliki suatu state error
                            </li>
                            <li>
                                <span class="badge badge-danger">disable</span>
                                Module yang sedang dinonaktifkan
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection


@push('js')
    <script>
        function showError(name, text) {
            let alert = $(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error Module ` + name + `:</strong><br> `+text+`
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`)
            $('#errorcontainer').append(alert)
        }
    </script>
@endpush