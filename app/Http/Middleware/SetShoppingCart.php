<?php

namespace App\Http\Middleware;

use App\Models\ShoppingCart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SetShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Guardamos el nombre de la session
        $sessionName = 'shopping_cart_id';
        // En la request, tratamos de obtener la session por su nombre para obtenerla
        $shopping_cart_id = Session::get($sessionName);
        // Usamos el metodo 'findOrCreateById' para ver si existe la session o no
        // Si la session no existe, entonces la crea
        $shopping_cart = ShoppingCart::findOrCreateById($shopping_cart_id);
        // Una vez creada o buscada, la pasamos a la request
        Session::put($sessionName, $shopping_cart->id);
        // Le pasamos el shopping_cart al request
        $request->shopping_cart = $shopping_cart;
        return $next($request);
    }
}
