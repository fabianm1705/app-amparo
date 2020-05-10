<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
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
