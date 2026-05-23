<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\supplier;
use App\Models\Category;
use App\Models\stock;

use Illuminate\Http\Request;

class product_con extends Controller
{
    public function index(Request $request)
{

    $search = $request->input('search');

    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%");
    })->get();

    return view('home.products', compact('products'));
}

    public function show_product(){

        $show_products = Product::with('supplier','stock')->get();
        return view('products.show_product',compact('show_products'));
    }
    public function create_product(){
        $suppliers = Supplier::all();
        $categorys = Category::all();

        return view('products.create_product',compact('suppliers','categorys'));
    }
    public function store_product(Request $request)
{


    $validated = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'price' => 'required|numeric',
    'cost_price' => 'nullable|numeric',
    'barcode' => 'nullable|string',
    'expiry_date' => 'nullable|date',
    'supplier_id' => 'nullable|exists:suppliers,id',
    'category_id' => 'required|exists:categories,id',
]);

Product::create($validated);
    return redirect()->route('show_product')->with('success', 'Medicine added successfully!');
}
public function edit_product($id)
{
    $product = Product::findOrFail($id);
    $suppliers = Supplier::all();
    $categorys = Category::all();
    return view('products.edit_product', compact('product', 'suppliers', 'categorys'));
}

public function update_product(Request $request, $id)
{
     $validated = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'price' => 'required|numeric',
    'cost_price' => 'nullable|numeric',
    'barcode' => 'nullable|string',
    'expiry_date' => 'nullable|date',
    'supplier_id' => 'nullable|exists:suppliers,id',
    'category_id' => 'required|exists:categories,id',
]);

    $product = Product::findOrFail($id);
    $product->update($validated);

    return redirect()->route('show_product')->with('success', 'Medicine updated successfully!');
}
public function delete_product($id) {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('show_product')->with('success', 'product delete successfully!');
}


}
