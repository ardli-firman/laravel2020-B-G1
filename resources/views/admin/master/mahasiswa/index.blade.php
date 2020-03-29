@extends('layouts.app',['navTitle' => 'Master / Mahasiswa'])

{{-- @section('form-search')
{!! Form::open(['class'=>'navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto']) !!}
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
                <button>Search</button>
            </div>
        </div>
{!! Form::close() !!}
@endsection --}}

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--8">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span class="alert-inner--text">{{$error}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endforeach
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-inner--text">{{session('success')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm">
                                    <h3 class="">Mahasiswa</h3>
                                </div>
                                <div class="col-sm d-flex justify-content-end">
                                    <form action="">
                                        <div class="form-group">
                                            <div class="input-group">
                                                {!! Form::text('search', '', ['class'=>'form-control-sm form-control-alternative']) !!}
                                                <div class="input-group-prepend">
                                                    <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a id="btn-tambah-mhs" data-toggle="modal" data-target="#tambahMahasiswa" href="" class="btn btn-sm btn-secondary text-green">
                                        Tambah Mahasiswa
                                    </a>
                                    <a id="btn-tambah-batch" data-toggle="modal" data-target="#tambahBatch" href="" class="btn btn-sm btn-success">
                                        Tambah batch
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mahasiswa as $mhs)
                                    <tr>
                                        <td>{{$mhs->nama}}</td>
                                        <td>{{$mhs->nim}}</td>
                                        <td>{{$mhs->semester}}</td>
                                        <td>{{$mhs->kelas}}</td>
                                        <td>{{$mhs->tahun}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a
                                                    class="btn btn-sm btn-icon-only text-light"
                                                    href="#"
                                                    role="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('admin.master.mahasiswa.show',$mhs->nim)}}">Detail</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <td>Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                                {{$mahasiswa->render()}}
                            <nav
                                class="d-flex justify-content-end"
                                aria-label="..."
                            ></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- @include('layouts.footers.auth') --}}
    @include('admin.master.mahasiswa.modal.tambah')
    @include('admin.master.mahasiswa.modal.batch')
    <script>
        document.getElementById("btn-tambah-mhs").addEventListener("click", function(){
            document.getElementById("form-tambah-mhs").reset();
        });
    </script>
@endsection
