<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\stock;

use App\Models\PurchaseItem;
use Illuminate\Http\Request;

class Purchase_item_con extends Controller
{

    public function show_purchase_items($purchase_id)
    {
         $purchase = Purchase::with(['supplier', 'user', 'purchaseItems.product'])
                            ->findOrFail($purchase_id);
        $total = $purchase->purchaseItems->sum(function ($item) {
    return $item->quantity * $item->unit_cost;
});



        return view('purchase.show_purchase_item', compact('purchase','purchase', 'total'));
    }

    public function create_purchase_item($purchase_id)
{
$purchases = Purchase::findOrFail($purchase_id);
    $products = Product::all();

    return view('purchase_item.create_purchase_item', compact('purchases', 'products'));
}


  public function store_purchase_item(Request $request, $purchase_id)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'unit_cost' => 'required|numeric|min:0',
    ]);

    $product = Product::findOrFail($validated['product_id']);

    $total_cost = $validated['quantity'] * $validated['unit_cost'];

    PurchaseItem::create([
        'purchase_id' => $purchase_id,
        'product_id' => $product->id,
        'quantity' => $validated['quantity'],
        'unit_cost' => $validated['unit_cost'],
        'total_cost' => $total_cost,
    ]);

    $stock = Stock::firstOrCreate(
        ['product_id' => $product->id],
        ['quantity' => 0]
    );

    $stock->quantity += $validated['quantity'];
    $stock->save();

    if ($product->price != $validated['unit_cost']) {
        $product->price = $validated['unit_cost'];
        $product->save();
    }

    $purchase = Purchase::findOrFail($purchase_id);
    $purchase->total_amount = $purchase->purchaseItems()->sum('total_cost');
    $purchase->save();

    return redirect()
        ->route('show_purchase_items', $purchase_id)
        ->with('success', 'Purchase item added successfully!');
}




    public function destroy_purchase_item($id)
    {
        $purchaseItem = PurchaseItem::findOrFail($id);
        $purchase_id = $purchaseItem->purchase_id;

        $purchaseItem->delete();

        $purchase = Purchase::findOrFail($purchase_id);
        $purchase->total_amount = $purchase->purchaseItems()->sum('total_cost');
        $purchase->save();

        return redirect()->route('show_purchase_items', $purchase_id)
                         ->with('success', 'Purchase item deleted successfully!');
    }
}
