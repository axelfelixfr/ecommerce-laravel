<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_name', 'line1', 'line2', 'city', 'country_code', 'postal_code',
        'email', 'shopping_cart_id', 'total', 'guide_number'
    ];

    public static function createFromPayPalResponse($paypalResponse, $shopping_cart)
    {
        $payer = $paypalResponse->payer;

        $orderData = (array) $payer->payer_info->shipping_address;

        $orderData['email'] = $payer->payer_info->email;
        $orderData['total'] = $shopping_cart->amountInCents();
        $orderData['shopping_cart_id'] = $shopping_cart->id;

        return Order::create($orderData);
    }
}
