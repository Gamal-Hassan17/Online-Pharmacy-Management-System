<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\stock;
use App\Models\Sale;
use App\Models\SaleItem;


class CartController extends Controller
{
    public function add(Request $request)
    {
        // تحقق من المدخلات
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // لو المنتج موجود زود الكمية
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // لو مش موجود أضفه جديد
            $cart[$product->id] = [
                "name"     => $product->name,
                "price"    => $product->price,
                "quantity" => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', $product->name . ' added to cart!');
    }
   public function checkout(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', '⚠️ Your cart is empty!');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $sale = Sale::create([
        'total_amount' => $total,
        'user_id'      => auth()->id() ?? null,
    ]);

    foreach ($cart as $productId => $item) {
        $stock = Stock::where('product_id', $productId)->first();
        if ($stock) {
            if ($item['quantity'] > $stock->quantity) {
                return back()->with('error', "The requested quantity for ({$item['name']}) is not available. Only {$stock->quantity} left in stock.");
            }

            // ✅ Update stock
            $stock->quantity -= $item['quantity'];
            $stock->save();
        } else {
            return back()->with('error', "Product ({$item['name']}) is not available in stock.");
        }

        SaleItem::create([
            'sale_id'     => $sale->id,
            'product_id'  => $productId,
            'quantity'    => $item['quantity'],
            'unit_price'  => $item['price'],
            'total_price' => $item['price'] * $item['quantity'],
        ]);
    }

    session()->forget('cart');

    return back()->with('success', '✅ Sale completed successfully!');
}


public function remove(Request $request)
{
    $productId = $request->input('product_id');

    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Product removed from cart.');
}

public function show_cart(){
    return view('home.cart');
}




}
