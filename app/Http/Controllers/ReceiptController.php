<?php

namespace App\Http\Controllers;

use App\Receipt;
use App\User;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $receipts = Receipt::orderBy('id','desc')->get();
      return view('admin.receipt.index',compact("receipts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $user = User::find($id);
      return view('admin.receipt.create',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $receipt = new Receipt();
      $receipt->monto = $request->input('monto');
      $receipt->concepto = $request->input('concepto');
      $users = User::where('nroDoc',$request->input('nroDoc'))->get();
      foreach ($users as $user){
        $receipt->user_id = $user->id;
      }

      $receipt->save();

      return redirect()
        ->route('receipts.show',['id' => $receipt->id])
        ->with('message','Recibo Registrado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
      $receipt->delete();
      return redirect()
        ->route('receipts.index');
    }
}
