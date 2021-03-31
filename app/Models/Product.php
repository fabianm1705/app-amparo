<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'modelo', 'descripcion', 'montoCuota', 'cantidadCuotas', 'vigente',
      'image_url', 'category_id', 'costo','image_url2','image_url3',
  ];

  public function category()
  {
    return $this->belongsTo('App\Models\Category');
  }

  public function payment_method()
  {
    return $this->belongsTo('App\Models\PaymentMethod');
  }

  public function precio($costo,$porce,$cantCuotas)
  {
    return round($costo * (1+($porce/100)) / $cantCuotas / 10) * 10;
  }

}
