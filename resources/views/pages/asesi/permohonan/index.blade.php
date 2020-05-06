@extends('layouts.dashboard', ['title' => 'Asesi \ Permohonan'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Permohonan Saya" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">

                <x-dashboard-card title="Permohonan" classBody="card-table">
                    <x-slot name="heading">
                        <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </x-slot>

                    <!-- Body -->
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="8%">#</th>
                                    <th>Skema</th>
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
                        ajax: "{{ url()->route('asesi.permohonan.index') }}",
                        processing: true,
                        order: [[0, 'asc']],
                        columnDefs: [ { orderable: false, targets: [2] }, ],
                        columns: [
                            { render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                            { data: 'skema.judul' },
                            { data: 'status' },
                            { data: 'created_at_diff' },
                            {
                                data: null,
                                render: (data, type, row) => `
                                    <div>
                                        <a href="{{ url()->route('asesi.permohonan.index') . '/' }}`+data.id+`" class="btn btn-sm btn-success"><i class="ft-download"></i></a>
                                    </div>
                                `
                            },
                        ]
                    });
                },
            },
            mounted() {
                this.loadTable()
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false))
            }
        })
    </script>
@endpush