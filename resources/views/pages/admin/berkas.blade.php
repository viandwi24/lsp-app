@extends('layouts.dashboard', ['title' => 'Admin \ Berkas'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => route('admin.berkas') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Berkas" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <div>
            <x-dashboard-card title="Berkas" classBody="card-table">
                <x-slot name="heading">
                    <li><a class="btn btn-sm btn-success" href="#" @click.prevent="openModalCreate"><i class="ft-plus"></i> Tambah</a></li>
                    <div class="dropdown" style="display: inline-block;">
                        <button class="btn btn-sm btn-danger dropdown-toggle disable-on-bulk-check-null" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi Untuk <span class="bulk_check_count"></span> Item
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="bulkDelete">Hapus</a>
                        </div>
                    </div>
                    <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </x-slot>

                <!-- Body -->
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <div class="custom-control custom-checkbox text-center">
                                        <input type="checkbox" id="bulk_check_selectall" class="custom-control-input">
                                        <label class="custom-control-label" for="bulk_check_selectall"></label>
                                    </div>
                                </th>
                                <th width="8%">#</th>
                                <th>User</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Ukuran</th>
                                <th width="14%" class="text-center">...</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </x-dashboard-card>
        </div>

    </x-dashboard-content>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Tambah Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadFile" method="POST" enctype="multipart/form-data" action="{{ route('admin.berkas.store') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>User</label>
                            <select
                              name="user_id"
                              class="select2 form-control"
                              id="selectUser"
                              style="width: 100%;">
                            </select>
                        </div>
                        <div class="form-grup">
                            <label>File</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css-library')
    <link rel="stylesheet" href="{{ assets('vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/tables/datatable/datatables.min.css') }}">
@endpush

@push('js-library')
    <script src="{{ assets('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ assets('vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ assets('js/scripts/bulk-datatables.js') }}"></script>
@endpush

@push('js')
    <script>
        var vm = new Vue({
            el: '#app',
            data: {
                datatable: null,
                columns: [
                            { 
                                data: null,
                                render: (data) => `
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="bulk custom-control-input" id="bulk_check` + data.id + `" name="bulk_check" value="` + data.id + `">
                                        <label class="custom-control-label" for="bulk_check` + data.id + `"></label>
                                    </div>
                                `
                            },
                            { render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                            { data: 'user_nama' },
                            { data: 'nama' },
                            { data: 'tipe' },
                            {
                                data: 'ukuran',
                                render: (data, type, row) => vm.bitToSize(data)
                            },
                            {
                                data: null,
                                render: (data, type, row) => `
                                    <div>
                                        <a href="{{ route('berkas.download') }}/` + data.path + `" class="btn btn-sm btn-success"><i class="ft-download"></i></a>
                                        <form method="post" action="{{ url()->route('admin.berkas') . '/' }}`+data.id+`" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="ft-trash"></i></button>
                                        </form>
                                    </div>
                                `
                            },
                        ]
            },
            methods: { //
                loadTable() {
                    if (this.datatable != null) {
                        this.datatable = null
                        this.datatable.destroy()
                    }

                    this.datatable = $('#table').DataTable( {
                        ajax: "{{ url()->route('admin.berkas') }}",
                        processing: true,
                        serverSide: true,
                        order: [[1, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 6] }, ],
                        columns: this.columns
                    });
                },
                triggerForm() {
                    $('#file').trigger('click');
                },
                formChange(e) {
                    this.loading = true
                    $('#form-file').submit();
                },
                bitToSize(bytes, decimals = 2) {
                    if (bytes === 0) return '0 Bytes';

                    const k = 1024;
                    const dm = decimals < 0 ? 0 : decimals;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

                    const i = Math.floor(Math.log(bytes) / Math.log(k));

                    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
                },


                openModalCreate() {
                    $('#modalCreate').modal('show');
                    $('#selectUser').select2({
                        dropdownParent: $("#modalCreate"),
                        ajax: {
                            url: "{{ route('admin.berkas') }}",
                            dataType: 'json',
                            data: function (params) {
                                var query = { q: params.term, users: true };
                                return query;
                            },
                            processResults: function (data) {
                                return {
                                    results: data.data.map(e => { return {id: e.id, text: e.id + ' - ' + e.nama} })
                                };
                            }
                        },
                        placeholder: 'Search user name...',
                        minimumInputLength: 3,
                    });
                }

            },
            created() {
            },
            mounted() {
                this.loadTable();
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false));
                $('#bulkDelete').on('click', () => {
                    var url = '{{ url()->route("admin.berkas") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush