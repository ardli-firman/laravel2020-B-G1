@extends('layouts.app',['navTitle' => 'Master / Mahasiswa / show'])

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--8">
    <div class="col-md-12">
        <div class="row-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h1>Detail {{$mahasiswa->nama}}</h1>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('nama', 'Nama') !!}
                            {!! Form::text('nama', $mahasiswa->nama, ['class'=>'form-control form-control-alternative','placeholder'=>'Nama','disabled'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('nim', 'Nim') !!}
                            {!! Form::text('nim', $mahasiswa->nim, ['class'=>'form-control form-control-alternative','placeholder'=>'Email','disabled'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', $mahasiswa->email, ['class'=>'form-control form-control-alternative','placeholder'=>'Email', 'disabled' => true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('semester', 'Semester') !!}
                            {!! Form::text('semester', $mahasiswa->semester, ['class'=>'form-control form-control-alternative','placeholder'=>'Semester','disabled'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('kelas', 'Kelas') !!}
                            {!! Form::text('kelas', $mahasiswa->kelas, ['class'=>'form-control form-control-alternative','placeholder'=>'Kelas','disabled'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tahun', 'Tahun') !!}
                            {!! Form::text('tahun', $mahasiswa->tahun, ['class'=>'form-control form-control-alternative','placeholder'=>'Tahun','disabled'=>true]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('foto', 'Foto') !!}
                        </div>
                        <div class="form-group">
                            <img src="{{asset('storage/'.$mahasiswa->foto)}}" alt="" class="img-thumbnail" width="200px" height="200px">
                        </div>
                        <div class="form-group">
                            {!! Form::label('file', 'File') !!}
                            <a href="{{url('storage/'.$mahasiswa->file)}}">{{url('storage/'.$mahasiswa->file)}}</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- @include('layouts.headers.cards') --}}
@endsection
