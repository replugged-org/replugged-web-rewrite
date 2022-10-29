<?php

namespace App\Providers;

use App\Helpers\EndPro;
use App\Helpers\RoutePro;
use Illuminate\Support\ServiceProvider;

class ProServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('routepro', function () {
            return new RoutePro();
        });
        $this->app->bind('endpro', function () {
            return new EndPro();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
