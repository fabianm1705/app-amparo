<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\UserInterest;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }

    public function getPlans($idGroup)
    {
      $plans = DB::table('plans')->where('group_id', '=', $idGroup)->get();
      return $plans;
    }

    public function activarPlan()
    {
      $this->registroAcceso(11,'Plan Salud Grupal');
      Plan::create([
                    'nombre' => 'AMPARO SALUD PLUS',
                    'monto' => 900,
                    'group_id' => Auth::user()->group_id,
                    'subscription_id' => 5
                  ]);
      return redirect()
        ->route('home')->with('message','Plan habilitado! Ya puedes emitir órdenes médicas de consulta.');
    }

    public function registroAcceso($interest_id,$obs)
    {
      foreach (Auth::user()->roles as $role){
        if(($role->slug<>'dev') and ($role->slug<>'admin')){
          UserInterest::create(['user_id' => Auth::user()->id,
                                'interest_id' => $interest_id,
                                'obs' => $obs]);
        }
      }
    }
}
