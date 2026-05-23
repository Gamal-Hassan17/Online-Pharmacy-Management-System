<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user_con;
use App\Http\Controllers\stock_con;
use App\Http\Controllers\product_con;
use App\Http\Controllers\purchase_con;
use App\Http\Controllers\purchase_item_con;
use App\Http\Controllers\sale_con;
use App\Http\Controllers\order_con;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\chat_con;
use App\Http\Controllers\message_con;
use App\Http\Controllers\category_con;

use App\Http\Controllers\sale_item_con;

use App\Http\controllers\dashboard_con;
use App\Http\Controllers\customer_con;
use App\Http\Controllers\login_con;
use App\Http\Controllers\register;
use App\Http\Controllers\conversation_con;
use App\Http\Controllers\supplier_con;
use App\Http\Controllers\CartController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\home_con;
use App\Http\Controllers\CustomerCart_con;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('customer/cart', [CustomerCart_con::class, 'show_cart'])->name('customer.cart');
    Route::post('/cart/add', [CustomerCart_con::class, 'add'])->name('customer.cart.add');
    Route::post('/cart/remove', [CustomerCart_con::class, 'remove'])->name('customer.cart.remove');
    Route::post('/cart/checkout', [CustomerCart_con::class, 'checkout'])->name('customer.cart.checkout');
});





Route::get('/', [home_con::class, 'index'])->name('home');

Route::get('/all_products', [home_con::class, 'all_pro'])->name('all_pro');
Route::get('/show_category/{id}', [home_con::class, 'show_cat'])->name('show_cat');


Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::get('/medicines', [product_con::class, 'index'])->name('medicines.index');


// صفحة تسجيل الدخول للعميل
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');

Route::get('/login', [login_con::class,'login'])->name('login');
Route::post('/do_login', [login_con::class, 'do_login'])->name('do_login');
Route::get('/register', [register::class,'register'])->name('register');
Route::post('/do_register', [register::class, 'do_register'])->name('do_register');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully.');
})->name('logout');

Route::get('/dashboard',[dashboard_con::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/create_user', [user_con::class, 'create_user'])->name('create_user');
    Route::post('/store_user', [user_con::class, 'store_user'])->name('store_user');
    Route::get('/show_users', [user_con::class, 'show_user'])->name('show_user');
    Route::get('/edit_user/{id}', [user_con::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user/{id}', [user_con::class, 'update_user'])->name('update_user');
    Route::get('/delete_user/{id}', [user_con::class, 'delete_user'])->name('destroy_user');

    Route::get('/create_customer', [customer_con::class, 'create_customer'])->name('create_customer');
    Route::post('/store_customer', [customer_con::class, 'store_customer'])->name('store_customer');
    Route::get('/show_customer', [customer_con::class, 'show_customer'])->name('show_customer');
    Route::get('/edit_customer/{id}', [customer_con::class, 'edit_customer'])->name('edit_customer');
    Route::post('/update_customer/{id}', [customer_con::class, 'update_customer'])->name('update_customer');
    Route::get('/delete_customer/{id}', [customer_con::class, 'delete_customer'])->name('destroy_customer');

    Route::get('/show_products', [product_con::class, 'show_product'])->name('show_product');
    Route::get('/create_product', [product_con::class, 'create_product'])->name('create_product');
    Route::post('/store_product', [product_con::class, 'store_product'])->name('store_product');
    Route::get('/edit_product/{id}', [product_con::class, 'edit_product'])->name('edit_product');
    Route::put('/update_product/{id}', [product_con::class, 'update_product'])->name('update_product');
    Route::delete('/delete_product/{id}', [product_con::class, 'delete_product'])->name('destroy_product');


    Route::get('/show_supplier', [supplier_con::class, 'show_sup'])->name('show_supplier');
    Route::get('/create_supplier', [supplier_con::class, 'create_sup'])->name('create_supplier');
    Route::post('/store_supplier', [supplier_con::class, 'store_sup'])->name('store_supplier');
    Route::get('/edit_supplier/{id}', [supplier_con::class, 'edit_sup'])->name('edit_supplier');
    Route::post('/update_supplier/{id}', [supplier_con::class, 'update_sup'])->name('update_supplier');
    Route::get('/delete_supplier/{id}', [supplier_con::class, 'delete_sup'])->name('destroy_supplier');

    Route::get('/stocks', [stock_con::class, 'show_stock'])->name('show_stock');
    Route::get('/stocks/create', [stock_con::class, 'create_stock'])->name('create_stock');
    Route::post('/stocks', [stock_con::class, 'store_stock'])->name('store_stock');
    Route::get('/stocks/edit/{id}', [stock_con::class, 'edit_stock'])->name('edit_stock');
    Route::post('/stocks/update/{id}', [Stock_con::class, 'update_stock'])->name('update_stock');
    Route::delete('/stocks/{id}', [stock_con::class, 'destroy_stock'])->name('destroy_stock');

    Route::get('/purchases', [purchase_con::class, 'index_purchase'])->name('index_purchase');
    Route::get('/purchases/create', [purchase_con::class, 'create_purchase'])->name('create_purchase');
    Route::post('/purchases', [purchase_con::class, 'store_purchase'])->name('store_purchase');
    Route::get('/purchases/edit/{id}', [purchase_con::class, 'edit_purchase'])->name('edit_purchase');
    Route::post('/purchases/update/{id}', [purchase_con::class, 'update_purchase'])->name('update_purchase');
    Route::delete('/purchases/{id}', [purchase_con::class, 'destroy_purchase'])->name('destroy_purchase');

    Route::get('/purchases/{purchase_id}/items', [purchase_item_con::class, 'show_purchase_items'])->name('show_purchase_items');
    Route::get('/purchases/{purchase_id}/items/create', [purchase_item_con::class, 'create_purchase_item'])->name('create_purchase_item');
    Route::post('/purchases/{purchase_id}/items', [purchase_item_con::class, 'store_purchase_item'])->name('store_purchase_item');
    Route::delete('/purchase_items/{id}', [purchase_item_con::class, 'destroy_purchase_item'])->name('destroy_purchase_item');
    Route::get('/orders', [Order_con::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [Order_con::class, 'show_order'])->name('orders.show');
    Route::delete('/orders/{id}', [Order_con::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/{id}/approve', [Order_con::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{id}/ship', [Order_con::class, 'ship'])->name('orders.ship');
    Route::get('/my-orders', [Order_con::class, 'myOrders'])->name('my.orders');

    Route::get('/sales', [Sale_con::class, 'index_sale'])->name('index_sales');
    Route::get('/show_sale', [Sale_con::class, 'show_sale'])->name('show_sales');
    Route::get('/sales/create', [Sale_con::class, 'create_sale'])->name('create_sale');
    Route::post('/sales', [Sale_con::class, 'store_sale'])->name('store_sale');
    Route::get('/sales/edit/{id}', [Sale_con::class, 'edit_sale'])->name('edit_sale');
    Route::post('/sales/update/{id}', [Sale_con::class, 'update_sale'])->name('update_sale');
    Route::delete('/sales/{id}', [Sale_con::class, 'destroy_sale'])->name('destroy_sale');
    Route::get('/index', [sale_con::class, 'index'])->name('index');

    Route::get('/show_sales/{sale_id}/items', [sale_item_con::class, 'show_sale_items'])->name('show_sale_items');
    Route::get('/sales/{sale_id}/items/create', [sale_item_con::class, 'create_sale_item'])->name('create_sale_item');
    Route::post('/sales/{sale_id}/items', [sale_item_con::class, 'store_sale_item'])->name('store_sale_item');
    Route::delete('/sale_items/{id}', [sale_item_con::class, 'destroy_sale_item'])->name('destroy_sale_item');

    Route::get('/index/sales', [SaleController::class, 'index'])->name('list of sale');
    Route::get('/index/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::post('cashier/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('cashier/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cashier/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');

    Route::get('/category', [category_con::class, 'index'])->name('category.index');
    Route::get('/category/create', [category_con::class, 'create'])->name('category.create');
    Route::post('/category/store', [category_con::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [category_con::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [category_con::class, 'update'])->name('category.update');
    Route::patch('/category/toggle/{id}', [category_con::class, 'toggle'])->name('category.toggle');
    Route::get('/category/delete/{id}', [category_con::class, 'destroy'])->name('category.delete');

    Route::get('/conversation/user', [conversation_con::class, 'user_index'])->name('conversation');
    Route::get('/conversation', [conversation_con::class, 'admin_index'])->name('admin_conversation');
    Route::get('/admin/conversations/{id}', [conversation_con::class, 'admin_show'])->name('admin.conversations.show');

    Route::post('/messages/store', [message_con::class, 'store'])->name('messages.store');
    Route::post('/admin/messages/store', [message_con::class, 'admin_store'])->name('admin.messages.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
