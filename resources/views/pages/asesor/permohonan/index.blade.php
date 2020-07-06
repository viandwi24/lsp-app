@extends('layouts.dashboard', ['title' => 'Asesor \ Permohonan'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Permohonan Asesi" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">

                <x-dashboard-card title="Permohonan" classBody="card-table">
                    <x-slot name="heading">
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn btn-sm btn-danger dropdown-toggle disable-on-bulk-check-null" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi Untuk <span class="bulk_check_count"></span> Item
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="bulkApprove">Setujui</a>
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
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="bulk_check_selectall" class="custom-control-input">
                                            <label class="custom-control-label" for="bulk_check_selectall"></label>
                                        </div>
                                    </th>
                                    <th width="8%">#</th>
                                    <th>Skema</th>
                                    <th>Asesi</th>
                                    <th>Status</th>
                                    <th>Dibuat</th>
                                    <th width="8%" class="text-center">...</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
            },
            methods: {
                loadTable() {
                    if (this.datatable != null) {
                        this.datatable = null
                        this.datatable.destroy()
                    }

                    this.datatable = $('#table').DataTable( {
                        ajax: "{{ url()->route('asesor.permohonan.index') }}",
                        processing: true,
                        order: [[0, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 6] }, ],
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
                            { data: 'permohonan.skema.judul' },
                            { data: 'permohonan.asesi.nama' },
                            { data: 'status' },
                            { data: 'created_at' },
                            { data: 'action' },
                        ]
                    });
                },
            },
            mounted() {
                this.loadTable()
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false))
                $('#bulkApprove').on('click', () => {
                    var url = '{{ route("asesor.permohonan.index") }}/' + bulkSelectedItem + '?setujui'
                    var form = $(`<form action="` + url + `" method="post"> @method('put') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush