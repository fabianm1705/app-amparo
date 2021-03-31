<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'puntoContable', 'nroFactura', 'total', 'cae', 'fechaCae', 'fechaEmision',
      'fechaPago', 'group_id','comprob_id',
  ];

  public function group()
  {
    return $this->belongsTo('App\Models\Group');
  }

  public function concepts()
  {
    return $this->hasMany('App\Concept');
  }
}
