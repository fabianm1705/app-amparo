<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'user_interest';

  protected $fillable = [
      'user_id', 'interest_id','obs'
  ];

  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

  public function interest()
  {
    return $this->belongsTo('App\Interest','interest_id');
  }
}
