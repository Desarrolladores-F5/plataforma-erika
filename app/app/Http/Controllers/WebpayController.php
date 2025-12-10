<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Course;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;

class WebpayController extends Controller
{
    public function iniciar(Request $request, string $slug)
     {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user   = auth()->user();

        // 1) Crear orden local
        $order = Order::create([
            'user_id'    => $user->id,
            'course_id'  => $course->id,
            'amount'     => intval($course->price ?? 0),
            'buy_order'  => uniqid('order_'),
            'session_id' => uniqid('session_'),
            'status'     => 'pendiente',
        ]);

        // 2) Crear OPTIONS correctos para SDK 5.1
        $options = new Options(
            apiKey: config('webpay.api_key'),
            commerceCode: config('webpay.commerce_code'),
            integrationType: Options::ENVIRONMENT_INTEGRATION
        );

        // 3) Instanciar transacción
        $transaction = new Transaction($options);

        // 4) Webpay 5.x → create($buyOrder, $sessionId, $amount, $returnUrl)
        $response = $transaction->create(
            $order->buy_order,
            $order->session_id,
            intval($order->amount),
            route('webpay.retorno')
        );

        // 5) Guardar token
        $order->update([
            'token' => $response->getToken(),
        ]);

        // 6) Redirigir al formulario Webpay
        return redirect($response->getUrl() . '?token_ws=' . $response->getToken());
    }
        
}
