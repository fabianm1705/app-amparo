<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'monto', 'concepto',
  ];

  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

}
