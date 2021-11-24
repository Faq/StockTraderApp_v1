@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="mb-4 h5">{{ __('Transactions') }}</h2>
                            <table class="table table-hover">
                                <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th scope="col" class="text-center">Symbol</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Date </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td class="col text-center">{{ $transaction->symbol }}</td>
                                        <td class="col text-center">{{ $transaction->quantity }}</td>
                                        <td class="col text-center @if($transaction->action === 'Bought') text-danger @else + text-success @endif">{{ $transaction->credits_amount }}</td>
                                        <td class="col text-center">{{ $transaction->action }}</td>
                                        <td class="col text-center">{{ $transaction->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div
                                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
