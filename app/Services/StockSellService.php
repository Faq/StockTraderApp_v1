<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\Transaction;
use App\Repositories\StocksRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockSellService
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function execute(Stock $symbol, int $quantity): RedirectResponse
    {
        $user = Auth::user();

        $currentPrice = $this->stocksRepository->getPrice($symbol->symbol);
        $total = $currentPrice * $quantity;

        $userStock = Stock::where(
            [
                'user_id' => $user->id,
                'symbol' => $symbol->symbol,
            ])->first();
        if ($userStock->quantity < $quantity || $quantity < 1)
        {
            return redirect()->back()->with(['error' => 'No such stock amount available']);
        }

        if ($userStock->quantity === $quantity)
        {
            $userStock->delete();
        } else {
            $userStock->update(
                [
                    'sell_price' => $currentPrice,
                    'quantity' => $userStock->quantity - $quantity,
                ]);
        }

        $transaction = (new Transaction([
            'symbol' => $symbol->symbol,
            'quantity' => $quantity,
            'credits_amount' => $total,
            'action' => 'Sold',
            'created_at' => Carbon::now()
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->deposit($total);

        return redirect()->back()->with(['success' => 'Successfully!']);
    }
}
