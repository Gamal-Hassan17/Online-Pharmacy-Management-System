<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class Sale_con extends Controller
{

    // عرض جميع المبيعات
    public function index_sale()
    {
        $sales = Sale::with(['customer', 'user'])->get();
        return view('sale.index_sales', compact('sales'));
    }

    // نموذج إضافة فاتورة بيع
    public function create_sale()
    {
        $customers = Customer::all();
        $users = User::all();
        return view('sale.create_sale', compact('customers', 'users'));
    }

    // تخزين البيع الجديد
    public function store_sale(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'customer_id' => 'nullable|exists:customers,id',
        'customer_name' => 'nullable|string|max:255',
    ]);

    if ($validated['customer_id']) {
        $customer_id = $validated['customer_id'];
    } elseif ($validated['customer_name']) {
        $newCustomer = Customer::create([
            'name' => $validated['customer_name'],
        ]);
        $customer_id = $newCustomer->id;
    } else {
        return back()->withErrors(['customer_id' => 'يرجى اختيار عميل أو كتابة اسم جديد.'])->withInput();
    }

    $sale = Sale::create([
        'customer_id' => $customer_id,
        'user_id' => $validated['user_id'],
        'total_amount' => 0,
    ]);

    return redirect()->route('index_sales')->with('success', 'تم إنشاء عملية البيع!');
}


    public function show_sale(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleItems']);
        return view('sale.show_sale_item', compact('sale'));
    }

    // تعديل
    public function edit_sale($id)
    {
        $sale = Sale::findOrFail($id);
        $customers = Customer::all();
        $users = User::all();
        return view('sale.edit_sale', compact('sale', 'customers', 'users'));
    }

    // تحديث
    public function update_sale(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update([
            'customer_id' => $validated['customer_id'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('index_sales')->with('success', 'Sale updated successfully!');
    }
     public function destroy_sale($id)
{
    $sale = Sale::findOrFail($id);

    $sale->saleItems()->delete();

    $sale->delete();

    return redirect()->route('index_sales')->with('success', '✅ تم حذف الفاتورة بنجاح!');
}



    public function index(Request $request)
{
    $category_id = $request->category;
    $search = $request->search;


    $categories = Category::where('is_active', 1)
                    ->orderBy('name', 'asc')
                    ->get();

    $products = Product::with('stock')
    ->when($category_id, function($q) use ($category_id){
        $q->where('category_id', $category_id);
    })
    ->when($search, function($q) use ($search){
        $q->where('name', 'like', "%$search%");
    })
    ->latest()
    ->get()
    ->sortByDesc(function ($product) {
        return optional($product->stock)->quantity > 0;
    });

    return view('cashier.index', compact('products','categories'));
}
}

