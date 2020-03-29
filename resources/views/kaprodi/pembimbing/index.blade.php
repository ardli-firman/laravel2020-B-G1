@extends('layouts.app',['navTitle' => 'Pembimbing'])

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
                                <div class="col">
                                    <h3 class="mb-0">Pembimbing</h3>
                                </div>
                                <div class="col text-right">
                                </div>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Pembimbing</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($list_ta as $ta)
                                    <tr>
                                        <td>{{$ta->mahasiswa->nim}}</td>
                                        <td>{{$ta->mahasiswa->nama}}</td>
                                        <td>{{$ta->judul}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary">{{$ta->mahasiswa->pembimbing->count()}} / 2</button>
                                            @if ($ta->mahasiswa->pembimbing->count() < 2)
                                            <a class="btn btn-sm btn-icon btn-2 btn-danger" type="button" href="{{route('kaprodi.pembimbing.edit',$ta->nim)}}">
                                                <span class="btn-inner--icon text-white"><i class="ni ni-settings-gear-65 text-white"></i>Pilih pembimbing</span>
                                            </a>
                                            @else
                                            <a class="btn btn-sm btn-icon btn-2 btn-success" type="button" href="{{route('kaprodi.pembimbing.show',$ta->nim)}}">
                                                    <span class="btn-inner--icon text-white"><i class="ni ni-settings-gear-65 text-white"></i>Detail pembimbing</span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <td>Tidak ada data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                                {{$list_ta->render()}}
                            <nav
                                class="d-flex justify-content-end"
                                aria-label="..."
                            ></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('admin.managemen_user.mahasiswa.modal.aksi') --}}
@endsection
