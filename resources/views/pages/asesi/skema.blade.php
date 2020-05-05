@extends('layouts.dashboard', ['title' => 'Asesi \ Daftar Skema'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.berkas.index') ],
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Daftar Skema" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <div>
            <x-dashboard-card title="Skema" classBody="card-table">
                <x-slot name="heading">
                    <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </x-slot>

                <!-- Body -->
                <table id="table" class="table table-striped table-bordered zero-configuration table-responsive">
                    <thead>
                        <tr>
                            <th width="8%">#</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Ukuran</th>
                            <th width="10%" class="text-center">...</th>
                        </tr>
                    </thead>
                </table>
            </x-dashboard-card>
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
                loading: false,
                datatable: null,
                columns: [
                            { render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                            { data: 'judul' },
                            { data: 'kode' },
                            { data: 'admin.nama' },
                            {
                                data: null,
                                render: (data, type, row) => `
                                    <a href="{{ route('asesi.permohonan.index') }}/create/` + data.id + `" class="btn btn-sm btn-success">Buat Permohonan</a>
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
                        ajax: "{{ url()->route('asesi.skema') }}",
                        processing: true,
                        order: [[1, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 3] }, ],
                        columns: this.columns
                    });
                },
            },
            created() {
            },
            mounted() {
                this.loadTable();
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false));
                $('#bulkDelete').on('click', () => {
                    var url = '{{ url()->route("asesi.skema") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush