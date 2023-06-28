<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\{
    DebtService,
    DebtorService,
    PayOffService
};
use App\Repositories\Db\{
    DebtRepository,
    DebtorRepository
};

use App\Models\{
    Debt,
    Debtor
};
use Illuminate\Support\ServiceProvider;

class ControlServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(DebtService::class, function () {
            return new DebtService(new DebtRepository((new Debt())));
        });

        $this->app->bind(PayOffService::class, function () {
            return new PayOffService(new DebtRepository((new Debt())));
        });

        $this->app->bind(DebtorService::class, function () {
            return new DebtorService(new DebtorRepository((new Debtor())));
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
