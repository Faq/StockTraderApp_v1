@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('Search results:') }}</h2>
                            @if (!empty($companies))
                                <table class="table table-hover">
                                    <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th>Symbol</th>
                                        <th>Info</th>
                                    </tr>
                                    </thead>
                                    @foreach($companies->toArray() as $company)
                                        <tbody>
                                        <td>{{$company->getName()}}</td>
                                        <td>{{$company->getSymbol()}}</td>
                                        <td><a
                                                href="{{ route('stock.info', $company->getSymbol()) }}"
                                                class="btn btn-info btn-sm rounded-pill py-0 editLink">
                                                Info</a>
                                        </td>
                                        @endforeach
                                        </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
