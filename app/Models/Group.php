<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nroSocio', 'fechaAlta', 'email', 'telefono', 'direccion',
      'direccionCobro', 'diaCobro', 'horaCobro', 'total', 'activo',
  ];

  public function users()
  {
    return $this->hasMany('App\User','group_id');
  }

  public function subscriptions()
  {
    return $this->belongsToMany('App\Subscription','plans');
  }

  public function plans()
  {
    return $this->hasMany('App\Models\Plan','group_id');
  }

  public function sales()
  {
    return $this->hasMany('App\Models\Sale','group_id');
  }

  public function scopeDireccion($query, $direccion)
  {
    if($direccion)
        return $query->where('direccion','LIKE',"%$direccion%");
  }
}
