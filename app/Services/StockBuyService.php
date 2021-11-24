<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockBuyService
{
    public function execute(string $company, string $symbol, string $price, Request $request): RedirectResponse
    {
        $request->validate([
            'stock-amount' => ['required']
        ]);

        $user = Auth::user();

        $stockAmount = $request->get('stock-amount');
        $stocksPrice = $stockAmount * $price;
        $userCredits = $user->balance;

        if ($userCredits < $stocksPrice) {
            return redirect()->back()->with(['error' => 'Not enough funds!']);
        }

        $user->stocks()->updateOrCreate(
            [
                'user_id' => $user->id,
                'company' => $company,
                'symbol' => $symbol,
            ],
            [
                'buy_price' => $price,
                'total_price' => DB::raw('total_price + ' . $stocksPrice),
                'quantity' => DB::raw('quantity + ' . $stockAmount),
            ]
        );

        $transaction = (new Transaction([
            'symbol' => $symbol,
            'quantity' => $stockAmount,
            'credits_amount' => $stocksPrice,
            'action' => 'Bought',
            'created_at' => Carbon::now(),
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->withdraw($stocksPrice);

        return redirect()->back()->with(['success' => 'Successfully!']);
    }
}
