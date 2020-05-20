@extends('layouts.dashboard', ['title' => 'Asesor \ Skema'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => url()->route('asesor.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Skema" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <x-dashboard-card title="Skema" classBody="card-table">
                    <x-slot name="heading">
                        <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
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
                </x-dashboard-card>
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
                    { data: 'action' },
                ]
            },
            methods: {
                loadTable() {
                    if (this.datatable != null) {
                        this.datatable = null
                        this.datatable.destroy()
                    }

                    this.datatable = $('#table').DataTable( {
                        ajax: "{{ route('asesor.skema') }}",
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
                    var url = '{{ route("asesor.skema") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush