<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Repositories\StocksRepository;
use App\Services\StockBuyService;
use App\Services\StockSellService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function index()
    {
        return view('home');
    }

    public function search(Request $request): View
    {
        $companyName = Str::lower($request->get('company'));
        $cacheKey = 'companies.search.' . $companyName;

        if (Cache::has($cacheKey))
        {
            return view('home')->with(['companies' => Cache::get($cacheKey)]);
        }
        $companies = $this->stocksRepository->searchCompanies($companyName);

        Cache::put($cacheKey, $companies);

        return view('home')->with(
            [
                'companies' => $companies
            ]);
    }

    public function view(string $companySymbol)
    {
        //validate if needed or put in request class or use try catch
        $company = $this->stocksRepository->getCompanyBySymbol($companySymbol);
        return view('stocks.company-info')->with(
            [
                'company' => $company,
            ]);
    }

    public function buy(string $company, string $symbol, string $price, Request $request, StockBuyService $service): RedirectResponse
    {
        if ($this->checkTime())
        {
            $service->execute($company, $symbol, $price, $request);
            return redirect()->back();
        }
        return redirect()->back()->with(['error' => 'Action failed, allowed on working days between 16:00 and 23:00']);
    }

    public function sell(Stock $stock, Request $request, StockSellService $service): RedirectResponse
    {
        if ($this->checkTime())
        {
            $service->execute($stock, $request->get('stock-amount'));
            return redirect()->back();
        }
        return redirect()->back()->with(['error' => 'Action failed, allowed on working days between 16:00 and 23:00']);
    }

    public function portfolio(): View
    {
        $stocks = Auth::user()->stocks()->paginate(10);

        return view('users.portfolio')->with(
            [
                'stocks' => $stocks,
                'finnHub' => $this->stocksRepository,
            ]);
    }

    private function checkTime(): bool
    {
        return now()->isWeekday() && now()->isBetween(Date::createFromTimeString('16:00'), Date::createFromTimeString('23:00'));
    }

}
