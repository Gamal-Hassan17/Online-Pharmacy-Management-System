<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class home_con extends Controller
{

public function index()
{
     $products = Product::all();
     $categories = Category::where('is_active', 1)->get();

    return view('home.home', compact('categories'));
    // بيانات تجريبية للعروض
    $offers = [
        [
            'image' => asset('images/vitamins-offer.jpg'),
            'title' => '20% Off on Vitamins',
            'description' => 'Enjoy great discounts on essential vitamins and supplements.'
        ],
        [
            'image' => asset('images/free-delivery.jpg'),
            'title' => 'Free Delivery Over 150 EGP',
            'description' => 'Get free delivery across the city on orders above 150 EGP.'
        ],
        [
            'image' => asset('images/skin-care.jpg'),
            'title' => 'Skin Care Essentials',
            'description' => 'Buy 2 get 1 free on selected skin care products.'
        ],
    ];

    return view('home.home', compact('offers','products','categories'));
}

public function all_pro()
{
    $products = Product::with('stock')
        ->get()
        ->sortByDesc(function ($product) {
            return optional($product->stock)->quantity > 0;
        });

    return view('home.products', compact('products'));
}

public function show_cat($id)
{
    $categories = Category::where('is_active', 1)->get();
    $category = Category::findOrFail($id);   // 👈 نجيب القسم الحالي
    $products = Product::where('category_id', $id)->get();

    return view('home.show_cat', compact('products','categories','category'));
}

}
