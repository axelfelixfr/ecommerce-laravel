<?php

namespace App\Http\Controllers;

use App\Models\ProductInShoppingCart;
use Illuminate\Http\Request;

class ProductInShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopping_cart');
    }

    public function store(Request $request)
    {
        // $request->shopping_cart;
        $product_in_shopping_cart = ProductInShoppingCart::create([
            'shopping_cart_id' => $request->shopping_cart->id,
            'product_id' => $request->product_id
        ]);

        if ($product_in_shopping_cart) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['product' => 'No se pudo agregar el producto']);
    }

    public function destroy($id)
    {
    }
}
