<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // if (request()->server('HTTP_ACCEPT_ENCODING') && strpos(request()->server('HTTP_ACCEPT_ENCODING'), 'gzip') !== false) {
        //     ob_start("ob_gzhandler");
        // }        
    }
}
