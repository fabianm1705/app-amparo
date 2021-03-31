<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Doctor;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:navegar ordenes')->only(['index','indice']);
      $this->middleware('can:eliminar ordenes')->only('destroy');
      $this->middleware('can:editar ordenes')->only(['edit','update']);
      $this->middleware('can:crear ordenes')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $doctors = Doctor::where('vigente',1)->orderBy('specialty_id','asc')->orderBy('apeynom','asc')->get();
      $orders = Order::orderBy('id', 'desc')->paginate();
      return view('admin.order.index',compact("orders","doctors"));
    }

    public function indice()
    {
      $group_id = Auth::user()->group_id;
      //Tomar los Id de todos los usuarios del grupo
      $usersId = User::where('group_id',$group_id)->where('activo',1)->pluck('id')->toArray();
      //Para buscar las órdenes de todos
      $orders = Order::whereIn('pacient_id',$usersId)->orderBy('id', 'desc')->paginate();
      return view('admin.order.indice',compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      registro_acceso(3,'');
      $emiteOficina = true;
      foreach (Auth::user()->roles as $role){
        if(($role->name=='desarrollador') or ($role->name=='admin')){
          $users = User::where('id', $request->input('id'))->get();
        }else{
          $emiteOficina = false;
          $group_id = Auth::user()->group_id;
          $users = User::where('group_id',$group_id)->where('activo',1)->get();
        }
      }
      $usersCount = $users->count();
      $specialties = DB::table('specialties')->where('id', '=', 0)->get();
      $doctors = DB::table('doctors')->where('id', '=', 0)->get();

      return view('admin.order.create',compact(
        "users",
        "usersCount",
        "specialties",
        "doctors",
        "emiteOficina"
      ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user=User::find($request->input('user_id'));
      $cantOrders=0;
      if($request->input('doctor_id')==44){
        $cantOrders=cantOrdersOdonto($user);
      }
      if($cantOrders>1){
        return redirect()
          ->route('home')
          ->with('message','Ya ha emitido 2 órdenes odontológicas en el mes, por dudas consultanos a la oficina');
      }else{
        $order = new Order();
        $order->fecha = Carbon::now();
        $order->fechaImpresion = Carbon::now();
        if($request->input('monto_s')){
          $order->monto_s = $request->input('monto_s');
          $order->monto_a = $request->input('monto_a');
        }else{
          $order->monto_s = 0;
          $order->monto_a = 0;
        }
        $order->obs = $request->input('obs');
        $order->estado = 'Impresa';
        $order->pacient_id = $request->input('user_id');
        $order->doctor_id = $request->input('doctor_id');
        foreach (Auth::user()->roles as $role){
          if(($role->name=='desarrollador') or ($role->name=='admin')){
            $order->lugarEmision = 'Sede Amparo';
          }else{
            $order->lugarEmision = 'Autogestión';
          }
        }

        $order->save();

        return redirect()
          ->route('pdf',['id' => $order->id])
          ->with('message','Orden Registrada');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
      return view('admin.order.edit', compact("order"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
      $order->fecha = $request->input('fecha');
      $order->fechaImpresion = $request->input('fechaImpresion');
      $order->monto_s = $request->input('monto_s');
      $order->monto_a = $request->input('monto_a');
      $order->obs = $request->input('obs');
      $order->estado = $request->input('estado');
      $order->lugarEmision = $request->input('lugarEmision');
      $order->pacient_id = $request->input('user_id');
      $order->doctor_id = $request->input('doctor_id');

      $order->save();

      return redirect()
        ->route('orders.edit',['order' => $order])
        ->with('message','Orden Modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
      $order->delete();
      return redirect()
        ->route('orders.index');
    }

    public function search(Request $request)
    {
      $users = User::where('group_id',-1)->paginate();
      return view('admin.order.search',compact("users"));
    }

    public function getOrdenes($id)
    {
      $orders = Order::where('doctor_id', '=', $id)->get();
      foreach($orders as $order){
          $order->numeroSocio = $order->user->group->nroSocio;
          $order->nombreDoctor = $order->doctor->apeynom;
      }
      return $orders;
    }

    public function pay($id)
    {
      $order = Order::find($id);
      $order->estado = "Pagada";
      $order->fechaPago = Carbon::now();
      $order->save();

      return redirect()
        ->route('orders.index');
    }
}
