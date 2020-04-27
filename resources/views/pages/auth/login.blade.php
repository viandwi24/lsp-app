@extends('layouts.page', ['title' => 'Login'])

@section('body')
    <body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
@stop

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ assets('css/pages/login-register.css') }}">
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ assets('images/logo/logo.jpeg') }}" alt="branding logo" height="76" class="mb-2">
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                        <span>Masuk Menggunakan Kredensial</span>
                                    </p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @if (session('credentials'))
                                        <div class="alert alert-danger">
                                            {{ session('credentials') }}
                                        </div>              
                                        @endif
                                        <form class="form-horizontal form-simple" action="{{ url()->route('login.post') }}" method="POST">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="email" type="email" class="form-control" id="user-email" placeholder="Your Email" required autofocus>
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="password" type="password" class="form-control" id="user-password" placeholder="Enter Password" required>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">
                                                    <fieldset>
                                                        <input name="remember" type="checkbox" id="remember-me" class="chk-remember">
                                                        <label for="remember-me">Remember</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block">
                                                <i class="ft-unlock"></i> Login
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    &copy; 2020 <a href="#">D-IT Software</a>
                                    &amp; Made with <i class="ft-heart pink"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ assets('vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ assets('vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            'use strict';
            //Login Register Validation
            if($("form.form-horizontal").attr("novalidate")!=undefined){
                $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
            }

            // Remember checkbox
            if($('.chk-remember').length){
                $('.chk-remember').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                });
            }
        });
    </script>
@endpush