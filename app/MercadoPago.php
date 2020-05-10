<?php

namespace App;

use App\Order;
use Config;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPago
{
  public function __construct()
  {
     $clientId = MercadoPago\SDK::setClientId(
          Config::get("payment-methods.mercadopago.client"));
     $clientSecret = MercadoPago\SDK::setClientSecret(
          Config::get("payment-methods.mercadopago.secret"));
  }

  // Construir solicitud de pago
  public function setupPaymentAndGetRedirectURL()
  {
    // Crea un objeto de preferencia
    $preference = new Preference();

    // Crea un ítem en la preferencia
    $item = new Item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 75.56;
    $preference->items = array($item);
    $preference->back_urls = [
      "success" => route('shopping_cart'),
      "pending" => route('shopping_cart'),
      "failure" => route('shopping_cart'),
    ];
    $preference->save();

    return $preference;
     # Create a preference object
     // $preference = new Preference();
     //
     //  # Create an item object
     //  $item = new Item();
     //  # order->id
     //  $item->id = 1;
     //  $item->title = "titulo del cobro";
     //  $item->quantity = 1;
     //  $item->currency_id = 'ARS';
     //  $item->unit_price = $amount;
     //  # $item->picture_url = $order->featured_img;
     //
     //  # Create a payer object
     //  $payer = new Payer();
     //  $payer->email = 'amparoserviciossociales@gmail.com';
     //
     //  # Setting preference properties
     //  $preference->items = [$item];
     //  $preference->payer = $payer;
     //
     //  # Save External Reference ORDER->ID
     //  $preference->external_reference = $request->shopping_cart->id;
     //  $messageSuccess = 'Gracias por tu compra! Nos pondremos en contacto para coordinar el envío.';
     //  $messageFailure = 'Hubo un problema para procesar el cobro.';
      // $preference->back_urls = [
      //   "success" => route('shopping_cart'),
      //   "pending" => route('shopping_cart'),
      //   "failure" => route('shopping_cart'),
      // ];
      //
      // $preference->auto_return = "all";
      // # $preference->notification_url = route('ipn');
      // # Save and POST preference
      // $preference->save();

      // if (config('payment-methods.use_sandbox')) {
      //   return $preference->sandbox_init_point;
      // }
      //
      // return $preference->init_point;
  }

}
