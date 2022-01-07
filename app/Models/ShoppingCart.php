<?php

namespace App\Models;

use Hamcrest\Text\IsEmptyString;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    public static function findOrCreateById($shopping_cart_id)
    {
        if ($shopping_cart_id) {
            return ShoppingCart::find($shopping_cart_id);
        } else if (IsEmptyString::isEmptyOrNullString($shopping_cart_id)) {
            return ShoppingCart::create();
        }
    }

    public function getProducts()
    {
        return $this->belongsToMany(Product::class, 'product_in_shopping_carts');
    }

    public function productsCount()
    {
        return $this->getProducts->count();
    }
}
