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
                <div class="mb-2">
                    <a class="btn btn-sm btn-success" href="#" @click.prevent="tambahUnit"><i class="ft-plus"></i> Tambah Unit</a>
                </div>

                <form id="form-unit" method="POST" action="{{ url()->route('admin.skema.update', [$skema->id]) . '?tab=unit' }}" class="form">
                    @method('put')
                    @csrf
                    <input type="hidden" name="unit">
                </form>

                <div class="card shadow" v-for="(unit, i) in units">
                    <div class="card-header pb-2">
                        <h4 class="card-title">Unit #@{{ i+1 }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a class="btn btn-sm btn-danger" href="#" @click.prevent="hapusUnit(i)"><i class="ft-times"></i> Hapus Unit</a></li>
                                <li><a class="btn btn-sm btn-success" href="#" @click.prevent="tambahElemen(i)"><i class="ft-plus"></i> Tambah Elemen</a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" placeholder="Kode Unit" v-model="units[i].kode">
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Judul Unit" v-model="units[i].judul">
                            </div>
                        </div>
                        <hr>
                        <table class="table table-bordered" v-for="(elemen, j) in unit.elemen">
                            <tr style="background: greenyellow;">
                                <th colspan="3">
                                    <div class="row">
                                        <div class="col-2">Elemen #@{{ j+1 }}</div>
                                        <div class="col-8">
                                            <input type="text" class="form-control form-control-sm" v-model="units[i].elemen[j].elemen">
                                        </div>
                                        <div class="col-2">
                                            <a class="btn btn-sm btn-success" href="#" @click.prevent="tambahKuk(i, j)"><i class="ft-plus"></i></a>
                                            <a class="btn btn-sm btn-danger" href="#" @click.prevent="hapusElemen(i, j)"><i class="ft-x"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th width="5%">#</th>
                                <th>Kuk</th>
                                <th width="10%">...</th>
                            </tr>
                            <tr v-for="(kuk, k) in elemen.kuk">
                                <td>@{{ k+1 }}</td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" v-model="units[i].elemen[j].kuk[k].kuk">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger" @click.prevent="hapusKuk(i, j, k)">
                                        <i class="ft-x"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-6">
                        <a href="{{ route('admin.skema.show', [$skema->id]) }}" class="btn btn-block btn-warning">
                            <i class="ft-chevron-left"></i> Kembali
                        </a>
                    </div>
                    <div class="col-6">
                        <button @click.prevent="submit" class="btn btn-block btn-primary">
                            <i class="ft-save"></i> Simpan
                        </button>
                    </div>
                </div>

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
                    if (!confirm("Yakin ingin menghapus unit ini ?")) return ;
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
                    if (!confirm("Yakin ingin menghapus elemen ini ?")) return ;
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
                    if (!confirm("Yakin ingin menghapus kuk ini ?")) return ;
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