<?php

namespace App\Providers;

use App\Repositories\FinnhubStocksRepository;
use App\Repositories\StocksRepository;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StocksRepository::class, FinnhubStocksRepository::class);

        $this->app->bind(FinnhubStocksRepository::class, function () {
            $config = Configuration::getDefaultConfiguration()->setApiKey('token', env('FINNHUB_API_KEY'));
            $client = new DefaultApi(
                new Client(),
                $config
            );
            return new FinnhubStocksRepository($client);
        });

    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
