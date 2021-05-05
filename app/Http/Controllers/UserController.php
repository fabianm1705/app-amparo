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
use Spatie\Permission\Models\Role;
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
    $this->middleware('can:navegar socios')->only('index');
    $this->middleware('can:eliminar socios')->only('destroy');
    $this->middleware('can:editar socios')->only(['edit','update']);
  }

  public function index()
  {
    $users = User::orderBy('name')->where('activo','=','1')->paginate();
    return view('admin.user.index',compact("users"));
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
    $user->activo = $request->input('activo');
    $user->carencia_salud = $request->input('carencia_salud');
    $user->carencia_odonto = $request->input('carencia_odonto');
    if($request->input('restablecerPassword')){
      $user->password = Hash::make('amparo');
      $user->password_changed_at = null;
    }
    $user->save();
    $group = Group::find($user->group_id);
    $group->direccion = $request->input('direccion');
    $group->save();

    $user->syncRoles($request->input('roles'));

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
    registro_acceso(12,'Odontología');
    $subscriptions = Subscription::where('odontologia',1)->get();

    $users = collect([]);
    foreach ($subscriptions->flatMap->users->where('activo',1)->where('no_aop',0)->sortBy('name') as $user) {
      if($user->group->activo==1){
        if($user->carencia_odonto==null or $user->carencia_odonto<Carbon::now()){
          $users->push($user);
        }
      }
    }
    return view('admin.user.odontologia',[
      'users' => $users,
      'usersCount' => $users->count()
    ]);
  }

  public function emergencia()
  {
    registro_acceso(12,'Emergencia');
    $subscriptions = Subscription::where('salud',1)->get();
    $users = collect([]);
    foreach ($subscriptions->flatMap->groups->where('activo',1) as $group) {
      foreach ($group->users->where('activo',1) as $user) {
        if($user->carencia_salud==null or $user->carencia_salud<Carbon::now()){
          $users->push($user);
        }
      }
    }
    foreach ($subscriptions->flatMap->users->where('activo',1) as $user) {
      if($user->group->activo==1){
        if($user->carencia_salud==null or $user->carencia_salud<Carbon::now()){
          $users->push($user);
        }
      }
    }
    return view('admin.user.emergencia',[
      'users' => $users->sortBy('name'),
      'usersCount' => $users->count()
    ]);
  }

  public function panel($id)
  {
    registro_acceso(14,'');
    $user = User::find($id);
    $usersId = User::where('group_id',$user->group_id)->pluck('id')->toArray();
    $layers = Layer::whereIn('user_id',$usersId)->where('activo',1)->get();
    $orders = Order::whereIn('pacient_id',$usersId)->orderBy('id', 'desc')->take(6)->get();
    $users = User::where('group_id',$user->group_id)->where('activo',1)->get();
    $plans = Plan::where('group_id',$user->group_id)->where('activo',1)->get();
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
    registro_acceso(13,'');
    $users = collect([]);
    if(Auth::user()->hasAnyRole('desarrollador', 'admin')){
      $users = User::where('id',Auth::user()->id)->get();
    }else{
      $group_id = Auth::user()->group_id;
      $users = User::where('group_id',$group_id)->where('activo',1)->get();
    }
    $usersCount = $users->count();
    $salud = necesita_salud(Auth::user());
    $odontologia = necesita_odontologia(Auth::user());
    return view('admin.planes',compact("usersCount","salud","odontologia"));
  }

  public function upload(Request $request)
  {
    $this->uploadFiles($request, [
      'fileGrupos',
      'fileSocios',
      'fileFacturas',
      'fileConceptos',
      'fileIPlanes',
      'filePlanes',
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

        if ($archivo=='fileGrupos') $this->updateGroups($lineas);
        if ($archivo=='fileSocios') $this->updateUsers($lineas);
        if ($archivo=='filePlanes') $this->updatePlans($lineas);
        if ($archivo=='fileIPlanes') $this->updateLayers($lineas);
        if ($archivo=='fileFacturas') $this->updateSales($lineas);
        if ($archivo=='fileConceptos') $this->updateConcepts($lineas);
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
          $sale = Sale::where('comprob_id', '=', intval(trim($datos[8])))
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
            $sale->obs = utf8_encode(trim($datos[9]));
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
          $plan = Plan::where('nombre', '=', utf8_encode(trim($datos[1])))->
                        where('group_id', '=', $group->id)->get()->first();
          // Si viene activo el plan
          if (intval(trim($datos[3]))==1) {
            // Si es nuevo
            if (is_null($plan)) {
              $plan = new Plan();
              $plan->group_id=$group->id;
            }
            // Si se modifica
            $plan->nombre = Str::title(utf8_encode(trim($datos[1])));
            $plan->monto = intval(trim($datos[2]));
            $plan->activo = intval(trim($datos[3]));
            $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[1])))
                          ->get()->first();
            if (isset($subscription)) {
              $plan->subscription_id=$subscription->id;
            }
            $plan->save();
            // Si viene para desactivar
          }elseif (isset($plan)) {
            $plan->delete();
          }
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
        $user = User::where('name', '=', utf8_encode(trim($datos[4])))->
                      where('nroAdh', '=', utf8_encode(trim($datos[1])))->get()->first();
        if (trim($datos[6])) {
          $user = User::where('nroDoc', '=', intval(trim($datos[6])))->
                        where('name', '=', utf8_encode(trim($datos[4])))->
                        where('nroAdh', '=', utf8_encode(trim($datos[1])))->get()->first();
        }
        if (isset($user)) {
          if($user->group->nroSocio==utf8_encode(trim($datos[0]))){
            $layer = Layer::where('nombre', '=', utf8_encode(trim($datos[2])))->
                          where('user_id', '=', $user->id)->get()->first();

            // Si viene activo el plan
            if (intval(trim($datos[5]))==1) {
              // Si es nuevo
              if (is_null($layer)) {
                $layer = new Layer();
                $layer->user_id=$user->id;
              }
              // Si se modifica
              $layer->nombre = Str::title(utf8_encode(trim($datos[2])));
              $layer->monto = intval(trim($datos[3]));
              $layer->activo = intval(trim($datos[5]));
              $subscription = Subscription::where('description', '=', utf8_encode(trim($datos[2])))
                            ->get()->first();
              if (isset($subscription)) {
                $layer->subscription_id=$subscription->id;
              }
              $layer->save();
              // Si viene para desactivar
            }elseif (isset($layer)) {
              $layer->delete();
            }
          }
        }
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
        if(intval(trim($datos[9]))==1){
          $group->activo=0;
        }else{
          $group->activo=1;
        }
        $group->save();
      }
    }
  }

  public function updateUsers($lineas)
  {
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
        if($datos[2]){
          $user->nroDoc = str_replace(".","",utf8_encode(trim($datos[2])));
        }else{
          $user->nroDoc = 1;
        }
        $user->tipoDoc=1;
        $time = strtotime($datos[3]);
        $user->fechaNac = date('Y-m-d',$time);
        $user->sexo=utf8_encode(trim($datos[4]));
        if(intval(trim($datos[6]))==1){
          $user->activo=0;
        }else{
          $user->activo=1;
        }

        $group = Group::where('nroSocio', '=', utf8_encode(trim($datos[5])))
                                  ->get()->first();
        if (isset($group)) {
          $user->group_id=$group->id;
        }

        $user->save();
        if(utf8_encode(trim($datos[5]))=='1232'){
          $user->assignRole('desarrollador');
        }elseif ((utf8_encode(trim($datos[5]))=='1231')) {
          $user->assignRole('admin');
        }else{
          $user->assignRole('socio');
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

  public function suscripcion()
  {
    $user = Auth::user();
    $user->save();
    return view('admin.suscripcion');
  }

  public function pagos()
  {
    $sales = Sale::where('group_id',Auth::user()->group_id)->orderBy('fechaEmision','desc')->take(4)->get();
    return view('admin.pagos',compact('sales'));
  }

  public function pagoConTarjeta(Request $request)
  {
    $total = $request->input('total');
    return view('admin.pagoConTarjeta',compact('total'));
  }

}
