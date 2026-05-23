<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class Purchase_con extends Controller
{
    // ✅ عرض جميع المشتريات
    public function index_purchase()
    {
        $purchases = Purchase::with(['supplier', 'user'])->get();
        return view('purchase.index_purchase', compact('purchases'));
    }

    // ✅ نموذج إضافة فاتورة شراء
    public function create_purchase()
    {
        $suppliers = Supplier::all();
        $users = User::all();
        return view('purchase.create_purchase', compact('suppliers', 'users'));
    }

    // ✅ تخزين فاتورة شراء جديدة
    public function store_purchase(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id'     => 'required|exists:users,id',
        ]);

        $purchase = Purchase::create([
            'supplier_id'  => $validated['supplier_id'],
            'user_id'      => $validated['user_id'],
            'total_amount' => 0, // يبدأ بـ 0 لأن مفيش items لسه
        ]);

        return redirect()->route('create_purchase_item', $purchase->id)->with('success', 'Purchase created successfully!');
    }

    // ✅ عرض فاتورة شراء بالتفصيل
    public function show_purchase_item(Purchase $purchase)
    {

        $purchase->load(['supplier', 'user', 'purchaseItems']);
        return view('purchase.show_purchase', compact('purchase'));
    }

    // ✅ نموذج تعديل فاتورة شراء
    public function edit_purchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::all();
        $users = User::all();
        return view('purchase.edit_purchase', compact('purchase', 'suppliers', 'users'));
    }

    // ✅ تحديث فاتورة شراء
    public function update_purchase(Request $request, $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'user_id'     => 'required|exists:users,id',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->update([
            'supplier_id'  => $validated['supplier_id'],
            'user_id'      => $validated['user_id'],
        ]);

        return redirect()->route('index_purchase')->with('success', 'Purchase updated successfully!');
    }

    // ✅ حذف فاتورة شراء
    public function destroy_purchase($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('index_purchases')->with('success', 'Purchase deleted successfully!');
    }
    public function deleteTodayPurchases()
{
    $today = \Carbon\Carbon::today();

    \App\Models\Purchase::whereDate('created_at', $today)->delete();

    return redirect()->route('dashboard')->with('success', "Today's purchases deleted successfully.");
}

}
