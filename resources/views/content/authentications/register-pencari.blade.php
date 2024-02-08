@php
    $configData = Helper::appClasses();
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Register Basic - Pages')

@section('vendor-style')
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>

@endsection

@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-8" style="max-width: 60%;">

                <!-- Register Card -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => 'var(--bs-primary)'])</span>
                            <span
                                class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-2">

                        <form id="formAuthentication" class="mb-3" action="{{ url('/register-pencari-add') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-2">Daftar Akun Pencari Jasa 🚀</h4>
                                    {{-- <p class="mb-4">Make your app management easy and fun!</p> --}}
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter your Nama Lengkap" autofocus>
                                        <label for="name">Nama Lengkap</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Enter your Alamat" autofocus>
                                        <label for="alamat">Alamat</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Enter your username" autofocus>
                                        <label for="username">Username</label>
                                    </div>



                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms-conditions"
                                                name="terms">
                                            <label class="form-check-label" for="terms-conditions">
                                                I agree to
                                                <a href="javascript:void(0);">privacy policy & terms</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-2"><br></h4>
                                    {{-- <p class="mb-4">Make your app management easy and fun!</p> --}}
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Enter your email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-3">
                                        <input type="text" class="form-control" id="tlp" name="tlp"
                                            placeholder="Enter your No Handphone" autofocus>
                                        <label for="tlp">No Handphone</label>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="password" class="form-control" name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="mdi mdi-eye-off-outline"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary justify-content-center d-grid w-100" type="submit">
                                Sign up
                            </button>
                        </form>
                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ url('/') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>


                    </div>
                </div>
                <!-- Register Card -->
                <img alt="mask"
                    src="{{ asset('assets/img/illustrations/auth-basic-register-mask-' . $configData['style'] . '.png') }}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-register-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-register-mask-dark.png" />
            </div>
        </div>
    </div>
@endsection
