@extends('layouts.dashboard', ['title' => 'Asesi \ Asesmen \ ' . $asesmen->skema->judul ])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Asesmen', 'link' => route('asesi.asesmen')]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header :title="$asesmen->skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <!-- description -->
                <div class="card shadow">
                    <div class="card-body p-0">
                        <table class="table m-0">
                            <tr>
                                <th>Skema</th>
                                <td>: {{ $asesmen->skema->judul }}</td>
                            </tr>
                            <tr>
                                <th>Asesor</th>
                                <td>: {{ $asesmen->asesor->nama }}</td>
                            </tr>
                            <tr>
                                <th>Admin</th>
                                <td>: {{ $asesmen->skema->admin->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tuk</th>
                                <td>: {{ $asesmen->skema->tuk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jadwal</th>
                                <td>: {{ $asesmen->jadwal->waktu_pelaksanaan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- items -->
                <div class="mb-4">
                    <!-- item mak-01 -->
                    <div class="item">
                        @php
                            $status = '';
                            $style = 'danger';
                            if ($asesmen->frmak01 == null)
                            {
                                $status = 'Belum ditandatangani';
                            } else {
                                if ($asesmen->frmak01->signed_asesor_at == null)
                                {
                                    $status = 'Sudah ditandatangani, Menunggu Asesor.';
                                    $style = 'warning';
                                } else {
                                    $status = 'Sudah ditandatangani Asesi dan Asesor.';
                                    $style = 'success';
                                }
                            }
                        @endphp
                        <div class="title">FR-MAK-01 : PERSETUJUAN ASESMEN DAN KERAHASIAN</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            @if ($asesmen->frmak01 == null)
                                <a href="{{ route('asesi.asesmen.show.frmak01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Tanda tangani</a>
                            @endif
                            <button class="btn btn-sm btn-success">Download</button>
                        </div>
                    </div>

                    <!-- item mak-03 -->
                    <div class="item">
                        @php
                            $status = 'Belum diisi.';
                            $style = 'danger';
                            if ($asesmen->frai01 == null) {
                                $status = 'Belum diisi.';
                            } else {
                                $status = 'Sudah diisi asesor.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-AI-01 : CEKLIS OBSERVASI UNTUK AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-sm btn-success">Download</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('css')
    <style>
        .item {
            display: block;
            padding: 1rem;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            margin-bottom: 1.8rem;
        }
        .item:hover {
            box-shadow: 0 5px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }
        .item .title { font-weight: bold; }
    </style>
@endpush