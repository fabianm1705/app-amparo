<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'descripcion', 'monto', 'sale_id', 'obs',
  ];

  public function sale()
  {
    return $this->belongsTo('App\Models\Sale');
  }
}
