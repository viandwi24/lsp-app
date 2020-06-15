@extends('layouts.dashboard', ['title' => 'Asesi \ Skema \ '. $asesmen->skema->judul .' \ UMPAN BALIK'])

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
    <x-dashboard-content-header type="basic-bottom" title="FORMULIR UMPAN BALIK" :breadcrumb="$breadcrumb" :autoBread="false" />
    
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

                <!-- main -->
                <x-dashboard-card title="Isi Formulir" classBody="card-table">
                    <x-slot name="heading">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
                    <form method="POST" action="" class="form" id="form">
                        @csrf
                        <input type="hidden" name="data">
                        <table class="table table-hover mb-0">
                            <thead>
                                <th width="5%">#</th>
                                <th>Pertanyaan</th>
                                <th width="10%">Ya</th>
                                <th width="25%">Komentar</th>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in datas" :key="i">
                                    <td>@{{ i+1 }}</td>
                                    <td>
                                        <b>@{{ item.pertanyaan }}</b>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" :id="'hasilFalse' + i" v-model="datas[i].hasil" checked>
                                            <label class="custom-control-label" :for="'hasilFalse' + i"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" v-model="datas[i].komentar" class="form-control form-control-sm">
                                    </td>
                                </tr>
                                <tr v-if="datas.length == 0">
                                    <td colspan="3" class="text-center">Tidak ada pertanyaan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </x-dashboard-card>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <a href="{{ route('asesi.asesmen.show', [$asesmen->id]) }}" class="btn btn-block btn-warning">
                    <i class="ft-chevron-left"></i> Kembali
                </a>
            </div>
            <div class="col-lg-6">
                <button @click="submit" class="btn btn-block btn-primary">
                    <i class="ft-save"></i> Simpan
                </button>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                datas: @JSON($asesmen->umpanbalik->data)
            },
            mounted() {
                console.log( this.datas );
            },
            methods: {
                submit() {
                    $('input[name=data]').val( JSON.stringify(this.datas) )
                    $('form#form').submit()
                }
            },
        })
    </script>
@endpush