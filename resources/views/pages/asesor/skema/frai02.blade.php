@extends('layouts.dashboard', ['title' => 'Asesor \ Skema \ '. $skema->judul .' \ FR-AI-02'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('asesor.skema') ],
    ['text' => $skema->judul ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" title="FR-AI-02 : PERTANYAAN UNTUK MENDUKUNG OBSERVASI" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <x-dashboard-card title="Edit Formulir FR-AI-02" classBody="card-table">
                    <x-slot name="heading">
                        <li><button @click="tambah" class="btn btn-sm btn-success"><i class="ft-plus"></i> Tambah</button></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
                    <form method="POST" action="{{ route('asesor.skema.frai02.update', [$skema->id]) }}" class="form" id="form">
                        @csrf
                        @method('put')
                        <input type="hidden" name="pertanyaan">
                        <table class="table table-hover">
                            <thead>
                                <th width="10%">#</th>
                                <th>Pertanyaan</th>
                                <th class="text-center" width="10%">...</th>
                            </thead>
                            <tbody>
                                <tr v-for="(item, i) in pertanyaans" :key="i">
                                    <td>@{{ i+1 }}</td>
                                    <td>
                                        <input type="text" v-model="pertanyaans[i]" class="form-control form-control-sm">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" @click="hapus(i)" class="btn btn-sm btn-danger">
                                            <i class="ft-x"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="pertanyaans.length == 0">
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
                <a href="{{ route('asesor.skema', [$skema->id]) }}" class="btn btn-block btn-warning">
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
                pertanyaans: @JSON($skema->frai02->pertanyaan)
            },
            mounted() {
                console.log( this.pertanyaans );
            },
            methods: {
                hapus(index) {
                    this.pertanyaans.splice(index, 1);
                },
                tambah() {
                    this.pertanyaans.push('');
                },
                submit() {
                    $('input[name=pertanyaan]').val( JSON.stringify(this.pertanyaans) )
                    $('form#form').submit()
                }
            },
        })
    </script>
@endpush