<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Order_con extends Controller
{
     public function index() {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->get();
        return view('orders.index_order', compact('orders'));
    }
     public function store(Request $request)
    {

        // تحقق من وجود منتجات في السلة
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'السلة فارغة، لا يمكن إنشاء الطلب.');
        }

        // احسب إجمالي السعر
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => Auth::id(), // العميل الحالي
            'total_amount' => $total,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // حفظ العناصر المرتبطة بالطلب
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        // تفريغ السلة من الـ session
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'تم إنشاء الطلب بنجاح!');
    }
    public function show_order($id)
{
    $order = Order::with('orderItems.product')->findOrFail($id);
    return view('orders.show_order', compact('order'));
}
public function approve($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'approved';
    $order->save();

    return back()->with('success', 'Order approved successfully.');
}

public function ship($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'shipped';
    $order->save();

    return back()->with('success', 'Order marked as shipped.');
}


    public function destroy($id) {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }

public function myOrders()
{
    $userId = Auth::id();
    $orders = Order::with(['orderItems.product']) // جلب المنتجات المرتبطة
                   ->where('user_id', $userId)
                   ->latest()
                   ->get();

    return view('orders.my_orders', compact('orders'));
}







}
