<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:profits.index')->only('index');
    $this->middleware('can:profits.show')->only('show');
    $this->middleware('can:profits.destroy')->only('destroy');
    $this->middleware('can:profits.edit')->only(['edit','update']);
    $this->middleware('can:profits.create')->only(['create','store']);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
       $profits = Profit::orderBy('description','asc')->get();

       if($request->ajax()){
         return $profits->toJson();
       }

       return view('admin.profit.index',compact("profits"));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.profit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $profit = new Profit();
       $profit->description = $request->input('description');
       $profit->percentage = $request->input('percentage');

       $profit->save();

       return redirect()
         ->route('profits.show',['profit' => $profit])
         ->with('message','Porcentaje Registrado');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function show(Profit $profit)
    {
      return view('admin.profit.show', compact("profit"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function edit(Profit $profit)
    {
      return view('admin.profit.edit', compact("profit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profit $profit)
    {
      $profit->description = $request->input('description');
      $profit->percentage = $request->input('percentage');

      $profit->save();

      return redirect()
        ->route('profits.show',['profit' => $profit])
        ->with('message','Porcentaje Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profit  $profit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profit $profit)
    {
      $profit->delete();
      return redirect()
        ->route('profits.index');
    }
}
