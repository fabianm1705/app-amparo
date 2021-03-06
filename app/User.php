<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nroDoc','nroAdh','tipoDoc','sexo',
        'fechaNac','activo','vigenteOrden','group_id', 'password_changed_at',
        'darkMode','carencia_salud','carencia_odonto',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'darkMode_verified_at',
    ];

    protected $dates = [
        'carencia_odonto','carencia_salud',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setCarenciaSaludAttribute($date)
    {
        $this->attributes['carencia_salud'] = empty($date) ? null : Carbon::parse($date);
    }

    public function setCarenciaOdontoAttribute($date)
    {
        $this->attributes['carencia_odonto'] = empty($date) ? null : Carbon::parse($date);
    }

    public function group()
    {
      return $this->belongsTo('App\Models\Group');
    }

    public function orders()
    {
      return $this->hasMany('App\Models\Order','pacient_id');
    }

    public function subscriptions()
    {
      return $this->belongsToMany('App\Subscription','layers', 'user_id', 'subscription_id');
    }

    public function shopping_carts()
    {
      return $this->hasMany('App\Models\ShoppingCart','user_id');
    }

    public function scopeName($query, $name)
    {
      if($name)
          return $query->where('name','LIKE',"%$name%");
    }

    public function scopeNroDoc($query, $nroDoc)
    {
      if($nroDoc)
          return $query->where('nroDoc','LIKE',"%$nroDoc%");
    }
}
