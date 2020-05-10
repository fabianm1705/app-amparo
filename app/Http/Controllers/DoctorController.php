<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\UserInterest;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorFormRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:doctors.index')->only('index');
      $this->middleware('can:doctors.show')->only('show');
      $this->middleware('can:doctors.destroy')->only('destroy');
      $this->middleware('can:doctors.edit')->only(['edit','update']);
      $this->middleware('can:doctors.create')->only(['create','store']);
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
      $doctor->coseguroConsultorio = $request->input('coseguroConsultorio');
      $doctor->specialty_id = $request->input('specialty_id');

      $doctor->save();

      return redirect()
        ->route('doctors.show',['doctor' => $doctor])
        ->with('message','Profesional Registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
      $specialties = Specialty::orderBy('descripcion','asc')->get();
      return view('admin.doctor.show', compact("doctor","specialties"));
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
      $doctor->coseguroConsultorio = $request->input('coseguroConsultorio');
      $doctor->specialty_id = $request->input('specialty_id');

      $doctor->save();

      return redirect()
        ->route('doctors.edit',['doctor' => $doctor])
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
      $this->registroAcceso(3,'');
      $specialties = Cache::remember('specialties', now()->addMonths(1), function () {
           return Specialty::orderBy('descripcion','asc')
                                ->where('vigente','=',1)
                                ->get();
       });
      return view('admin.doctor.mostrar', compact("specialties"));
    }

    public function getDoctors($id)
    {
      $doctors = DB::table('doctors')->where('specialty_id', '=', $id)->get();
      return $doctors;
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
