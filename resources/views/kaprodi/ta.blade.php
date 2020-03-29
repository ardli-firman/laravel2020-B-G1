@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">

            {{-- Dosen pembimbing --}}

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="https://argon-dashboard-laravel.creative-tim.com/argon/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header py-6">

                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <h1>Dosen</h1>
                            </div>
                            <div class="col">
                                <h1>Email</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <span>Nama dosen</span>
                            </div>
                            <div class="col">
                                <span>Email</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- End dosbing --}}

        </div>

        @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--text">{{session('success')}}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
        @endif

        <div class="row mt-3">

        {{-- Detail TA --}}
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>Detail Judul TA</h1>
                    </div>
                    <div class="card-body">
                        {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('judul', 'Judul Tugas Akhir',['class'=>'form-control-label']) !!}
                            {!! Form::text('judul', $ta->judul, ['class'=>'form-control form-control-alternative','disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('deskripsi', 'Deskripsi',['class'=>'form-control-label']) !!}
                            {!! Form::textarea('deskripsi', $ta->deskripsi, ['class'=>'form-control form-control-alternative','disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('manfaat', 'Manfaat',['class'=>'form-control-label']) !!}
                            {!! Form::text('manfaat', $ta->manfaat, ['class'=>'form-control form-control-alternative','disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Status Judul', ['class'=>'form-control-label']) !!}
                            <br>
                            <span class="btn btn-sm btn-success">{{$ta->status_ta}}</span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        {{-- End detail --}}
        </div>

    </div>
@endsection
