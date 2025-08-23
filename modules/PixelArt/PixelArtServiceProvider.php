<?php
namespace Modules\PixelArt;

use Illuminate\Support\ServiceProvider;

class PixelArtServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'pixelart');
    }

    public function register()
    {
        //
    }
}
