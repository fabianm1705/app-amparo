<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'descripcion', 'monto_s', 'monto_a', 'vigente', 'vigenteOrden',
  ];

  public function doctors()
  {
    return $this->hasMany('App\Models\Doctor','specialty_id');
  }

}
