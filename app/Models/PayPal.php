<?php

namespace App\Models;

// use URL;
use Config;
use Illuminate\Support\Facades\URL as FacadesURL;
use PayPal\Core\PayPalHttpClient;
use PayPal\Core\SandboxEnvironment;
use PayPal\v1\Payments\PaymentCreateRequest;
use PayPal\v1\Payments\PaymentExecuteRequest;
use PharIo\Manifest\Url;

// use PayPal\Cor

class PayPal
{
  public $client, $environment;

  public function __construct()
  {
    $clientid = config('services.paypal.clientid');
    $secret = config('services.paypal.secret');

    $this->environment = new SandboxEnvironment($clientid, $secret);

    $this->client = new PayPalHttpClient($this->environment);
  }

  // Para solicitar el cobro
  // Se construye la petición y la retorna
  public function buildPaymentRequest($amount)
  {
    $request = new PaymentCreateRequest();

    $body = [
      "intent" => "sale",
      "transactions" => [
        [
          "amount" => ["total" => $amount, "currency" => "MXN"]
        ]
      ],
      "payer" => [
        "payment_method" => "paypal"
      ],
      "redirect_urls" => [
        "cancel_url" => FacadesURL::route('cart_products.show'),
        "return_url" => FacadesURL::route('payment.execute')
      ]
    ];

    $request->body = $body;

    return $request;
  }

  // Aquí ya se ejecuta la solicitud
  public function charge($amount)
  {
    return $this->client->execute($this->buildPaymentRequest($amount));
  }

  public function execute($paymentId, $payerId)
  {
    $paymentExecute = new PaymentExecuteRequest($paymentId);

    $paymentExecute->body = [
      "payer_id" => $payerId
    ];

    return $this->client->execute($paymentExecute);
  }
}
