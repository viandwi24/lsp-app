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
    <x-dashboard-content-header title="FR-AI-02 : PERTANYAAN UNTUK MENDUKUNG OBSERVASI" :breadcrumb="$breadcrumb" :autoBread="false" type="basic-bottom" />
    
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

                    @php $j = 1; @endphp
                    @foreach ($asesmen->frai02->data as $unit)
                        @php $j++; @endphp
                        <div class="card shadow">
                            <div class="card-header">{{ $unit->kode }} / {{ $unit->judul }}</div>
                            <div class="card-body card-table">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead>
                                        <th>#</th>
                                        <th>Pertanyaan - Jawaban</th>
                                        <th width="15%">Memuaskan ?</th>
                                    </thead>
                                    <tbody>
                                        @if (count($unit->pertanyaan) == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    Tidak ada pertanyaan.
                                                </td>
                                            </tr>
                                        @endif

                                        @php $i = 1; @endphp
                                        @foreach ($unit->pertanyaan as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <b>{{ $data->pertanyaan }}</b>
                                                </td>
                                                <td rowspan="2" style="vertical-align: middle;" class="text-center">
                                                    <div class="custom-control custom-checkbox text-left" style="display: inline-block;">
                                                        <input type="checkbox" class="custom-control-input" id="pilihan{{ $j-2 }}{{ $i-2 }}" name="pilihan[{{ $j-2 }}][{{ $i-2 }}]" value="true" {{ ($data->memuaskan) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="pilihan{{ $j-2 }}{{ $i-2 }}">Ya</label>
                                                    </div>                                                  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <b>Tanggapan :</b>
                                                    <input type="text" name="jawaban[{{ $j-2 }}][{{ $i-2 }}]" value="{{ old('jawaban.' . ($j-2) . '.' . ($i-2), $data->jawaban) }}" class="form-control form-control-sm">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach


                    <!-- other -->
                    <div class="card shadow-lg">
                        <div class="card-header">Lainnya</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pengethuan Kandidat</label>
                                <select name="pengetahuan" class="form-control">
                                    <option value="memuaskan" {{ $asesmen->frai02->pengetahuan == 'memuaskan' ? 'selected' : '' }}>Memuaskan</option>
                                    <option value="tidak_memuaskan" {{ $asesmen->frai02->pengetahuan == 'tidak_memuaskan' ? 'selected' : '' }}>Tidak Memuaskan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Catatan Umpan Balik</label>
                                <input type="text" name="catatan" class="form-control" value="{{ $asesmen->frai02->catatan }}">
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