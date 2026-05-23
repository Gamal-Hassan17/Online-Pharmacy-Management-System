<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\Product;

use Illuminate\Http\Request;

class Stock_con extends Controller
{

    // عرض كل المخزون
    public function show_stock()
    {
        $stocks = Stock::with('product')->get();
        return view('stock.show_stocks', compact('stocks'));
    }

    // فورم إضافة جديد
    public function create_stock()
    {
        $products = Product::all();
        return view('stock.create_stocks', compact('products'));
    }

    // تخزين في قاعدة البيانات
    public function store_stock(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        Stock::create($validated);

        return redirect()->route('show_stock')->with('success', 'Stock added successfully!');
    }

    // فورم التعديل
   public function edit_stock($id)
{
    $stock = Stock::findOrFail($id);
    $products = Product::all();

    return view('stock.edit_stocks', compact('stock', 'products'));
}

    // التحديث في قاعدة البيانات
    public function update_stock(Request $request, $id)
{
    $stock = Stock::findOrFail($id);

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:0',
    ]);

    $stock->update([
        'product_id' => $request->product_id,
        'quantity'   => $request->quantity,
    ]);

    return redirect()->route('show_stock')->with('success', 'Stock updated successfully!');
}



    // حذف
    public function destroy_stock( $id)
    {
        $stock = stock::findOrFail($id);


        $stock->delete();
        return redirect()->route('show_stock')->with('success', 'Stock deleted successfully!');
    }
}


