<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\User;

class SpecialtyController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:navegar especialidades')->only('index');
      $this->middleware('can:eliminar especialidades')->only('destroy');
      $this->middleware('can:editar especialidades')->only(['edit','update']);
      $this->middleware('can:crear especialidades')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $specialties = Specialty::orderBy('descripcion','asc')->get();

      if($request->ajax()){
        return $specialties->toJson();
      }

      return view('admin.specialty.index',compact("specialties"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.specialty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $specialty = new Specialty();
      $specialty->descripcion = $request->input('descripcion');
      $specialty->monto_s = $request->input('monto_s');
      $specialty->monto_a = $request->input('monto_a');
      $specialty->vigente = $request->input('vigente');
      $specialty->vigenteOrden = $request->input('vigenteOrden');
      $specialty->limitOrders = $request->input('limitOrders');
      $specialty->cantLimitOrders = $request->input('cantLimitOrders');

      $specialty->save();

      return redirect()
        ->route('specialties.show',['specialty' => $specialty])
        ->with('message','Especialidad Registrada');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
      return view('admin.specialty.edit', compact("specialty"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
      $specialty->descripcion = $request->input('descripcion');
      $specialty->monto_s = $request->input('monto_s');
      $specialty->monto_a = $request->input('monto_a');
      $specialty->vigente = $request->input('vigente');
      $specialty->vigenteOrden = $request->input('vigenteOrden');
      $specialty->limitOrders = $request->input('limitOrders');
      $specialty->cantLimitOrders = $request->input('cantLimitOrders');

      $specialty->save();

      return redirect()
        ->route('specialties.edit',['specialty' => $specialty])
        ->with('message','Especialidad Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
      $specialty->delete();
      return redirect()
        ->route('specialties.index');
    }

    public function cargarSpecialties($user)
    {
      foreach (Auth::user()->roles as $role){
        if(($role->slug=='dev') or ($role->slug=='admin')){
          if(necesita_odontologia($user) and necesita_salud($user)){
            $specialties = DB::table('specialties')->where('id', '=', 0)
                                                   ->orderBy('descripcion','asc')->get();
          }elseif(necesita_odontologia($user)==false and necesita_salud($user)){
            $specialties = DB::table('specialties')->where([['vigente', '=', 1],
                                                            ['id', '=', 19]])
                                                   ->orderBy('descripcion','asc')->get();
          }elseif(necesita_odontologia($user) and necesita_salud($user)==false){
            $specialties = DB::table('specialties')->where([['vigente', '=', 1],
                                                            ['id', '<>', 19]])
                                                   ->orderBy('descripcion','asc')->get();
          }else{
            $specialties = DB::table('specialties')->where([['vigente', '=', 1]])
                                                   ->orderBy('descripcion','asc')->get();
          }
        }else{
          if(necesita_odontologia($user) and necesita_salud($user)){
            $specialties = DB::table('specialties')->where('id', '=', 0)
                                                   ->orderBy('descripcion','asc')->get();
          }elseif(necesita_odontologia($user)==false and necesita_salud($user)){
            $specialties = DB::table('specialties')->where([['vigente', '=', 1],
                                                            ['vigenteOrden', '=', 1],
                                                            ['id', '=', 19]])
                                                   ->orderBy('descripcion','asc')->get();
          }elseif(necesita_odontologia($user) and necesita_salud($user)==false){
            $specialties = DB::table('specialties')->where([['vigente', '=', 1],
                                                            ['vigenteOrden', '=', 1],
                                                            ['id', '<>', 19]])
                                                   ->orderBy('descripcion','asc')->get();
          }else{
            $specialties = DB::table('specialties')->where([['vigente', '=', 1],
                                                            ['vigenteOrden', '=', 1]])
                                                   ->orderBy('descripcion','asc')->get();
          }
        }
      }
      return $specialties;
    }

    public function getDataUser(Request $request, $id)
    {
      $user = User::find($id);
      $dataSocio = collect([
        'carencia_salud' => carencia_salud($user),
        'carencia_odonto' => carencia_odontologia($user),
        'necesita_salud' => necesita_salud($user),
        'necesita_odonto' => necesita_odontologia($user),
        'cant_orders_salud' => cantOrdersSalud($user),
        'cant_orders_odonto' => cantOrdersOdonto($user),
        'specialties' => $this->cargarSpecialties($user)
      ]);
      return $dataSocio;
    }

    public function getCoseguro($id)
    {
      $specialty = Specialty::find($id);
      return $specialty;
    }
}
