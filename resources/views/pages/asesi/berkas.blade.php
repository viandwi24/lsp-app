@extends('layouts.dashboard', ['title' => 'Asesi \ Berkas'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesi', 'link' => route('asesi.berkas.index') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Berkas" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <div class="alert alert-info" v-if="loading">
            <i class="la la-spinner spinner"></i>
            Sedang mengupload berkas... dimohon menunggu sampai selesai.
        </div>
        <form action="{{ url()->route('asesi.berkas.store') }}" method="POST" id="form-file" enctype="multipart/form-data">
            @csrf
            <input @change="formChange" type="file" name="file" id="file" style="display: none">
        </form>

        <div v-if="!loading">
            <x-dashboard-card title="Berkas" classBody="card-table">
                <x-slot name="heading">
                    <div class="dropdown" style="display: inline-block;">
                        <button class="btn btn-sm btn-danger dropdown-toggle disable-on-bulk-check-null" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi Untuk <span class="bulk_check_count"></span> Item
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" id="bulkDelete">Hapus</a>
                        </div>
                    </div>
                    <li><a class="btn btn-sm btn-success" href="" @click.prevent="triggerForm"><i class="ft-plus"></i> Upload</a></li>
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
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Ukuran</th>
                                <th width="8%" class="text-center">...</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </x-dashboard-card>
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
                loading: false,
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
                            { data: 'nama' },
                            { data: 'tipe' },
                            {
                                data: null,
                                render: (data, type, row) => vm.bitToSize(data.ukuran)
                            },
                            {
                                data: null,
                                render: (data, type, row) => `
                                    <div>
                                        <form method="post" action="{{ url()->route('asesi.berkas.index') . '/' }}`+data.id+`" style="display: inline-block;">
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
                        ajax: "{{ url()->route('asesi.berkas.index') }}",
                        processing: true,
                        order: [[1, 'asc']],
                        columnDefs: [ { orderable: false, targets: [0, 3] }, ],
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
                }

            },
            created() {
            },
            mounted() {
                this.loadTable();
                $('#reload').on('click', () => this.datatable.ajax.reload(null, false));
                $('#bulkDelete').on('click', () => {
                    var url = '{{ url()->route("asesi.berkas.index") }}/' + bulkSelectedItem
                    var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
                    $('body').append(form);
                    form.submit();
                })
            }
        })
    </script>
@endpush