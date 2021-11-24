@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('Simpleton') }}</h2>
                            <p>This project is made using Laravel and MySql to show <a class="link-info"
                                                                                       href="https://finnhub.io/"
                                                                                       target="_blank">finnhub.io</a>
                                data and do virtual actions with stocks. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
