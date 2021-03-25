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
                                <td>: {{ $asesmen->tuk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jadwal</th>
                                <td>: {{ $asesmen->jadwal->waktu_pelaksanaan }}</td>
                            </tr>
                            <tr>
                                <th>Keputusan</th>
                                <td>
                                    <form class="form-inline" role="form" method="POST" action="{{ route('asesor.asesi.update', [$asesmen->id]) }}">
                                        @csrf
                                        @method('put')
                                        <div class = "form-group">
                                           <select name="keputusan" class="form-control mr-2">
                                                <option {{ $asesmen->keputusan == 'kompeten' ? 'selected' : '' }} value="kompeten">Kompeten</option>
                                                <option {{ $asesmen->keputusan == 'belum_kompeten' ? 'selected' : '' }} value="belum_kompeten">Belum Kompeten</option>
                                                <option {{ $asesmen->keputusan == null ? 'selected' : '' }} value="null">Belum Ditetapkan</option>
                                            </select>
                                            <button class="btn btn-primary">Ubah</button>
                                        </div>
                                    </form>
                                </td>
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
                                $status = 'Belum ditandatangani Asesi.';
                                $style = 'danger';
                            } else {
                                if ($asesmen->frmak01->signed_asesor_at == null)
                                {
                                    $status = 'Sudah ditandatangani Asesi, Menunggu Anda.';
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
                            @if ($asesmen->frmak01 != null && $asesmen->frmak01->signed_asesor_at == null)
                                <a href="{{ route('asesor.asesi.frmak01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Tanda tangani</a>
                            @endif
                            <a target="_blank" href="{{ route('pdf.frmak01', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
                        </div>
                    </div>

                    <!-- item ai-01 -->
                    <div class="item">
                        @php
                            $status = 'Belum diisi.';
                            $style = 'danger';
                            if ($asesmen->frai01 == null) {
                                $status = 'Belum diisi.';
                            } else {
                                $status = 'Sudah diisi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-AI-01 : CEKLIS OBSERVASI UNTUK AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('asesor.asesi.frai01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Buka / Isi</a>
                            
                            <a target="_blank" href="{{ route('pdf.frai01', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
                            @if ($asesmen->frai01 != null)
                                <a href="{{ route('asesor.asesi.frai01', [$asesmen->id]) . '?reset' }}" class="btn btn-sm btn-danger">Reset Form</a>
                            @endif
                        </div>
                    </div>

                    <!-- item ai-02 -->
                    <div class="item">
                        @php
                            $status = 'Belum diisi.';
                            $style = 'danger';
                            if ($asesmen->frai02 == null) {
                                $status = 'Belum diisi.';
                            } else {
                                $status = 'Sudah diisi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-AI-02 : PERTANYAAN UNTUK MENDUKUNG OBSERVASI</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('asesor.asesi.frai02', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Buka / Isi</a>
                            <a target="_blank" href="{{ route('pdf.frai02', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
                            @if ($asesmen->frai02 != null)
                                <a href="{{ route('asesor.asesi.frai02', [$asesmen->id]) . '?reset' }}" class="btn btn-sm btn-danger">Reset Form</a>
                            @endif
                        </div>
                    </div>

                    {{-- <!-- item ai-ae-01 -->
                    <div class="item">
                        @php
                            $status = 'Belum diisi asesi.';
                            $style = 'danger';
                            if ($asesmen->fraiae01 == null) {
                                $status = 'Belum diisi asesi.';
                            } else {
                                $status = 'Sudah diisi asesi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-AI-AE-01 : PERTANYAAN LISAN</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            @if ($asesmen->fraiae01 != null)
                                <a href="{{ route('asesor.asesi.fraiae01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Buka / Isi</a>                                
                            @endif
                            <button class="btn btn-sm btn-success">Download</button>
                        </div>
                    </div> 

                    <!-- item ai-ae-03 -->
                    <div class="item">
                        @php
                            $status = 'Belum diisi asesi.';
                            $style = 'danger';
                            if ($asesmen->fraiae03 == null) {
                                $status = 'Belum diisi asesi.';
                            } else {
                                $status = 'Sudah diisi asesi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-AI-AE-03 : PERTANYAAN TERTULIS</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            @if ($asesmen->fraiae03 != null)
                                <a href="{{ route('asesor.asesi.fraiae03', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Buka / Isi</a>                                
                            @endif
                            <button class="btn btn-sm btn-success">Download</button>
                        </div>
                    </div> --}}

                    <!-- item ac-03 -->
                    <div class="item">
                        @php
                            if ($asesmen->frac01 == null) {
                                $status = 'Belum diisi.';
                                $style = 'danger';
                            } else {
                                if ($asesmen->frac01->signed_asesi_at == null)
                                {
                                    $status = 'Sudah diisi dan belum ditandatangi asesi.';
                                    $style = 'warning';
                                } else {
                                    $status = 'Sudah diisi dan sudah ditandatangani asesi.';
                                    $style = 'success';
                                }
                            }
                        @endphp
                        <div class="title">FR-AC-01 : Rekaman Asesmen Kompetensi</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('asesor.asesi.frac01', [$asesmen->id]) }}" class="btn btn-sm btn-primary">Buka / Isi</a>
                            <a target="_blank" href="{{ route('pdf.frac01', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
                            @if ($asesmen->frac01 != null)
                                <a href="{{ route('asesor.asesi.frac01', [$asesmen->id]) . '?reset' }}" class="btn btn-sm btn-danger">Reset Form</a>
                            @endif
                        </div>
                    </div>  

                    <!-- item mak-03 -->
                    <div class="item">
                        @php
                            if ($asesmen->frmak03 == null) {
                                $status = 'Tidak dibuat asesi.';
                                $style = 'danger';
                            } else {
                                $status = 'Sudah dibuat asesi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FR-MAK-03 : Formulir Banding Asesmen</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <a target="_blank" href="{{ route('pdf.frmak03', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
                        </div>
                    </div>  

                    <!-- item umpanbalik -->
                    <div class="item">
                        @php
                            if ($asesmen->umpanbalik == null) {
                                $status = 'Belum diisi asesi.';
                                $style = 'danger';
                            } else {
                                $status = 'Sudah diisi asesi.';
                                $style = 'success';
                            }
                        @endphp
                        <div class="title">FORMULIR UMPAN BALIK</div>
                        <div class="text-muted">
                            Status : 
                            <span class="badge badge-{{ $style }}">{{ $status }}</span>
                        </div>
                        <div class="mt-2">
                            <a target="_blank" href="{{ route('pdf.umpanbalik', [$asesmen->id]) }}" class="btn btn-sm btn-success">Download</a>
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