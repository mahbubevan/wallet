<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Composers\MasterComposer;
use App\Http\Composers\CurrencyComposer;
use App\Http\Composers\EmailComposer;

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
        Schema::defaultStringLength(191);
        
        View::composer('admin.layouts.app',MasterComposer::class);
        View::composer('admin.layouts.app',EmailComposer::class);
        View::composer('user.layouts.app',CurrencyComposer::class);
    }
}
