<?php

namespace App\Providers;

use App\Models\Menu;
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
        view()->composer('layouts.pagina.pagina-plantilla', function($view){
            $view->with('menus', Menu::menus());
        });
        view()->composer('welcome', function($view){
            $view->with('menus', Menu::menus());
        });
    }
}
