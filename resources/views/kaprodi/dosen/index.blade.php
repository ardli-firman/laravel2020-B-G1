@extends('layouts.app',['navTitle' => 'Master / Dosen'])

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
                                    <h3 class="mb-0">Dosen</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a id="btn-tambah-kap" data-toggle="modal" data-target="#tambahDosen" href="" class="btn btn-sm btn-primary text-white">
                                        Tambah Dosen
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="table-responsive p-3">
                            <table class="table data-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('kaprodi.modal.tambah')
    @push('js')
    <script>
        document.getElementById("btn-tambah-mhs").addEventListener("click", function(){
            document.getElementById("form-tambah-mhs").reset();
        });
    </script>
    <script>
        $(function(){
            const table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kaprodi.dosen.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'aksi', name: 'aksi',orderable: false, searchable: false},

                ]
            })
        })
    </script>
    @endpush
@endsection

