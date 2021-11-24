@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="mb-4 h5">{{ __('Portfolio') }}</h2>
                            <table class="table table-hover">
                                <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th scope="col" class="text-center">Company</th>
                                    <th class="text-center">Symbol</th>
                                    <th class="text-center">Buy price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Current Price</th>
                                    <th class="text-center">Sell Price</th>
                                    <th class="text-center">Possible gain</th>
                                    <th class="text-center">Added</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @include('messages.flash-message')
                                @foreach ($stocks as $stock)
                                    <tr>
                                        <td class="col text-center">{{ $stock->company }}</td>
                                        <td class="col text-center">{{ $stock->symbol }}</td>
                                        <td class="col text-center">{{ $stock->buy_price }}</td>
                                        <td class="col text-center">{{ $stock->quantity }}</td>
                                        <td class="col text-center">{{ round($stock->total_price, 2) }}</td>
                                        <td class="col text-center @if($finnHub->getPrice($stock->symbol) > $stock->buy_price) text-success @elseif ($finnHub->getPrice($stock->symbol) == $stock->buy_price) text-dark @else text-danger @endif">{{ $finnHub->getPrice($stock->symbol) }}</td>
                                        <td class="col text-center">{{ $stock->sell_price }}</td>
                                        <td class="col text-center">{{ ($finnHub->getPrice($stock->symbol) * $stock->quantity) - $stock->buy_price }}</td>
                                        <td class="col text-center">{{ $stock->created_at }}</td>
                                        <td class="col text-center">
                                            <form method="post" action="{{ route('sell.stock', $stock) }}">
                                                @csrf
                                                <div class="input-group mt-2">
                                                    <input type="text" name="stock-amount" class="form-control"
                                                           placeholder="Stock amount"
                                                           required>
                                                        <button type="submit"
                                                                class="btn btn-gray-800 animate-up-2">
                                                            Sell
                                                        </button>

                                                </div>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div
                                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                {{ $stocks->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
