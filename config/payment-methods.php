<?php

return [

  'enabled' => [
      'mercadopago',
  ],

    'use_sandbox' => env('SANDBOX_GATEWAYS', true),

    'mercadopago' => [
        'logo' => '/images/mp.png',
        'display' => 'MercadoPago',
        'client' => env('MP_CLIENT'),
        'secret' => env('MP_SECRET'),
    ],

];
