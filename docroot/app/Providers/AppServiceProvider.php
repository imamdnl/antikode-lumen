<?php

namespace App\Providers;

use App\Adapters\Gateways\Database\Mysql\Repository\BrandRepositoryMysql;
use App\Adapters\Gateways\Database\Mysql\Repository\OutletRepositoryMysql;
use App\Adapters\Gateways\Database\Mysql\Repository\ProductRepositoryMysql;
use App\Domain\Repository\IBrandRepositoryMysql;
use App\Domain\Repository\IOutletRepositoryMysql;
use App\Domain\Repository\IProductRepositoryMysql;
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
        $this->app->singleton(IBrandRepositoryMysql::class, BrandRepositoryMysql::class);
        $this->app->singleton(IOutletRepositoryMysql::class, OutletRepositoryMysql::class);
        $this->app->singleton(IProductRepositoryMysql::class, ProductRepositoryMysql::class);
    }
}
