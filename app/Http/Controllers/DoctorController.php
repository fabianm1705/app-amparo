<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:navegar profesionales')->only('index');
      $this->middleware('can:eliminar profesionales')->only('destroy');
      $this->middleware('can:editar profesionales')->only(['edit','update']);
      $this->middleware('can:crear profesionales')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $specialties = Specialty::orderBy('descripcion','asc')->get();
      $doctors = Doctor::orderBy('specialty_id','asc')->orderBy('apeynom','asc')->get();

      return view('admin.doctor.index',compact("doctors","specialties"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $specialties = Specialty::orderBy('descripcion','asc')->get();
      return view('admin.doctor.create', compact("specialties"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorFormRequest $request)
    {
      $doctor = new Doctor();
      $doctor->apeynom = $request->input('apeynom');
      $doctor->direccion = $request->input('direccion');
      $doctor->email = $request->input('email');
      $doctor->telefono = $request->input('telefono');
      $doctor->vigente = $request->input('vigente');
      $doctor->ordenWeb = $request->input('ordenWeb');
      $doctor->coseguroConsultorio = $request->input('coseguroConsultorio');
      $doctor->specialty_id = $request->input('specialty_id');

      $doctor->save();

      return redirect()
        ->route('doctors.show',['doctor' => $doctor])
        ->with('message','Profesional Registrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
      $specialties = Specialty::orderBy('descripcion','asc')->get();
      return view('admin.doctor.edit', compact("doctor","specialties"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorFormRequest $request, Doctor $doctor)
    {
      $doctor->apeynom = $request->input('apeynom');
      $doctor->direccion = $request->input('direccion');
      $doctor->email = $request->input('email');
      $doctor->telefono = $request->input('telefono');
      $doctor->vigente = $request->input('vigente');
      $doctor->ordenWeb = $request->input('ordenWeb');
      $doctor->coseguroConsultorio = $request->input('coseguroConsultorio');
      $doctor->specialty_id = $request->input('specialty_id');

      $doctor->save();

      return redirect()
        ->route('doctors.index')
        ->with('message','Datos del Profesional Actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
      $doctor->delete();
      return redirect()->route('doctors.index');
    }

    public function mostrar(Request $request)
    {
      registro_acceso(4,'');
      $specialties = Cache::remember('specialties', now()->addMonths(1), function () {
           return Specialty::orderBy('descripcion','asc')
                                ->where('vigente','=',1)
                                ->get();
       });
      return view('admin.doctor.mostrar', compact("specialties"));
    }

    public function getDoctors($id)
    {
      $doctors = DB::table('doctors')->where([['specialty_id', '=', $id],
                                              ['vigente', '=', 1],
                                              ['ordenWeb', '=', 1]])->get();
      return $doctors;
    }

    public function getProfesionales($id)
    {
      $doctors = DB::table('doctors')->where([['specialty_id', '=', $id],
                                              ['vigente', '=', 1]])->get();
      return $doctors;
    }
}
