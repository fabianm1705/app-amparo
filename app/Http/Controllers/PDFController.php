<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Concept;
use App\Receipt;
use PDF;
use App\NumerosEnLetras;

class PDFController extends Controller
{
    public function orden($id)
      {
        $coseguro = "";
        $order = Order::where('id',$id)->get()->first();
        if($order->doctor->specialty->id === 19){
          $coseguro = "";
        }else{
          $coseguro = "Coseguro único a abonar en consultorio: $".$order->monto_s;
        }
        $view =  \View::make('admin.order.show', compact('order','coseguro'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('orden-'.$order->id.'.pdf');
      }

    public function recibo($id)
      {
        $receipt = Receipt::find($id);
        $num_en_letras=NumerosEnLetras::convertir($receipt->monto,'Pesos',false,'Centavos');
        $view =  \View::make('admin.receipt.show', compact('receipt','num_en_letras'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('recibo-'.$id.'.pdf');
      }

    public function factura($id)
      {
        $sale = Sale::find($id);
        $concepts = Concept::where('sale_id', '=', $sale->id)->get();
        $view =  \View::make('admin.sale.show', compact('sale','concepts'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('factura-'.$sale->id.'.pdf');
      }

}
