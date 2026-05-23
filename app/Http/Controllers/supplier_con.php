<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class supplier_con extends Controller
{

    public function show_sup(){
        $show_suppliers = Supplier::all();
        return view('suppliers.show_suppliers',compact('show_suppliers'));
    }
    public function create_sup(){
        return view('suppliers.create_suppliers');
    }
    public function store_sup(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:suppliers,email',
        'phone' => 'required|digits:11',
        'address' => 'required',
    ]);
    Supplier::create($validated);


    //  return redirect()->back()->with('success', 'User Created Successfully!');
    return to_route('show_supplier');

}
public function edit_sup($id) {
    $supplier = Supplier::findOrFail($id);
    return view('suppliers.edit_supplier', ['supplier' => $supplier]);
}


public function update_sup(Request $request, $id)
{

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|digits:11',
        'address' => 'required',
    ]);

    // ✅ 2. جلب المورد من قاعدة البيانات
    $supplier = Supplier::findOrFail($id);

    // ✅ 3. تحديث البيانات
    $supplier->update($validated);

    // ✅ 4. Redirect مع رسالة نجاح
    return redirect()->route('show_supplier')->with('success', 'Supplier updated successfully!');
}

public function delete_sup($id) {
    $supplier = Supplier::findOrFail($id);
    $supplier->delete();

    return redirect()->route('show_supplier')->with('success', 'Supplier delete successfully!');
}
}
