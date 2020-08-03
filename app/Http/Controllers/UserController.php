<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group;
use App\Models\Plan;
use App\Models\Layer;
use App\Models\Order;
use App\Models\Sale;
use App\Concept;
use App\UserInterest;
use App\Subscription;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Str;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:sos.emergencias')->only('emergencia');
    $this->middleware('can:aop')->only('odontologia');
    $this->middleware('can:users.index')->only('index');
    $this->middleware('can:users.show')->only('show');
    $this->middleware('can:users.destroy')->only('destroy');
    $this->middleware('can:users.edit')->only(['edit','update']);
    $this->middleware('can:users.upload')->only('upload');
  }

  public function index()
  {
    // Ver sólo los dev o admin
    // $usuarios = User::orderBy('name')->where('activo','=',1)->get();
    // $users = collect([]);
    // foreach ($usuarios as $user) {
    //   foreach ($user->roles as $role){
    //     if(($role->slug=='dev') or ($role->slug=='admin')){
    //       $users->push($user);
    //     }
    //   }
    // }

    $users = User::orderBy('name')->where('activo','=',1)->paginate();
    return view('admin.user.index',compact("users"));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    $roles = Role::get();
    return view('admin.user.show', compact("user","roles"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $roles = Role::get();
    return view('admin.user.edit', compact("user","roles"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    $user->name = $request->input('name');
    $user->nroDoc = $request->input('nroDoc');
    $user->fechaNac = $request->input('fechaNac');
    $user->email = $request->input('email');
    $user->no_aop = $request->input('no_aop');
    if($request->input('restablecerPassword')){
      $user->password = Hash::make('amparo');
      $user->password_changed_at = null;
    }
    $user->save();

    $user->roles()->sync($request->input('roles'));

    return redirect()
      ->route('users.edit',['user' => $user])
      ->with('message','Socio Actualizado');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();

    return redirect()
      ->route('users.index');
  }

  public function getUsers(Request $request)
  {
    $users = User::orderBy('name','desc')
        ->name($request->input('name'))
        ->nroDoc($request->input('nroDoc'))
        ->paginate();

    if($request->input('desdeDonde')=="Usuarios"){
      return view('admin.user.index', compact("users"));
    }else{
      return view('admin.order.search', compact("users"));
    }
  }

  public function editPassword()
  {
    return view('auth.passwords.change');
  }

  public function change(ChangePasswordRequest $request)
  {
    $user = Auth::user();
    $password = Hash::make($request->input('password'));
    $user->password = $password;
    $user->password_changed_at = Carbon::now();
    $user->save();

    return redirect()
      ->route('home')
      ->with('message','Contraseña Modificada!');
  }

  public function restablecerPassword(Request $request, User $user)
  {
    $year = 0;
    $month = 0;
    $day = 0;
    $tz = 'Europe/Madrid';
    $user->password = Hash::make('amparo');
    $user->password_changed_at = null;
    $user->save();

    return redirect()
      ->route('users')
      ->with('message','Contraseña Restablecida!');
  }

  public function odontologia()
  {
    $this->registroAcceso(12,'Odontología');
    $subscriptions = Subscription::where('odontologia',1)->get();
    $users = $subscriptions->flatMap->users->where('no_aop',0)->sortBy('name');
    $usersCount = $subscriptions->flatMap->users->where('no_aop',0)->count();
    return view('admin.user.odontologia',[
      'users' => $users,
      'usersCount' => $usersCount
    ]);
  }

  public function emergencia()
  {
    $this->registroAcceso(12,'Emergencia');
    $subscriptions = Subscription::where('salud',1)->get();
    $groups = $subscriptions->flatMap->groups->sortBy('nroSocio');
    $uusers = $subscriptions->flatMap->users->sortBy('name');
    $users = collect([]);
    $usersCount = 0;
    foreach ($subscriptions->flatMap->groups as $group) {
      $usersCount = $usersCount + $group->users->count();
      foreach ($group->users as $user) {
        $users->push($user);
      }
    }
    foreach ($subscriptions->flatMap->users as $user) {
      $usersCount = $usersCount + 1;
      $users->push($user);
    }
    return view('admin.user.emergencia',[
      'users' => $users->sortBy('name'),
      'usersCount' => $usersCount
    ]);
  }

  public function necesitaSalud($user)
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

  public function necesitaOdontologia($user)
  {
    $odontologia = true;
    foreach ($user->subscriptions as $subscription) {
      if($subscription->odontologia==1){
        $odontologia = false;
      }
    }
    return $odontologia;
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

  public function panel($id)
  {
    $this->registroAcceso(14,'');
    $user = User::find($id);
    $usersId = User::where('group_id',$user->group_id)->pluck('id')->toArray();
    $layers = Layer::whereIn('user_id',$usersId)->get();
    $orders = Order::whereIn('pacient_id',$usersId)->orderBy('id', 'desc')->take(6)->get();
    $users = User::where('group_id',$user->group_id)->get();
    $plans = Plan::where('group_id',$user->group_id)->get();
    $sales = Sale::where('group_id',$user->group_id)->orderBy('fechaEmision','desc')->take(4)->get();
    $group = Group::find($user->group_id);
    return view('admin.user.panel',[
      'users' => $users,
      'plans' => $plans,
      'layers' => $layers,
      'orders' => $orders,
      'sales' => $sales,
      'group' => $group
    ]);
  }

  public function planes()
  {
    foreach (Auth::user()->roles as $role){
      if(($role->slug=='dev') or ($role->slug=='admin')){
        $users = User::where('id',Auth::user()->id)->get();
      }else{
        UserInterest::create(['user_id' => Auth::user()->id,'interest_id' => 13]);
        $group_id = Auth::user()->group_id;
        $users = User::where('group_id',$group_id)->get();
      }
    }
    $usersCount = $users->count();
    return view('admin.planes',compact("usersCount"));
  }

  public function upload(Request $request)
  {
    $this->uploadFiles($request, [
      'fileFacturas',
      'fileConceptos',
      'fileGrupos',
      'fileIPlanes',
      'filePlanes',
      'fileSocios',
    ]);

    return redirect()->route('home')->with('message','Padrón Actualizado');
  }

  public function uploadFiles($request, array $archivos)
  {
    foreach ($archivos as $archivo) {
      if($request->hasFile($archivo)){
        $file=$request->file($archivo);
        $name=$file->getClientOriginalName();
        $path = $request->file($archivo)->storeAs('public',$name);
        $lineas = file(storage_path().'/app/'.$path);

        if($archivo=='fileGrupos'){
          $this->updateGroups($lineas);
        }elseif ($archivo=='fileSocios') {
          $this->updateUsers($lineas);
        }elseif ($archivo=='filePlanes') {
          $this->truncateTable('plans');
          $this->updatePlans($lineas);
        }elseif ($archivo=='fileIPlanes') {
          $this->truncateTable('layers');
          $this->updateLayers($lineas);
        }elseif ($archivo=='fileFacturas') {
          $this->updateSales($lineas);
        }elseif ($archivo=='fileConceptos') {
          $this->updateConcepts($lineas);
        }
      }
    }
  }

  public function updateSales($lineas)
  {
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[4])))
                                  ->get()->first();
        if(isset($group)){
          $sale = Sale::where([['puntoContable', '=', intval(trim($datos[7]))],
                               ['nroFactura', '=', intval(trim($datos[0]))],])
                        ->get()->first();
          if (is_null($sale)) {
            $sale = new Sale();
            $sale->puntoContable = intval(trim($datos[7]));
            $sale->nroFactura = intval(trim($datos[0]));
            $sale->group_id=$group->id;
            $sale->total = intval(trim($datos[1]));
            $sale->cae = utf8_encode(trim($datos[5]));
            $time = strtotime($datos[6]);
            $sale->fechaCae = date('Y-m-d',$time);
            $time = strtotime($datos[2]);
            $sale->fechaEmision = date('Y-m-d',$time);
            $sale->comprob_id = utf8_encode(trim($datos[8]));
          }
          if($datos[3]<>""){
            $time = strtotime($datos[3]);
            $sale->fechaPago = date('Y-m-d',$time);
          }
          $sale->save();
        }
      }
    }
  }

  public function updateConcepts($lineas)
  {
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $sale = Sale::where('comprob_id', '=', intval(trim($datos[0])))->get()->first();
        if(isset($sale)){
          $concept = new Concept();
          $concept->sale_id=$sale->id;
          $concept->monto = intval(trim($datos[1]));
          $concept->descripcion = utf8_encode(trim($datos[2]));
          $concept->obs = ' ';
          $concept->save();
        }
      }
    }
  }

  public function updatePlans($lineas)
  {
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[0])))
                                  ->get()->first();
        if(isset($group)){
          $plan = new Plan();
          $plan->group_id=$group->id;
          $plan->nombre = Str::title(utf8_encode(trim($datos[1])));
          $plan->monto = intval(trim($datos[2]));
          $plan->emiteOrden = intval(trim($datos[3]));

          $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[1])))
                        ->get()->first();
          if (isset($subscription)) {
            $plan->subscription_id=$subscription->id;
          }

          $plan->save();
        }
      }
    }
  }

  public function updateLayers($lineas)
  {
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $layer = new Layer();
        $layer->nombre = Str::title(utf8_encode(trim($datos[2])));
        $layer->monto = intval(trim($datos[3]));
        $layer->emiteOrden = intval(trim($datos[5]));

        $user = User::where('name', '=', utf8_encode(trim($datos[4])))
                      ->get()->first();
        if (isset($user)) {
          if($user->group->nroSocio==utf8_encode(trim($datos[0]))){
            $layer->user_id=$user->id;
          }
        }

        $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[2])))
                      ->get()->first();
        if (isset($subscription)) {
          $layer->subscription_id=$subscription->id;
        }

        $layer->save();
      }
    }
  }

  public function updateGroups($lineas)
  {
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[0])))
                                  ->get()->first();
        if (is_null($group)) {
          $group = new Group();
          $group->nroSocio = utf8_encode(trim($datos[0]));
        }
        $group->fechaAlta = utf8_encode(trim($datos[1]));
        $group->email=utf8_encode(trim($datos[2]));
        $group->telefono=utf8_encode(trim($datos[3]));
        $group->direccion = Str::title(utf8_encode(trim($datos[4])));
        $group->direccionCobro = Str::title(utf8_encode(trim($datos[5])));
        $group->diaCobro = Str::lower(utf8_encode(trim($datos[6])));
        $group->horaCobro = Str::lower(utf8_encode(trim($datos[7])));
        $group->total = intval(trim($datos[8]));
        $group->activo=intval(trim($datos[9]));
        $group->save();
      }
    }
  }

  public function updateUsers($lineas)
  {
    $confRoleAdmin = array(["role_id" => "1"]);
    $confRoleSocio = array(["role_id" => "2"]);
    $confRoleDev = array(["role_id" => "3"]);
    $confPerSocio = array(["0" => "10","1" => "27","2" => "33","3" => "34",
                  "4" => "38","5" => "39"]);
    foreach ($lineas as $linea)
    {
      $datos = explode("|", $linea);
      if($datos<>""){
        $user = User::where('name', '=', Str::title(utf8_encode(trim($datos[1]))))
                                  ->get()->first();
        if (is_null($user)) {
          $user = new User();
          $user->password = Hash::make('amparo');
          $user->no_aop=0;
        }
        $user->nroAdh = utf8_encode(trim($datos[0]));
        $user->name = Str::title(utf8_encode(trim($datos[1])));
        $user->nroDoc = str_replace(".","",utf8_encode(trim($datos[2])));
        $user->tipoDoc=1;
        $time = strtotime($datos[3]);
        $user->fechaNac = date('Y-m-d',$time);
        $user->sexo=utf8_encode(trim($datos[4]));
        $user->vigenteOrden=intval(trim($datos[5]));
        $user->activo=intval(trim($datos[6]));

        $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[7])))
                                  ->get()->first();
        if (isset($group)) {
          $user->group_id=$group->id;
        }

        $user->save();
        if((utf8_encode(trim($datos[7]))=='1232') or (utf8_encode(trim($datos[7]))=='1231')){
          $user->roles()->sync($confRoleDev);
        }else{
          $user->roles()->sync($confRoleSocio);
        }
      }
    }
  }

  public function truncateTable($table)
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table($table)->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }

  public function darkMode()
  {
    $user = Auth::user();
    if($user->darkMode){
      $user->darkMode = false;
    }else{
      $user->darkMode = true;
    }
    $user->darkMode_verified_at = Carbon::now();
    $user->save();
    return redirect()->back();
  }

}
