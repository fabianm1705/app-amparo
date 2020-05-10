<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SpecialtyController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:specialties.index')->only('index');
      $this->middleware('can:specialties.show')->only('show');
      $this->middleware('can:specialties.destroy')->only('destroy');
      $this->middleware('can:specialties.edit')->only(['edit','update']);
      $this->middleware('can:specialties.create')->only(['create','store']);
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

      $specialty->save();

      return redirect()
        ->route('specialties.show',['specialty' => $specialty])
        ->with('message','Especialidad Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
      return view('admin.specialty.show', compact("specialty"));
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

    public function getCoseguro($id)
    {
      $specialty = Specialty::find($id);

      // if($request->ajax()){
      //   return $specialties->toJson();
      // }
      return $specialty;
    }
}
