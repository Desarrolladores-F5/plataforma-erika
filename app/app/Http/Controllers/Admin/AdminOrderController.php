<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'course'])

            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            ->when($request->q, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->whereHas('user', function ($u) use ($request) {
                        $u->where('name', 'like', "%{$request->q}%")
                        ->orWhere('email', 'like', "%{$request->q}%");
                    })
                    ->orWhereHas('course', function ($c) use ($request) {
                        $c->where('title', 'like', "%{$request->q}%");
                    });
                });
            })

            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pagado,pendiente,rechazado',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('toast', [
                'type' => 'success',
                'message' => 'Estado de la orden actualizado correctamente.'
            ]); 
    }
    
}
