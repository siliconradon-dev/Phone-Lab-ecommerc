<?php

namespace App\Http\Controllers;

use App\Models\PosOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PosOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = PosOrder::with('customer')->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_code', 'like', '%' . $request->search . '%')
                    ->orWhereHas('customer', function ($sub) use ($request) {
                        $sub->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $posOrders = $query->paginate(10)->appends($request->query());

        return view('admin.pages.pos-orders.index', compact('posOrders'));
    }

    public function show($id)
    {
        $order = PosOrder::with(['customer', 'items.product', 'items.imeis', 'items.variant'])
            ->findOrFail($id);

        return view('admin.pages.pos-orders.show', compact('order'));
    }

    public function printInvoice($orderId)
{
    $order = PosOrder::with([
        'items.product',
        'items.imeis',
        'items.variant',
        'customer'
    ])->findOrFail($orderId);

    return view('admin.pages.pos.invoice', compact('order'));
}
}
