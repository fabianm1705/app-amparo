<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Specialty;
use App\Models\Doctor;
use App\User;
use App\UserInterest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
      $this->middleware('can:orders.index')->only('index');
      $this->middleware('can:orders.show')->only('show');
      $this->middleware('can:orders.destroy')->only('destroy');
      $this->middleware('can:orders.edit')->only(['edit','update']);
      $this->middleware('can:orders.create')->only(['create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::orderBy('id', 'desc')->take(60)->paginate();
      return view('admin.order.index',compact("orders"));
    }

    public function indice()
    {
      $group_id = Auth::user()->group_id;
      //Tomar los Id de todos los usuarios del grupo
      $usersId = User::where('group_id',$group_id)->pluck('id')->toArray();
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
      $specialties = DB::table('specialties')
                            ->where([
                                        ['vigente', '=', 1],
                                    ])
                            ->orderBy('descripcion','asc')
                            ->get();
      $users = User::where('id',$request->input('id'))->get();
      return view('admin.order.create',compact("users","specialties"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $order = new Order();
      $order->fecha = Carbon::now();
      $order->fechaImpresion = Carbon::now();
      $order->monto_s = $request->input('monto_s');
      $order->monto_a = $request->input('monto_a');
      $order->obs = $request->input('obs');;
      $order->estado = 'Impresa';
      $order->pacient_id = $request->input('pacient_id');
      $order->doctor_id = $request->input('doctor_id');
      foreach (Auth::user()->roles as $role){
        if(($role->slug=='dev') or ($role->slug=='admin')){
          $order->lugarEmision = 'Sede Amparo';
        }else{
          $order->lugarEmision = 'Autogestión Web';
        }
      }

      $order->save();

      return redirect()
        ->route('pdf',['id' => $order->id])
        ->with('message','Orden Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      return view('admin.order.show', compact("order"));
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
      $order->pacient_id = $request->input('pacient_id');
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

    public function crear(Request $request)
    {
      $emiteOficina = true;
      foreach (Auth::user()->roles as $role){
        if(($role->slug=='dev') or ($role->slug=='admin')){
          $users = User::where('id',$request->input('id'))->get();
          $specialties = DB::table('specialties')
                                ->where('vigente', '=', 1)
                                ->orderBy('descripcion','asc')
                                ->get();
        }else{
          UserInterest::create(['user_id' => Auth::user()->id,'interest_id' => 3]);
          $emiteOficina = false;
          $group_id = Auth::user()->group_id;
          $users = User::where('group_id',$group_id)->get();
          $specialties = DB::table('specialties')
                                ->where([['vigenteOrden', '=', 1],['vigente', '=', 1],])
                                ->orderBy('descripcion','asc')
                                ->get();
        }
      }

      $usersCount = $users->count();
      $doctors = DB::table('doctors')->where('id', '=', 0)->get();

      return view('admin.order.crear',compact(
        "users",
        "specialties",
        "usersCount",
        "doctors",
        "emiteOficina"
      ));
    }

    public function search(Request $request)
    {
      $users = User::where('group_id',-1)->paginate();
      return view('admin.order.search',compact("users"));
    }

    public function cantOrders($id)
    {
      $cantOrders = DB::table('orders')
                     ->select(DB::raw('count(*) as order_count'))
                     ->where('pacient_id', '=', $id)
                     ->whereMonth('fecha','=',now()->month)
                     ->whereYear('fecha','=',now()->year)
                     ->get();
      return $cantOrders->pluck('order_count');
    }
}
