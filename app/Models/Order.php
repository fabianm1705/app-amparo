<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'fecha', 'fechaImpresion', 'monto_s', 'monto_a',
    'obs', 'estado', 'lugarEmision', 'pacient_id', 'doctor_id', 'fechaPago',
  ];

  protected $casts = [
    'fecha' => 'date:Y-m-d',
    'fechaImpresion' => 'date:Y-m-d',
  ];

  public function user()
  {
    return $this->belongsTo('App\User','pacient_id');
  }

  public function doctor()
  {
    return $this->belongsTo('App\Models\Doctor','doctor_id');
  }

}
