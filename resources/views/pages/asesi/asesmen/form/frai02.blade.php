@extends('layouts.dashboard', ['title' => 'Asesi \ Skema \ '. $asesmen->skema->judul .' \ FR-AI-02'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesi.skema') ],
    ['text' => $asesmen->skema->judul ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" title="FR-AI-02 : PERTANYAAN UNTUK MENDUKUNG OBSERVASI" :breadcrumb="$breadcrumb" :autoBread="false" />
    
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
                                <td>: {{ $asesmen->tuk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jadwal</th>
                                <td>: {{ $asesmen->jadwal->waktu_pelaksanaan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>



                <form method="POST" action="" class="form" id="form">
                    @csrf
                    <input type="hidden" name="data">
                
                    <div class="card" v-for="(unit, i) in units" :key="i">
                        <div class="card-header pb-2">
                            <h4 class="card-title">@{{ unit.kode }} / @{{ unit.judul }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard pt-0 card-table">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <th width="10%">#</th>
                                        <th>Pertanyaan - Jawaban</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, j) in unit.pertanyaan" :key="j">
                                            <td>@{{ j+1 }}</td>
                                            <td>
                                                <div class="row mb-3">
                                                    <b>@{{ item.pertanyaan }}</b>
                                                </div>
                                                <div class="row">
                                                    <span>Jawaban anda :</span>
                                                    <input readonly type="text" v-model="units[i].pertanyaan[j].jawaban" class="form-control form-control-sm">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-if="units[i].pertanyaan.length == 0">
                                            <td colspan="3" class="text-center">Tidak ada pertanyaan.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <a href="{{ route('asesi.asesmen.show', [$asesmen->id]) }}" class="btn btn-block btn-warning">
                    <i class="ft-chevron-left"></i> Kembali
                </a>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                units: @JSON($asesmen->frai02->data)
            },
            mounted() {
                console.log( this.units );
            },
            methods: {
                submit() {
                    $('input[name=data]').val( JSON.stringify(this.units) )
                    $('form#form').submit()
                }
            },
        })
    </script>
@endpush