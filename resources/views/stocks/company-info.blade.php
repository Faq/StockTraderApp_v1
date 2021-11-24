@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th scope="col" class="col d-flex justify-content-center text-center">Logo</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Symbol</th>
                                    <th class="text-center">Industry</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Currency</th>
                                    <th class="text-center">Exchange</th>
                                    <th class="text-center">Web Url</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <td><img src="{{$company->getProfile()->getLogo()}}" class="rounded mx-auto d-block"
                                         alt="Logo" style="width: 40px">
                                </td>
                                <td class="col text-center">{{$company->getName()}}</td>
                                <td class="col text-center">{{$company->getSymbol()}}</td>
                                <td class="col text-center">{{$company->getProfile()->getFinnhubIndustry()}}</td>
                                <td class="col text-center">{{$company->getPrice()}}</td>
                                <td class="col text-center">{{$company->getProfile()->getCountry()}}</td>
                                <td class="col text-center">{{$company->getProfile()->getCurrency()}}</td>
                                <td class="col text-center">{{$company->getProfile()->getExchange()}}</td>
                                <td class="col text-center"><a href="{{$company->getProfile()->getWeburl()}}"
                                                               target="_blank"
                                                               class="btn btn-info btn-sm rounded-pill py-0 editLink">Link</a>
                                </td>
                                <td class="col text-center">
                                    @include('messages.flash-message')
                                    <form method="post"
                                          action="{{ route('stock.buy',
                                            [
                                                'company' => $company->getName(),
                                                'symbol' => $company->getSymbol(),
                                                'price' => $company->getPrice()
                                             ]) }}"
                                          class="content-center text-sm">
                                        @csrf
                                        <div class="input-group mt-2">
                                            <input class="h-8" id="stock-amount" name="stock-amount" type="text"
                                                   placeholder="Stock amount">
                                            <button type="submit"
                                                    class="btn btn-gray-800 animate-up-2">
                                                Buy
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
