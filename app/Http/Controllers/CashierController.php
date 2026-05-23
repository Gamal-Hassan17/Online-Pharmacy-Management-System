<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
{
    $products = Product::with('stock')
        ->get()
        ->sortByDesc(function ($product) {
            return optional($product->stock)->quantity > 0;
        });
    return view('index', compact('products'));
}

}
