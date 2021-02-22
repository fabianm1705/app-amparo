<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodItem extends Model
{
  protected $fillable = [
      'name', 'payment_method_id','cuotas','activo','percentage'
  ];

  public function payment_method()
  {
    return $this->belongsTo('App\Models\PaymentMethod');
  }

}
