<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
  public $table = 'contact_us';
  public $fillable = ['name','email','telephone','address','message'];
}
