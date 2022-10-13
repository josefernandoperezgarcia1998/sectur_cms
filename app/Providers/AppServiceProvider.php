<?php

namespace App\Providers;

use App\Models\Footer;
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
        view()->composer('errors::403', function($view){
            // $contenidoFooterContacto = Footer::where('tipo', 1)->where('estado','Si')->get();
            // $contenidoFooterRecurso = Footer::where('tipo', 2)->where('estado','Si')->get();
            // $contenidoFooterRedes = Footer::where('tipo', 3)->where('estado','Si')->get();
            $view->with('menus', Menu::menus())
                ->with('contenidoFooterContacto', Footer::where('tipo', 1)->where('estado','Si')->get())
                ->with('contenidoFooterRecurso',Footer::where('tipo', 2)->where('estado','Si')->get())
                ->with('contenidoFooterRedes',Footer::where('tipo', 3)->where('estado','Si')->get() );
        });
        view()->composer('errors::404', function($view){
            // $contenidoFooterContacto = Footer::where('tipo', 1)->where('estado','Si')->get();
            // $contenidoFooterRecurso = Footer::where('tipo', 2)->where('estado','Si')->get();
            // $contenidoFooterRedes = Footer::where('tipo', 3)->where('estado','Si')->get();
            $view->with('menus', Menu::menus())
                ->with('contenidoFooterContacto', Footer::where('tipo', 1)->where('estado','Si')->get())
                ->with('contenidoFooterRecurso',Footer::where('tipo', 2)->where('estado','Si')->get())
                ->with('contenidoFooterRedes',Footer::where('tipo', 3)->where('estado','Si')->get() );
        });
        view()->composer('layouts.pagina.pagina-plantilla', function($view){
            $view->with('menus', Menu::menus());
        });
        view()->composer('welcome', function($view){
            $view->with('menus', Menu::menus());
        });
    }
}
