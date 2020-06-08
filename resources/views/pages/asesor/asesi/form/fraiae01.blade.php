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
    <x-dashboard-content-header title="FR-AI-AE-01 : PERTANYAAN TERTULIS" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
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

                    <div class="card shadow">
                        <div class="card-header">Pertanyaan yang harus dijawab oleh kandidat</div>
                        <div class="card-body card-table">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <th width="10%">#</th>
                                    <th>Pertanyaan - Jawaban</th>
                                    <th width="5%">Memuaskan ?</th>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($asesmen->fraiae01->data as $data)
                                        <tr style="background: #e0e0e0;">
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ $data->pertanyaan }}
                                            </td>
                                            <td rowspan="2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="pilihan{{ $i-2 }}" name="pilihan[{{ $i-2 }}]" value="true" {{ ($data->memuaskan) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="pilihan{{ $i-2 }}">Ya</label>
                                                </div>                                                  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <b>Jawaban :</b>
                                                {{ $data->jawaban }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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