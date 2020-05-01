@extends('layouts.dashboard', ['title' => 'Admin \ Skema'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url()->route('admin.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Skema" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Skema</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <div class="dropdown" style="display: inline-block;">
                                    <button class="btn btn-sm btn-danger dropdown-toggle disable-on-bulk-check-null" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi Untuk <span class="bulk_check_count"></span> Item
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" id="bulkDelete">Hapus</a>
                                    </div>
                                </div>
                                <li><a class="btn btn-sm btn-success" href="{{ route('admin.skema.create') }}"><i class="ft-plus"></i> Tambah</a></li>
                                <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard card-table">
                        <table id="table" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="5%">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="bulk_check_selectall" class="custom-control-input">
                                            <label class="custom-control-label" for="bulk_check_selectall"></label>
                                        </div>
                                    </th>
                                    <th width="8%">#</th>
                                    <th>Judul</th>
                                    <th>Kode</th>
                                    <th>Admin</th>
                                    <th width="15%" class="text-center">...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard-content>
@endsection

@push('css-library')
    <link rel="stylesheet" type="text/css" href="{{ assets('vendors/css/tables/datatable/datatables.min.css') }}">
@endpush

@push('js-library')
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
                    { data: 'judul' },
                    { data: 'kode' },
                    { data: 'admin.nama' },
                    {
                        data: null,
                        render: (data, type, row) => `
                            <div>
                                <a href="{{ route('admin.skema.index') . '/' }}`+data.id+`" class="btn btn-sm btn-success"><i class="ft-edit-3"></i></a>
                                <form method="post" action="{{ route('admin.skema.index') . '/' }}`+data.id+`" style="display: inline-block;">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="ft-trash"></i></button>
                                </form>
                            </div>
                        `
                    },
                ]
            },
            methods: {
                loadTable() {
                    if (this.datatable != null) {
                        this.datatable = null
                        this.datatable.destroy()
                    }

                    this.datatable = $('#table').DataTable( {
                        ajax: "{{ route('admin.skema.index') }}",
                        processing: true,
                        order: [[1, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 5] }, ],
                        columns: this.columns
                    });
                },
            },
            mounted() {
                this.loadTable()
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false))
                $('#bulkDelete').on('click', () => {
                    var url = '{{ route("admin.skema.index") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush