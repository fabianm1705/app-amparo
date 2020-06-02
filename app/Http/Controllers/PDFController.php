<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Sale;
use App\Receipt;
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

    public function recibo($id,$num_en_letras)
      {
        $receipt = Receipt::find($id);
        $view =  \View::make('admin.receipt.show', compact('receipt','num_en_letras'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo');
      }

    public function factura($id)
      {
        $sale = Sale::find($id);
        $view =  \View::make('admin.sale.show', compact('sale'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('factura');
      }

}
