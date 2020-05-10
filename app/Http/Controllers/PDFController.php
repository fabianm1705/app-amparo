<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use PDF;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function invoice($id)
      {
        $orden = $this->getData($id);
        foreach ($orden as $order)
        {

          $view =  \View::make('admin.order.show', compact('order'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
        }
        return $pdf->stream('invoice');
      }

    public function getData($id)
      {
        $order = Order::where('id',$id)->get();
        return $order;
      }

}
