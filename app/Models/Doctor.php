<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'apeynom', 'direccion', 'email', 'telefono', 'vigente', 'coseguroConsultorio', 'specialty_id',
  ];

  public function specialty()
  {
    return $this->belongsTo('App\Models\Specialty');
  }

  public function orders()
  {
    return $this->hasMany('App\Models\Order','doctor_id');
  }

}
