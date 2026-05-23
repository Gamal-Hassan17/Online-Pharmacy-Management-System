<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class sale_item_con extends Controller
{
    // عرض كل عناصر البيع الخاصة ببيع واحد
    public function show_sale_items($sale_id)
    {
        $sale = Sale::with(['customer', 'user', 'saleItems.product'])->findOrFail($sale_id);
        return view('sale.show_sale_item', compact('sale'));
    }

    // عرض نموذج إضافة عنصر بيع
    public function create_sale_item($sale_id)
    {
        $sale = Sale::findOrFail($sale_id);
        $products = Product::all();
        return view('sale_item.create_sale_item', compact('sale', 'products'));
    }

    // تخزين عنصر بيع جديد
    public function store_sale_item(Request $request, $sale_id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $total_price = $validated['quantity'] * $validated['unit_price'];

        SaleItem::create([
            'sale_id' => $sale_id,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'unit_price' => $validated['unit_price'],
            'total_price' => $total_price,
        ]);

        // تحديث إجمالي البيع في جدول sales
        $sale = Sale::findOrFail($sale_id);
        $sale->total_amount = $sale->saleItems()->sum('total_price');
        $sale->save();

        return redirect()->route('show_sale_items', $sale_id)->with('success', 'Sale item added successfully!');
    }

    // حذف عنصر بيع
    public function destroy_sale_item($id)
    {
        $saleItem = SaleItem::findOrFail($id);
        $sale_id = $saleItem->sale_id;

        $saleItem->delete();

        // تحديث إجمالي البيع في جدول sales
        $sale = Sale::findOrFail($sale_id);
        $sale->total_amount = $sale->saleItems()->sum('total_price');
        $sale->save();

        return redirect()->route('show_sale_items', $sale_id)->with('success', 'Sale item deleted successfully!');
    }
    public function deleteTodayOrders()
{
    Sale::whereDate('created_at', today())->delete();
    return back()->with('success', 'All today\'s orders have been deleted!');
}
}
