<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group;
use App\Models\Plan;
use App\Models\Layer;
use App\Models\Order;
use App\Models\Sale;
use App\UserInterest;
use App\Subscription;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Str;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

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
    $users = $subscriptions->flatMap->users->sortBy('name');
    $usersCount = $subscriptions->flatMap->users->count();
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

  public function checkSocio($id)
  {
    $user = User::find($id);
    $cantOrders = DB::table('orders')
                   ->select(DB::raw('count(*) as order_count'))
                   ->where('pacient_id', '=', $id)
                   ->whereMonth('fecha','=',now()->month)
                   ->whereYear('fecha','=',now()->year)
                   ->get();
    foreach ($cantOrders as $order) {
      $order_count = $order->order_count;
    }
    $dataSocio = collect([
      'salud' => $this->necesitaSalud($user),
      'odontologia' => $this->necesitaOdontologia($user),
      'cant_orders' => $order_count
    ]);
    return $dataSocio;
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
    $sales = Sale::where('group_id',$user->group_id)->orderBy('id','desc')->get();
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
    return view('planes',compact("usersCount"));
  }

  public function upload(Request $request)
  {
    dd($request->hasFile('fileToUpload'));
    if($request->hasFile('fileToUpload')){
      $file=$request->file('fileToUpload');
      $file->move(public_path().'/app-amparo/storage/app/public',$file->getClientOriginalName());
    }

    // $user->name = $request->input('name');
    //
    // $target_dir = "/home/fabianm/public_html/app-amparo/storage/app/public/";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    // $target_file3 = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
    // $target_file4 = $target_dir . basename($_FILES["fileToUpload4"]["name"]);
    // $target_file5 = $target_dir . basename($_FILES["fileToUpload5"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
    // $imageFileType3 = strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));
    // $imageFileType4 = strtolower(pathinfo($target_file4,PATHINFO_EXTENSION));
    // $imageFileType5 = strtolower(pathinfo($target_file5,PATHINFO_EXTENSION));
    // // Allow certain file formats
    // if($imageFileType != "txt" || $imageFileType2 != "txt" || $imageFileType3 != "txt" || $imageFileType4 != "txt" || $imageFileType5 != "txt") {
    //     echo "Lo siento, solo archivos TXT son permitidos.";
    //     $uploadOk = 0;
    // }
    // // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //     echo "Lo siento, sus archivos no fueron subidos.";
    // // if everything is ok, try to upload file
    // } else {
    //     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)
    //         && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)
    //         && move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file3)
    //         && move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"], $target_file4)
    //         && move_uploaded_file($_FILES["fileToUpload5"]["tmp_name"], $target_file5)) {
    //         echo "Los archivos han sido subidos!<br><br>";
    //
    //         require_once './utilidades/factura.php';
    //         $factura = new Factura();
    //         $factura->vaciar();
    //         $lineas = file('facturasweb.txt');
    //         $j=0;
    //         $h=0;
    //         foreach ($lineas as $linea_num => $linea)
    //         {
    //             $datos = explode("|", $linea);
    //             $factura->nrocomp = intval(trim($datos[0]));
    //             $factura->total = intval(trim($datos[1]));
    //             $time = strtotime($datos[2]);
    //             $factura->f_emis = date('Y-m-d',$time);
    //             if (empty($datos[3])){
    //               $time = strtotime("0000-00-00");
    //               $factura->f_pago = date('Y-m-d',$time);
    //             }else{
    //               $time = strtotime($datos[3]);
    //               $factura->f_pago = date('Y-m-d',$time);
    //               // if ($datos[4]=="491"){
    //               //   echo "pasa por cargado: ".$datos[3].", f_pago: ".$factura->f_pago;
    //               // }
    //             }
    //             $factura->nrosocio = intval(trim($datos[4]));
    //             if ($factura->facturaExiste(intval(trim($datos[0])),intval(trim($datos[4])))>0){
    //               $factura->update();
    //               $h++;
    //             }else{
    //               $factura->create();
    //                $j++;
    //             }
    //         }
    //         echo "ACTUALIZACION BD <br><br>";
    //         echo "Facturas Nuevas: ".$j." Actualizadas: ".$h."<br>";
    //         fclose($file);
    //
    //         require_once './utilidades/Sepelio.php';
    //         $sepelio = new Sepelio();
    //         $sepelio->vaciar();
    //         $j=0;
    //         $lineas = file('sepelio.txt');
    //         foreach ($lineas as $linea_num => $linea)
    //         {
    //           $datos = explode("|", $linea);
    //           $sepelio->nrosocio = intval(trim($datos[0]));
    //           $sepelio->apeynom = utf8_encode(trim($datos[1]));
    //           $time = strtotime($datos[2]);
    //           $sepelio->fechaalta = date('Y-m-d',$time);
    //           $time = strtotime($datos[3]);
    //           $sepelio->fechames = date('Y-m-d',$time);
    //           $sepelio->domicilio = utf8_encode(trim($datos[4]));
    //           $sepelio->telefono = utf8_encode(trim($datos[5]));
    //           $j++;
    //           $sepelio->create();
    //         }
    //         echo "Sepelio: ".$j." socios<br>";
    //         fclose($file);
    //
    //         require_once './utilidades/plan.php';
    //         $plan = new Plan();
    //         $plan->vaciar();
    //         $lineas = file('planesweb.txt');
    //         $j=0;
    //         $h=0;
    //         foreach ($lineas as $linea_num => $linea)
    //         {
    //             $datos = explode("|", $linea);
    //             $plan->nrosocio = intval(trim($datos[0]));
    //             $plan->nroadh = intval(trim($datos[1]));
    //             $plan->codplan = intval(trim($datos[2]));
    //             $plan->descripcion = utf8_encode(trim($datos[3]));
    //             $plan->monto = intval(trim($datos[4]));
    //             $plan->vigente = "S";
    //             if ($plan->planExiste(intval(trim($datos[0])),intval(trim($datos[1])),intval(trim($datos[2])))>0){
    //               $plan->update();
    //               $h++;
    //             }else{
    //               $plan->create();
    //               $j++;
    //             }
    //         }
    //         echo "Planes Nuevos: ".$j." Actualizados: ".$h."<br>";
    //         fclose($file);
    //
    //         require_once './utilidades/Socio.php';
    //         $socio = new Socio();
    //         $lineas = file('sociosweb.txt');
    //         $j=0;
    //         $h=0;
    //         foreach ($lineas as $linea_num => $linea)
    //         {
    //           $datos = explode("|", $linea);
    //           $socio->numerosocio = intval(trim($datos[0]));
    //           $socio->numeroadherente = intval(trim($datos[1]));
    //           $socio->direccionsocio = utf8_encode(trim($datos[2]));
    //           $socio->diacobro = utf8_encode(trim($datos[3]));
    //           $socio->descripcionsocio = utf8_encode(trim($datos[4]));
    //           $socio->horacobro = utf8_encode(trim($datos[5]));
    //           $socio->numerodocumento = utf8_encode(trim($datos[6]));
    //           $socio->tipodocumento=1;
    //           $time = strtotime($datos[7]);
    //           $socio->fechaalta = date('Y-m-d',$time);
    //           $time2 = strtotime($datos[8]);
    //           $socio->fechanacimiento = date('Y-m-d',$time2);
    //           $socio->direccioncobro = utf8_encode(trim($datos[9]));
    //           $socio->sexo='2';
    //           $socio->tiposocio=0;
    //           $socio->telefonosocio = utf8_encode(trim($datos[10]));
    //           $socio->vigenteordenweb=utf8_encode(trim($datos[11]));
    //           $socio->vigente=utf8_encode(trim($datos[12]));
    //           $socio->total=intval(trim($datos[13]));
    //           if ($socio->socioExiste(intval(trim($datos[0])),intval(trim($datos[1])))>0){
    //             $socio->update();
    //             $h++;
    //           }else{
    //              $socio->create();
    //              $j++;
    //           }
    //
    //         }
    //         echo "Socios Nuevos: ".$j." Actualizados: ".$h."<br>";
    //         fclose($file);
    //
    //     } else {
    //         echo "Lo siento, hubo un error subiendo los archivos.";
    //     }
    // }
    //
    // return redirect()->route('home')->with('message','Padrón Actualizado');
  }

}
