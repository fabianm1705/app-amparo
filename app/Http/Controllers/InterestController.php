<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interest;
use App\UserInterest;

class InterestController extends Controller
{
  public function __construct()
  {
    $this->middleware('can:interests.index')->only('index');
    $this->middleware('can:interests.show')->only('show');
    $this->middleware('can:interests.destroy')->only('destroy');
    $this->middleware('can:interests.edit')->only(['edit','update']);
    $this->middleware('can:interests.create')->only(['create','store']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $interests = Interest::orderBy('id','asc')->get();
      return view('admin.interest.index',compact("interests"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.interest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $interest = new Interest();
      $interest->description = $request->input('description');
      $interest->activo = $request->input('activo');

      $interest->save();

      return redirect()
        ->route('interests.show',['interest' => $interest])
        ->with('message','Zona de Interés Registrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show(Interest $interest)
   {
     return view('admin.interest.show', compact("interest"));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit(Interest $interest)
   {
     return view('admin.interest.edit', compact("interest"));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, Interest $interest)
   {
     $interest->description = $request->input('description');
     $interest->activo = $request->input('activo');

     $interest->save();

     return redirect()
       ->route('interests.show',['interest' => $interest])
       ->with('message','Zona de Interés Actualizada');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Interest $interest)
   {
     $interest->delete();
     return redirect()->route('interests.index');
   }

   public function visor()
   {
     $user_interests = UserInterest::orderBy('id','desc')->get();
     return view('admin.interest.visor',compact("user_interests"));
   }

   public function borrar($id)
   {
     $user_interest = UserInterest::find($id);
     $user_interest->delete();
     return redirect()->route('interests.visor');
   }
}
