<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Request;

class WebpayController extends Controller
{
    /**
     * Inicia la transacción en Webpay
     */
    public function iniciar(Request $request, $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        // Crear orden local
        $order = Order::create([
            'user_id'    => $user->id,
            'course_id'  => $course->id,
            'amount'     => $course->price ?? 0,
            'buy_order'  => uniqid('order_'),
            'session_id' => uniqid('session_'),
            'status'     => 'pendiente'
        ]);

        // 🔥 Aquí en el PASO 2 conectaremos Webpay REST
        return view('webpay.iniciar', compact('order', 'course'));
    }
}
