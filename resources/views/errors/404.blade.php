@extends('layouts.page', ['title' => '404'])

@section('body') <body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-col="1-column"> @endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 p-0">
                            <div class="card-header bg-transparent border-0">
                                <h2 class="error-code text-center mb-2">404</h2>
                                <h3 class="text-uppercase text-center">Page Not Found !</h3>
                            </div>
                            <div class="card-content text-center">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="ft-arrow-left"></i> Back</a>
                                <a href="{{ url('') }}" class="btn btn-primary"><i class="ft-home"></i> Home</a>
                                <a href="{{ route('login') }}" class="btn btn-info"><i class="ft-user"></i> login</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
  </div>
@stop


@push('css')
    <style>.error-code { font-size: 10rem; }</style>
@endpush