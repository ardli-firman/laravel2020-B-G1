@extends('layouts.app',['navTitle' => 'Dashboard'])

@section('content')
    @include('layouts.headers.cards')


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 col-lg-12">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">
                                    Status judul TA Anda
                                </h5>
                                <span class="h2 font-weight-bold mb-0"><button class="btn btn-sm btn-success">Diterima</button></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                <i class="fas fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
