@extends('layouts.dashboard', ['title' => 'Asesor \ Permohonan \ Setujui'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" title="Setujui Permohonan" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permohonan</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard card-table">
                        <table class="table table-hover table-bordered m-0">
                            <tbody>
                                <tr style="background: #9e9e9e;">
                                    <th class="text-center text-white">Permohonan Asesi</th>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-hover table-bordered m-0">
                            <tbody>
                                <tr>
                                    <th class="text-right" width="15%">Asesi :</th>
                                    <th>{{ $permohonanAsesiAsesor->permohonan->asesi->nama }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="15%">Skema :</th>
                                    <th>{{ $permohonanAsesiAsesor->permohonan->skema->judul }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="15%">Jadwal :</th>
                                    <th>{{ $permohonanAsesiAsesor->jadwal->nama }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="15%">Tuk :</th>
                                    <th>{{ $permohonanAsesiAsesor->tuk->nama }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="15%">Dibuat :</th>
                                    <th>{{ $permohonanAsesiAsesor->permohonan->created_at }}</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="15%">Disetujui Admin :</th>
                                    <th>{{ $permohonanAsesiAsesor->permohonan->approved_at }}</th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-hover table-bordered m-0">
                            <tbody>
                                <tr style="background: #9e9e9e;">
                                    <th class="text-center text-white">Asesmen Mandiri</th>
                                </tr>
                            </tbody>
                        </table>
                        @foreach ($permohonanAsesiAsesor->permohonan->skema->unit as $unit_index => $unit)
                            <table class="table table-hover table-bordered m-0">
                                <tbody>
                                    <tr style="background: #e0e0e0;">
                                        <th class="text-right" width="15%">Unit Kompetensi :</th>
                                        <th>{{ $unit->kode }} {{ $unit->judul }}</th>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-hover table-bordered m-0">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Dapatkan saya ?</th>
                                        <th width="7%">BK</th>
                                        <th width="7%">K</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    @foreach ($unit->elemen as $elemen_index => $elemen)
                                        <tr>
                                            <td colspan="4">{{ $elemen->elemen }}</td>
                                        </tr>
                                        @foreach ($elemen->kuk as $kuk_index => $kuk)
                                            <tr>
                                                <td width="5%">{{ $unit_index }}.{{ $elemen_index }}</td>
                                                <td>{{ $kuk->kuk }}</td>
                                                @if (!$permohonanAsesiAsesor->permohonan->data->kuk[$unit_index][$elemen_index][$kuk_index])
                                                    <td></td>
                                                    <td><i class="ft-check"></i></td>
                                                @else
                                                    <td><i class="ft-check"></i></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                        <form method="POST" action="{{ route('asesor.permohonan.update', [$permohonanAsesiAsesor->id]) }}?setujui" class="form">
                            @csrf
                            @method('put')
                            <button class="btn btn-block btn-primary">
                                <i class="ft-check"></i> Setujui dan Tanda Tangani
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection


@push('js')
    <script>
    $(document).ready(() => {
        // $('#selectAsesor').select2({ data: '' });
    });
    </script>
@endpush

@push('css')
    <style>
        .form-section { border-bottom: 1px solid #34495e; }
        tbody { border: 0!important; }
    </style>
@endpush
