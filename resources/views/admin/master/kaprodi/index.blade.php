@extends('layouts.app',['navTitle' => 'Master / Kaprodi'])

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
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Kaprodi</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a id="btn-tambah-kap" data-toggle="modal" data-target="#tambahKaprodi" href="" class="btn btn-sm btn-primary text-white">
                                        Tambah Kaprodi
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
                                        <th scope="col">Email</th>
                                        {{-- <th scope="col">Semester</th>
                                        <th scope="col">Tahun</th> --}}
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kaprodi as $kap)
                                    <tr>
                                        <td>{{$kap->nama}}</td>
                                        <td>{{$kap->email}}</td>
                                        {{-- <td>{{$kap->semester}}</td>
                                        <td>{{$kap->tahun}}</td> --}}
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
                                                    <a class="dropdown-item" href="{{route('admin.master.kaprodi.show',$kap->id)}}">Detail</a>
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
                                {{$kaprodi->render()}}
                            <nav
                                class="d-flex justify-content-end"
                                aria-label="..."
                            ></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('admin.master.kaprodi.modal.tambah')
    {{-- <script>
        document.getElementById("btn-tambah-mhs").addEventListener("click", function(){
            document.getElementById("form-tambah-mhs").reset();
        });
    </script> --}}
@endsection
