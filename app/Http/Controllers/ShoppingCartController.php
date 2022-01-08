<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsCollection;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopping_cart');
    }

    public function show(Request $request)
    {
        // var_dump($request->shopping_cart->getProducts);
        // die();
        return view('shopping_cart.show', ['products' => $request->shopping_cart->products()->get()]);
    }

    public function products(Request $request)
    {
        return new ProductsCollection($request->shopping_cart->products()->get());
    }
}
