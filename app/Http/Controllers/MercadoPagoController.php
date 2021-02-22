<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Payer;
use Mail;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\PaymentMethod;

class MercadoPagoController extends Controller
{
  public function __construct()
  {
    $this->middleware('shopping_cart');
  }

  public function process_payment(Request $request)
  {
    SDK::setAccessToken("APP_USR-6083498452659149-012612-b3f312cb28965682cca230e1586e007b-540492876");
    // SDK::setAccessToken("TEST-8573893571173885-020408-508c7d9efbea13d65fc317d4d5129759-708342243");

    $payment = new Payment();
    $payment->transaction_amount = (float)$_POST['transactionAmount'];
    $payment->token = $_POST['token'];
    $payment->description = $_POST['description'];
    $payment->installments = (int)$_POST['installments'];
    $payment->payment_method_id = $_POST['paymentMethodId'];

    $payer = new Payer();
    $payer->email = $_POST['email'];
    $payer->identification = array(
        "type" => $_POST['docType'],
        "number" => $_POST['docNumber']
    );
    $payment->payer = $payer;

    $payment->save();

    $message = " ";
    $ruta = "home";
    switch($payment->status_detail){
      case 'accredited':
            registro_acceso(10,'Pago Acreditado');
            $request->shopping_cart->status = 1;
            $request->shopping_cart->user_id = Auth::user()->id;
            $request->shopping_cart->fecha = Carbon::now();
            $request->shopping_cart->payment_method_id = 2;
            $request->shopping_cart->operation_id = $payment->id;
            $request->shopping_cart->save();
            $shopping_cart_vendido = $request->shopping_cart;
            \Session::pull('shopping_cart_id', $shopping_cart_vendido->id);
            $message = "¡Listo! Se acreditó tu pago. En tu resumen verás el cargo de $".strval($payment->transaction_amount)." como ".$payment->statement_descriptor.".";
            Mail::send('admin.contacto.emailCompraFinalizada', array(
                    'name' => 'Probando',
                    'user_message' => 'Mensaje'
                 ), function($message){
                     $message->from('admin@amparosrl.com.ar');
                     $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
                    ->subject('Confirmaron una compra en el Shopping, pago por MercadoPago');
            });
            break;
      case 'pending_contingency':
            registro_acceso(10,'Pago en espera');
            $request->shopping_cart->status = 1;
            $request->shopping_cart->user_id = Auth::user()->id;
            $request->shopping_cart->fecha = Carbon::now();
            $request->shopping_cart->payment_method_id = 2;
            $request->shopping_cart->operation_id = $payment->id;
            $request->shopping_cart->save();
            $shopping_cart_vendido = $request->shopping_cart;
            \Session::pull('shopping_cart_id', $shopping_cart_vendido->id);
            $message = "Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó.";
            Mail::send('admin.contacto.emailCompraFinalizada', array(
                    'name' => 'Probando',
                    'user_message' => 'Mensaje'
                 ), function($message){
                     $message->from('admin@amparosrl.com.ar');
                     $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
                    ->subject('Confirmaron una compra en el Shopping, pago en proceso por MercadoPago');
            });
            break;
      case 'pending_review_manual':
            registro_acceso(10,'Pago en espera, revisión manual MP');
            $request->shopping_cart->status = 1;
            $request->shopping_cart->user_id = Auth::user()->id;
            $request->shopping_cart->fecha = Carbon::now();
            $request->shopping_cart->payment_method_id = 2;
            $request->shopping_cart->operation_id = $payment->id;
            $request->shopping_cart->save();
            $shopping_cart_vendido = $request->shopping_cart;
            \Session::pull('shopping_cart_id', $shopping_cart_vendido->id);
            $message = "Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó o si necesitamos más información.";
            Mail::send('admin.contacto.emailCompraFinalizada', array(
                    'name' => 'Probando',
                    'user_message' => 'Mensaje'
                 ), function($message){
                     $message->from('admin@amparosrl.com.ar');
                     $message->to('admin@amparosrl.com.ar', 'Admin. Amparo')
                    ->subject('Confirmaron una compra en el Shopping, pago en proceso por MercadoPago');
            });
            break;
      case 'cc_rejected_bad_filled_card_number':
            $message = "Revisa el número de tarjeta.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_bad_filled_date':
            $message = "Revisa la fecha de vencimiento de la tarjeta.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_bad_filled_other':
            $message = "No pudimos procesar el pago, revisa los datos.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_bad_filled_security_code':
            $message = "Revisa el código de seguridad de la tarjeta.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_blacklist':
            $message = "No pudimos procesar tu pago.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_call_for_authorize':
            $message = "Debes autorizar ante ".strtoupper($payment->payment_method_id)." el pago de $".strval($payment->transaction_amount);
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_card_disabled':
            $message = "Llama a ".strtoupper($payment->payment_method_id)." para activar tu tarjeta o usa otro medio de pago. El teléfono está al dorso de tu tarjeta.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_card_error':
            $message = "No pudimos procesar tu pago.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_duplicated_payment':
            $message = "Ya hiciste un pago por ese valor. Si necesitas volver a pagar usa otra tarjeta u otro medio de pago.";
            break;
      case 'cc_rejected_high_risk':
            $message = "Tu pago fue rechazado. Elige otro de los medios de pago, te recomendamos con medios en efectivo.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_insufficient_amount':
            $message = "Tu ".strtoupper($payment->payment_method_id)." no tiene fondos suficientes.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_invalid_installments':
            $message = strtoupper($payment->payment_method_id)." no procesa pagos en ".strval($payment->installments)." cuotas.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_max_attempts':
            $message = "Llegaste al límite de intentos permitidos. Elige otra tarjeta u otro medio de pago.";
            $ruta = "shopping_cart.cart";
            break;
      case 'cc_rejected_other_reason':
            $message = strtoupper($payment->payment_method_id)." no procesó el pago.";
            $ruta = "shopping_cart.cart";
            break;
    }
    return redirect()
      ->route($ruta)
      ->with('message',$message);
  }
}
