<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'activo', 'image_url', 'percentage', 'cant_cuotas',
  ];

  public function products()
  {
    return $this->hasMany('App\Models\Product','payment_method_id');
  }

  public function payment_method_items()
  {
    return $this->hasMany('App\PaymentMethodItem','payment_method_id');
  }

}
