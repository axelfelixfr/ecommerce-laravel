<?php

namespace App\Providers;

use App\Models\ShoppingCart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            // Guardamos el nombre de la session
            $sessionName = 'shopping_cart_id';
            // En la request, tratamos de obtener la session por su nombre para obtenerla
            $shopping_cart_id = Session::get($sessionName);
            // Usamos el metodo 'findOrCreateById' para ver si existe la session o no
            // Si la session no existe, entonces la crea
            $shopping_cart = ShoppingCart::findOrCreateById($shopping_cart_id);
            // Una vez creada o buscada, la pasamos a la request
            Session::put($sessionName, $shopping_cart->id);
            $view->with('shopping_cart', $shopping_cart->productsCount());
        });
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
