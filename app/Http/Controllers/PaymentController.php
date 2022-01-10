<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PayPal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopping_cart');
    }

    public function pay(Request $request)
    {
        $amount = $request->shopping_cart->amount();

        $paypal = new PayPal();
        $response = $paypal->charge($amount);

        // return var_dump($response->result->links);

        $redirectLinks = array_filter($response->result->links, function ($link) {
            return $link->method == 'REDIRECT';
        });

        $redirectLinks = array_values($redirectLinks);

        return redirect($redirectLinks[0]->href);
    }

    public function execute(Request $request)
    {
        $paypal = new Paypal();
        $response = $paypal->execute($request->paymentId, $request->PayerID);

        if ($response->statusCode == 200) {
            $order = Order::createFromPayPalResponse($response->result, $request->shopping_cart);

            if ($order) {
                Session::remove('shopping_cart_id');
                return view('payments.success', ['shopping_cart' => $request->shopping_cart, 'order' => $order]);
            }
        } else {
            return redirect(URL::route('cart_products.show'));
        }
    }
}
