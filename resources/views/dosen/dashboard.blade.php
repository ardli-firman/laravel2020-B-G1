@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="row mb-4 mt--8 ml-4 mr-4">
        <div class="col-xl-4 col-lg-12">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-black">Total TA Semua Mahasiswa</h5>
                        <span class="h2 font-weight-bold mb-0 text-black">{{$judulta}}</span>
                    </div>
                <div class="col-auto">
                    <div class="icon icon-shape bg-primary text-dark rounded-circle shadow">
                        <i class="ni ni-paper-diploma"></i>
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
