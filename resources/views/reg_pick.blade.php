@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-4">
                        <h1><b>Let's get you started</b></h1>
                        <span class="text-muted">
                        Choose an account to get started. Please choose according to your field
                        </span>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">

                    <a href="{{route('registrasi.kaprodi')}}" class="btn btn-outline-default btn-lg btn-block py-lg-2" type="button">
	                        <span class="btn-inner--icon py-lg-5"><div class="icon icon-shape bg-secondary text-dark rounded-circle shadow">
                            <i class="ni ni-hat-3"></i></div></span>
                            <div class="row">
                            <div class="col">
                            <span class="btn-inner--text  mt-3 mb-0">Sign up for Kaprodi</span>
                            </div>
                            </div>
                            </a>

                            <a href="{{route('registrasi.dosen')}}" class="btn btn-outline-default btn-lg btn-block py-lg-2" type="button">
	                        <span class="btn-inner--icon py-lg-5"><div class="icon icon-shape bg-secondary text-dark rounded-circle shadow">
                            <i class="ni ni-hat-3"></i></div></span>
                            <div class="row">
                            <div class="col">
                            <span class="btn-inner--text  mt-3 mb-0">Sign up for Dosen</span>
                            </div>
                            </div>
                            </a>

                            <a href="{{route('registrasi.mahasiswa')}}" class="btn btn-outline-default btn-lg btn-block py-lg-2" type="button">
	                        <span class="btn-inner--icon py-lg-5"><div class="icon icon-shape bg-secondary text-dark rounded-circle shadow">
                            <i class="ni ni-hat-3"></i></div></span>
                            <div class="row">
                            <div class="col">
                            <span class="btn-inner--text  mt-3 mb-0">Sign up for Mahasiswa</span>
                            </div>
                            </div>
                            </a>

                    </div>
                </div>
                <div class="row mt-3">
                <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('login') }}" class="text-light">
                                <small>{{ __('Have account?') }}</small>
                            </a>
                        @endif
                </div>
                </div>
            </div>

        </div>
    </div>
@endsection
