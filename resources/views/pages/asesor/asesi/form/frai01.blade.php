@extends('layouts.dashboard', ['title' => 'Asesor \ Asesmen \ ' . $asesmen->skema->judul ])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Asesmen', 'link' => route('asesor.asesi')],
    ['text' => $asesmen->skema->judul]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="FR-AI-01 : CEKLIS OBSERVASI UNTUK AKTIVITAS DI TEMPAT KERJA ATAU TEMPAT KERJA SIMULASI" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
    <!-- content -->
    <x-dashboard-content>
        <form action="" method="POST">
            @csrf
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
                            </table>
                        </div>
                    </div>

                    <!-- form -->
                    <div class="card shadow-lg">
                        <div class="card-body card-table table-responsive">
                            @foreach ($asesmen->frai01->data as $unit_k => $unit)  
                                <table class="table table-hover m-0">
                                    <thead>
                                        <tr style="background: #e0e0e0;">
                                            <th colspan="7">{{ $unit->judul }}</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th width="30%">Elemen</th>
                                            <th width="40%">KUK</th>
                                            <th width="10%">Benchmark (SOP / spesifikasi produk industri)</th>
                                            <th>K</th>
                                            <th>BK</th>
                                            <th width="20%">Penilaian Lanjut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($unit->elemen as $elemen_k => $elemen)
                                            <tr>
                                                <td rowspan="{{ count($elemen->kuk) + 1 }}">{{ $i++ }}</td>
                                                <td rowspan="{{ count($elemen->kuk) + 1 }}">{{ $elemen->elemen }}</td>
                                            </tr>
                                            
                                            @foreach ($elemen->kuk as $kuk_k => $kuk)
                                                <tr>
                                                    <td>{{ $kuk->kuk }}</td>
                                                    <td>
                                                        <input type="text" name="benchmark[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" class="form-control form-control-sm"
                                                            value="{{ $kuk->benchmark }}">
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pilihanTrue[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" name="pilihan[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" class="custom-control-input" value="true"
                                                            {{ ($kuk->pilihan) ? 'checked' : '' }}
                                                            >
                                                            <label class="custom-control-label" for="pilihanTrue[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pilihanFalse[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" name="pilihan[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" class="custom-control-input" value="false"
                                                            {{ ($kuk->pilihan) ? '' : 'checked' }}
                                                            >
                                                            <label class="custom-control-label" for="pilihanFalse[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="penilaian[{{ $unit_k }}][{{ $elemen_k }}][{{ $kuk_k }}]" class="form-control form-control-sm"
                                                        value="{{ $kuk->penilaian }}">
                                                    </td>
                                                </tr>                                                
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>                                      
                            @endforeach              
                        </div>
                    </div>


                    <!-- other -->
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kinerja Kandidat</label>
                                <select name="kinerja" class="form-control">
                                    <option value="memuaskan" {{ $asesmen->frai01->kinerja == 'memuaskan' ? 'selected' : '' }}>Memuaskan</option>
                                    <option value="tidak_memuaskan" {{ $asesmen->frai01->kinerja == 'tidak_memuaskan' ? 'selected' : '' }}>Tidak Memuaskan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Umpan Balik</label>
                                <input type="text" name="catatan" class="form-control" value="{{ $asesmen->frai01->catatan }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-block btn-primary">
                            Simpan Formulir
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-dashboard-content>
@endsection

@push('css')
@endpush