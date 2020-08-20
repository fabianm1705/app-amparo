<?php

use App\UserInterest;

function necesita_salud($user)
{
  $salud = true;
  foreach ($user->subscriptions as $subscription) {
    if($subscription->salud==1){
      $salud = false;
    }
  }
  foreach ($user->group->subscriptions as $subscription) {
    if($subscription->salud==1){
      $salud = false;
    }
  }
  return $salud;
}

function necesita_odontologia($user)
{
  $odontologia = true;
  foreach ($user->subscriptions as $subscription) {
    if($subscription->odontologia==1){
      $odontologia = false;
    }
  }
  return $odontologia;
}

function carencia_odontologia($user)
{
  $carencia_odonto = false;
  if(necesita_odontologia($user)){
    $carencia_odonto = false;
  }elseif($user->carencia_odonto > now()->toDateString()){
    $carencia_odonto = $user->carencia_odonto;
  }else{
    $carencia_odonto = false;
  }
  return $carencia_odonto;
}

function carencia_salud($user)
{
  $carencia_salud = false;
  if(necesita_salud($user)){
    $carencia_salud = false;
  }elseif($user->carencia_salud > now()->toDateString()){
    $carencia_salud = $user->carencia_salud;
  }else{
    $carencia_salud = false;
  }
  return $carencia_salud;
}

function registro_acceso($interest_id,$obs)
{
  foreach (Auth::user()->roles as $role){
    if(($role->slug<>'dev') and ($role->slug<>'admin')){
      UserInterest::create(['user_id' => Auth::user()->id,
                            'interest_id' => $interest_id,
                            'obs' => $obs]);
    }
  }
}
