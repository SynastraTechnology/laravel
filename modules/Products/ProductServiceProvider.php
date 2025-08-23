<?php

namespace Modules\Products;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ProductServiceProvider extends ServiceProvider
{
    protected $moduleNamespace = 'Modules\Products\Controllers';

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'products');
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(__DIR__ . '/Routes/web.php');
    }
}
