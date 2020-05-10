<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre', 'monto', 'user_id', 'subscription_id',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function subscription()
  {
    return $this->belongsTo('App\Subscription');
  }

}
