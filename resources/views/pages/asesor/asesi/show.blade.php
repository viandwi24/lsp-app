@extends('layouts.dashboard', ['title' => 'Asesor \ Asesmen \ ' . $asesmen->skema->judul ])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Asesmen', 'link' => route('asesor.asesi')]
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
                                <th>Asesi</th>
                                <td>: {{ $asesmen->asesi->nama }}</td>
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
                            if ($asesmen->frmak01 == null)
                            {
                                $status = 'Belum ditandatangani Asesi.';
                            } else {
                                if ($asesmen->frmak01->signed_asesor_at == null)
                                {
                                    $status = 'Sudah ditandatangani Asesi, Menunggu Anda.';
                                } else {
                                    $status = 'Sudah ditandatangani Asesi dan Asesor.';
                                }
                            }
                        @endphp
                        <div class="title">FR-MAK-01 : PERSETUJUAN ASESMEN DAN KERAHASIAN</div>
                        <div class="text-muted">Status : {{ $status }}</div>
                        <div class="mt-2">
                            @if ($asesmen->frmak01 != null && $asesmen->frmak01->signed_asesor_at == null)
                                <a href="{{ route('asesor.asesi.show.frmak01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Tanda tangani</a>
                            @endif
                            <button class="btn btn-sm btn-success">Download</button>
                        </div>
                    </div>

                    <!-- item mak-03 -->
                    <div class="item">
                        <div class="title">FR-MAK-03 : FORMULIR BANDING ASESMEN</div>
                        <div class="text-muted">Status : Belum saatnya diisi.</div>
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