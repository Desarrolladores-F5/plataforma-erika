<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Course;
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function retorno(Request $request)
    {
        $token = $request->input('token_ws');

        if (!$token) {
            return redirect()->route('home')->with('error', 'Token no recibido desde Webpay.');
        }

        // 1) Buscar la orden asociada al token
        $order = Order::where('token', $token)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Orden no encontrada.');
        }

        // 2) Preparar OPTIONS igual que antes
        $options = new Options(
            apiKey: config('webpay.api_key'),
            commerceCode: config('webpay.commerce_code'),
            integrationType: Options::ENVIRONMENT_INTEGRATION
        );

        // 3) Confirmar transacción
        $transaction = new Transaction($options);

        $response = $transaction->commit($token);

        // 4) Registrar estado
        $order->status = $response->isApproved() ? 'pagado' : 'rechazado';
        $order->save();

        // 5) Si fue aprobado → asociar curso al usuario
        if ($response->isApproved()) {
            $user = $order->user;
            $user->courses()->attach($order->course_id);
        }

        // 6) Mostrar voucher
        return view('webpay.voucher', [
            'order'    => $order,
            'response' => $response,
        ]);
    }

    public function show(Order $order)
    {
        // Seguridad: solo el dueño
        abort_if($order->user_id !== auth()->id(), 403);

        // 🚫 Si NO está pagado → no se intenta commit
        if ($order->status !== 'pagado') {
            return view('orders.pending', compact('order'));
        }

        return view('webpay.voucher', compact('order'));
    }    

    public function pdf(Order $order)
    {
        // 🔒 Seguridad: solo dueño o admin
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $pdf = Pdf::loadView('orders.pdf', compact('order'));

        return $pdf->download('comprobante-'.$order->buy_order.'.pdf');
    }
        
}
