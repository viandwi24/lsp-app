@extends('layouts.dashboard', ['title' => 'Admin \ Skema \ Edit \ Jadwal'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'Manajemen Skema', 'link' => url()->route('admin.skema.index') ],
    ['text' => 'Edit' ],
    ['text' => 'Jadwal' ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header type="basic-bottom" :title="$skema->judul" :breadcrumb="$breadcrumb" :autoBread="false" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Jadwal</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a class="btn btn-sm btn-success" href="#" @click.prevent="modalTambah"><i class="ft-plus"></i> Tambah Jadwal</a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <form id="form-jadwal" method="POST" action="{{ url()->route('admin.skema.update', [$skema->id]) . '?tab=jadwal' }}" class="form">
                            @method('put')
                            @csrf
                            <div id="input-jadwal-array" v-for="(item, i) in data">
                                <input type="hidden" name="jadwal[]" :value="item">
                            </div>

                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center" width="7%">...</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, i) in data">
                                        <td>@{{ i+1 }}</td>
                                        <td>@{{ (jadwals.find(e => e.id == item )).nama }}</td>
                                        <td>
                                            <button @click.prevent="hapusJadwal(i)" class="btn btn-sm btn-danger">
                                                <i class="ft-x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-right mt-2">
                                <a href="{{ route('admin.skema.show', [$skema->id]) }}" class="btn btn-warning">
                                    <i class="ft-chevron-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ft-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>

    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <label>Pilih Jadwal :</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="tambahJadwal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                jadwalsSelect2: @JSON($jadwals->array()),
                jadwals: @JSON($jadwals->original()),
                data: @JSON($skema->jadwal->pluck('id')),
                jadwal_id: null
            },
            methods: {
                getJadwalSelect() {
                    let data = this.data
                    let result = this.jadwalsSelect2.filter(e => !data.includes(e.id))
                    return result
                },
                modalTambah() {
                    if ($('#jadwal_id').hasClass("select2-hidden-accessible")) $('#jadwal_id').select2("destroy")
                    $('#modal-body #jadwal_id').remove()
                    $('#modal-body').append(`<select name="jadwal_id" class="select2 form-control" id="jadwal_id" style="width: 100%;"></select>`)

                    $('#jadwal_id').select2({ data: this.getJadwalSelect(), dropdownParent: $('#modalTambah') });
                    $('#modalTambah').modal('show');
                },
                tambahJadwal() {
                    this.jadwal_id = $('#jadwal_id').val();
                    this.data.push(parseInt(this.jadwal_id));
                },
                hapusJadwal(index) {
                    this.data.splice(index, 1);
                }
            },
        });
    </script>
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endpush

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
@endpush
