<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
  public $table = "profits";
  
  protected $fillable = [
      'description', 'percentage',
  ];

}
