@extends('layouts.dashboard', ['title' => 'Admin \ User \ Asesi'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ],
    ['text' => 'User' ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Asesi" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Asesi</h4>
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
                                <li><a class="btn btn-sm btn-success" href="{{ url()->route('admin.user.asesi.create') }}"><i class="ft-plus"></i> Tambah</a></li>
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
                                    <th>Nama</th>
                                    <th>Email</th>
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
            },
            methods: {
                loadTable() {
                    if (this.datatable != null) {
                        this.datatable = null
                        this.datatable.destroy()
                    }

                    this.datatable = $('#table').DataTable( {
                        ajax: "{{ url()->route('admin.user.asesi.index') }}",
                        processing: true,
                        order: [[1, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 4] }, ],
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
                            { data: 'nama' },
                            { data: 'email' },
                            {
                                data: null,
                                render: (data, type, row) => `
                                    <div>
                                        <a href="{{ url()->route('admin.user.asesi.index') . '/' }}`+data.id+`/edit" class="btn btn-sm btn-warning"><i class="ft-edit"></i></a>
                                        <form method="post" action="{{ url()->route('admin.user.asesi.index') . '/' }}`+data.id+`" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="ft-trash"></i></button>
                                        </form>
                                    </div>
                                `
                            },
                        ]
                    });
                },
            },
            created() {
            },
            mounted() {
                this.loadTable()
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false))
                $('#bulkDelete').on('click', () => {
                    var url = '{{ url()->route("admin.user.asesi.index") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush