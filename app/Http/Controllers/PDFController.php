<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Sale;
use App\Receipt;
use App\Concept;
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
          if($order->doctor->specialty->id === 19){
            $coseguro = "";
          }else{
            $coseguro = "Coseguro único a abonar en consultorio: $".$order->monto_s;
          }
          $view =  \View::make('admin.order.show', compact('order','coseguro'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
        }
        return $pdf->stream('orden-'.$order->id.'.pdf');
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
