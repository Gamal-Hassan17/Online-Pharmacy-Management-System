<?php

namespace App\Http\Controllers;
use App\Models\Sale;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
{
    $sales = Sale::with('user')->latest()->paginate(10);
    return view('list of sale', compact('sales'));
}
public function show(Sale $sale)
{
    $sale->load(['user', 'saleItems.product']);
    return view('show sale item', compact('sale'));
}



}
