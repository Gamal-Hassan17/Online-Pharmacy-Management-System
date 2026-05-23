<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\order;

use App\Models\Stock;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\orderItem;

use Illuminate\Support\Facades\Auth;

class CustomerCart_con extends Controller
{
    // إضافة منتج للسلة
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "name"     => $product->name,
                "price"    => $product->price,
                "quantity" => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', $product->name . ' تم إضافته لعربة التسوق');
    }

    // عرض السلة
    public function show_cart()
    {
        return view('home.cart');
    }

    // إزالة منتج من السلة
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم إزالة المنتج من السلة');
    }

    public function checkout()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in before placing an order.');
    }

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Your cart is empty!');
    }

    request()->validate([
        'phone'   => 'required|string|min:6',
        'address' => 'required|string|min:6',
    ], [
        'phone.required'   => 'Phone number is required.',
        'phone.min'        => 'Phone number must be at least 6 characters.',
        'address.required' => 'Address is required.',
        'address.min'      => 'Address must be at least 6 characters.',
    ]);

    $phone   = request('phone');
    $address = request('address');

    $total = 0;

    foreach ($cart as $productId => $item) {
        $stock = Stock::where('product_id', $productId)->first();

        if ($stock) {
            if ($item['quantity'] > $stock->quantity) {
                return back()->with('error', "The requested quantity for ({$item['name']}) is not available. Only {$stock->quantity} left in stock.");
            }
        } else {
            return back()->with('error', "The product ({$item['name']}) is not available in stock.");
        }

        $total += $item['price'] * $item['quantity'];
    }

    $order = Order::create([
        'user_id'      => Auth::id(),
        'customer_id'  => Auth::id(),
        'total_amount' => $total,
        'status'       => 'pending',
    ]);

    foreach ($cart as $productId => $item) {
        OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $productId,
            'quantity'     => $item['quantity'],
            'price'        => $item['price'],
            'total_price'  => $item['price'] * $item['quantity'],
            'phone_number' => $phone,
            'address'      => $address,
        ]);

        $stock = Stock::where('product_id', $productId)->first();
        if ($stock) {
            $stock->quantity -= $item['quantity'];
            $stock->save();
        }
    }

    session()->forget('cart');

    return back()->with('success', '✅ Your order has been placed successfully! We will contact you soon.');
}

}
