@extends('layouts.dashboard', ['title' => 'Asesor \ Profil'])

@php
$breadcrumb = [
    ['text' => 'Dashboard', 'link' => url('') ],
    ['text' => 'Asesor', 'link' => route('asesor.home') ]
];
@endphp

@section('content')
    <!-- content-header -->
    <x-dashboard-content-header title="Profil" :breadcrumb="$breadcrumb" />

    <!-- content -->
    <x-dashboard-content>
        <form action="{{ url()->route('asesor.profil.update') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-lg-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">Umum</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                </ul>
                            </div>  
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="form">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $user->nama }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="text" name="data[nik]" class="form-control" value="{{ $user->data->nik }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">Ganti Password</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                </ul>
                            </div>  
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="form">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Re-Password</label>
                                        <input type="text" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-danger">
                                * Isi Hanya Jika Ingin Mengganti Password
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">Tanda Tangan</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                </ul>
                            </div>  
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <canvas id="signature"></canvas>
                                        <input type="hidden" name="data[ttd]">
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button type="button" id="btn-clear" class="btn btn-danger">Hapus</button>
                                        <button type="button" id="btn-undo" class="btn btn-warning">Undo</button>
                                        <button type="button" class="btn btn-primary">Load Dari Gambar</button>
                                        <button type="button" class="btn btn-success">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <button class="btn btn-block btn-primary shadow">
                        <i class="ft-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </x-dashboard-content>
@endsection

@push('js-library')
    <script src="{{ assets('vendors/js/signature/signature_pad.min.js') }}"></script>
@endpush

@push('js')
    <script>
        $(document).ready(() => {
                var canvas = document.querySelector("canvas#signature");
                var signaturePad = new SignaturePad(canvas);

            setTimeout(() => {
                var parentWidth = $(canvas).parent().outerWidth();
                canvas.style.border = "1px solid black";
                canvas.style.width = "100%";
                canvas.style.height = "300px";
                
                document.getElementById('btn-clear').addEventListener('click', () => signaturePad.clear());
                document.getElementById('btn-undo').addEventListener('click', () => {
                    var data = signaturePad.toData();
                    if (data) {
                        data.pop();
                        signaturePad.fromData(data);
                    }
                });

                function resizeCanvas() {
                    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                    var parentWidth = $(canvas).parent().outerWidth();
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                    signaturePad.clear();
                }
                window.addEventListener("resize", resizeCanvas);
                resizeCanvas();

                signaturePad.fromDataURL('{{ $user->data->ttd }}');
            }, 1000);

            $('form').on('submit', (e) => {
                $('input[name="data[ttd]"]').val(signaturePad.toDataURL());
            });
        });
    </script>
@endpush