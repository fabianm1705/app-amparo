<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

}
