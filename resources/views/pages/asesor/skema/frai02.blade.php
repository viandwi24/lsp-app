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

                <div class="card" v-for="(unit, i) in units" :key="i">
                    <div class="card-header pb-2">
                        <h4 class="card-title">@{{ unit.kode }} / @{{ unit.judul }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><button @click="tambah(i)" class="btn btn-sm btn-success"><i class="ft-plus"></i> Tambah</button></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard pt-0 card-table">
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
                                        <tr v-for="(item, j) in unit.pertanyaan" :key="i">
                                            <td>@{{ j+1 }}</td>
                                            <td>
                                                <input type="text" v-model="units[i].pertanyaan[j]" class="form-control form-control-sm">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" @click="hapus(i, j)" class="btn btn-sm btn-danger">
                                                    <i class="ft-x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-if="units[i].pertanyaan.length == 0">
                                            <td colspan="3" class="text-center">Tidak ada pertanyaan.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>
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
        {{-- {{ dd($skema->unit) }} --}}
    </x-dashboard-content>
@endsection

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                units: @JSON($skema->unit)
            },
            mounted() {
                console.log(this.units);
            },
            methods: {
                hapus(unit, index) {
                    this.units[unit].pertanyaan.splice(index, 1);
                },
                tambah(unit) {
                    this.units[unit].pertanyaan.push('');
                },
                submit() {
                    $('input[name=pertanyaan]').val( JSON.stringify(this.units) )
                    $('form#form').submit()
                }
            },
        })
    </script>
@endpush