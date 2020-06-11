@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ Edit \ Unit'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('admin.skema.index') ],
    ['text' => 'Edit' ],
    ['text' => 'Unit' ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <x-dashboard-card title="Edit Unit" classBody="card-table">
                    <x-slot name="heading">
                        <li><a class="btn btn-sm btn-success" href="#" @click.prevent="tambahUnit"><i class="ft-plus"></i> Tambah Unit</a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <x-slot name="footer">
                        <div class="text-right mt-2">
                            <a href="{{ route('admin.skema.show', [$skema->id]) }}" class="btn btn-warning">
                                <i class="ft-chevron-left"></i> Kembali
                            </a>
                            <button @click.prevent="submit" class="btn btn-primary">
                                <i class="ft-save"></i> Simpan
                            </button>
                        </div>
                    </x-slot>

                    <!-- Body -->
                    <form id="form-unit" method="POST" action="{{ url()->route('admin.skema.update', [$skema->id]) . '?tab=unit' }}" class="form">
                        @method('put')
                        @csrf
                        <input type="hidden" name="unit">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center" width="30%">Kode</th>
                                    <th class="text-center">Judul Unit / Elemen Kompetensi / Kuk</th>
                                </tr>
                            </thead>
                            <tbody v-for="(unit, i) in units">
                                <tr>
                                    <td :rowspan="unit.elemen.length + 1" class="text-center">@{{ i+1 }}</td>
                                    <td :rowspan="unit.elemen.length + 1" class="text-center">
                                        <input type="text" class="form-control form-control-sm w-100" v-model="units[i].kode">
                                    </td>
                                    <td style="background: #EEE;">
                                        <label>Unit :</label>
                                        <input type="text" class="form-control form-control-sm" v-model="units[i].judul">
                                        <div class="mt-2">
                                            <a href="#" @click.prevent="hapusUnit(i)">Hapus</a> -
                                            <a href="#" @click.prevent="tambahElemen(i)">Tambah Elemen</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="(elemen, j) in unit.elemen">
                                    <td>
                                        <div class="row">
                                            <div class="col-12">
                                                <label>[@{{ j+1 }}] Elemen :</label>
                                                <input type="text" class="form-control form-control-sm" v-model="units[i].elemen[j].elemen">
                                                <div class="mt-2">
                                                    <a href="#" @click.prevent="hapusElemen(i, j)">Hapus</a> -
                                                    <a href="#" @click.prevent="tambahKuk(i, j)">Tambah Kuk</a>
                                                </div>
                                                
                                                <hr>
                                                <label>Kuk :</label>
                                            </div>
                                            <div class="col-12" v-for="(kuk, k) in elemen.kuk">
                                                <textarea class="form-control form-control-sm" v-model="units[i].elemen[j].kuk[k].kuk"></textarea>
                                                <div class="text-right">
                                                    <a href="#" @click.prevent="hapusKuk(i, j, k)">Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </x-dashboard-card>
            </div>
        </div>
    </x-dashboard-content>
@endsection


@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                units: @JSON($skema->unit)
            },
            methods: {
                tambahUnit() {
                    let count = this.units.length + 1
                    this.units.push({ 
                        judul: 'Contoh Unit ' + count, 
                        kode: 'Contoh Kode ' + count, 
                        jenis: 'SKKNI', 
                        pertanyaan: [],
                        elemen: [
                            {
                                elemen: 'Contoh Elemen 1', 
                                kuk: [
                                    { 
                                        kuk: 'Contoh Kuk 1',
                                        rencana_asesmen: {
                                            observasi: {
                                                jenis_bukti: 'L',
                                                metode: 'CL'
                                            },
                                            jawaban: {
                                                jenis_bukti: 'L',
                                                metode: 'CL'
                                            },
                                        }
                                    }
                                ]
                            }
                        ]
                    })
                },
                hapusUnit(index) {
                    this.units.splice(index, 1)
                },
                tambahElemen(unit) {
                    let count = this.units[unit].elemen.length + 1
                    this.units[unit].elemen.push({
                        elemen: 'Contoh Elemen ' + count, 
                        kuk: [
                            { 
                                kuk: 'Contoh Kuk 1',
                                rencana_asesmen: {
                                    observasi: {
                                        jenis_bukti: 'L',
                                        metode: 'CL'
                                    },
                                    jawaban: {
                                        jenis_bukti: 'L',
                                        metode: 'CL'
                                    },
                                }
                            }
                        ]
                    })
                },
                hapusElemen(unit, index) {
                    if (this.units[unit].elemen.length == 1) return 
                    this.units[unit].elemen.splice(index, 1)
                },
                tambahKuk(unit, elemen) {
                    let count = this.units[unit].elemen[elemen].kuk.length + 1
                    this.units[unit].elemen[elemen].kuk.push({
                        kuk: 'Contoh Kuk ' + count,
                        rencana_asesmen: {
                            observasi: {
                                jenis_bukti: 'L',
                                metode: 'CL'
                            },
                            jawaban: {
                                jenis_bukti: 'L',
                                metode: 'CL'
                            },
                        }
                    })
                },
                hapusKuk(unit, elemen, index) {
                    if (this.units[unit].elemen[elemen].kuk.length == 1) return 
                    this.units[unit].elemen[elemen].kuk.splice(index, 1)
                },
                submit() {
                    $('input[name=unit]').val( JSON.stringify(this.units) )
                    $('form#form-unit').submit()
                }
            },
        })
    </script>
@endpush

@push('css')
    <style>.table tbody + tbody { border-top: none; }</style>
@endpush