@extends('layouts.dashboard', ['title' => 'Admin \ Tempat Uji Kompetensi'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Admin', 'link' => url('admin') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Manajemen Tempat Uji Kompetensi" :breadcrumb="$breadcrumb" />
    
    <!-- content -->
    <x-dashboard-content>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tempat Uji Kompetensi</h4>
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
                                <li><a class="btn btn-sm btn-success" href="{{ url()->route('admin.tuk.create') }}"><i class="ft-plus"></i> Tambah</a></li>
                                <li><a id="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body card-dashboard">
                        <table id="table" class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th width="5%"><input type="checkbox" id="bulk_check_selectall"></th>
                                    <th width="8%">#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
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
        let datatable = null;

        function loadTable() {
            let index = 1;
            // if (datatable != null) return 

            datatable = $('#table').DataTable( {
                ajax: "{{ url()->route('admin.tuk.index') }}",
                processing: true,
                columns: [
                    { 
                        data: null,
                        sortable: false,
                        render: (data) => `
                            <input type="checkbox" class=".bulk" name="bulk_check" value="` + data.id + `">
                        `
                    },
                    { render: () => index++ },
                    { data: 'nama' },
                    { data: 'alamat' },
                    { data: 'no_telp' },
                    {
                        data: null,
                        render: (data, type, row) => `
                            <div>
                                <a href="{{ url()->route('admin.tuk.index') . '/' }}`+data.id+`/edit" class="btn btn-sm btn-warning"><i class="ft-edit"></i></a>
                                <form method="post" action="{{ url()->route('admin.tuk.index') . '/' }}`+data.id+`" style="display: inline-block;">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="ft-trash"></i></button>
                                </form>
                            </div>
                        `
                    },
                ]
            });
        }
        
        $('#reload').on('click', () => datatable.ajax.reload())
        $('#bulkDelete').on('click', () => {
            var url = '{{ url()->route("admin.tuk.index") }}/' + bulkSelectedItem
            var form = $(`<form action="` + url + `" method="post"> @method('delete') @csrf </form>`);
            $('body').append(form);
            form.submit();
        })
        loadTable()
    </script>
@endpush