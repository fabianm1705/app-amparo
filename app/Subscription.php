<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $fillable = [
      'description', 'grupal', 'sepelio_estandar','sepelio_plus','salud',
      'odontologia','orden_medica',
  ];

  public function users()
  {
    return $this->belongsToMany('App\User','layers', 'subscription_id', 'user_id');
  }

  public function groups()
  {
    return $this->belongsToMany('App\Models\Group','plans', 'subscription_id', 'group_id');
  }
}
