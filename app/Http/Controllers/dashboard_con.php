<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\user;
use App\Models\Sale;
use App\Models\purchase;
use App\Models\Order;
use App\Models\Conversation;

use Carbon\Carbon;
use App\Models\dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class dashboard_con extends Controller
{
    public function dashboard() {

        $today = Carbon::today();

        $todaysales = Sale::with(['customer', 'user', 'saleItems'])
        ->whereDate('created_at', today())
        ->get()
        ->map(function ($sale) {
            $sale->total = $sale->saleItems->sum(function ($item) {
                return $item->quantity * $item->unit_price;
            });
            return $sale;
        });

        $todayPurchases = Purchase::with(['purchaseItems', 'supplier', 'user'])
        ->whereDate('created_at', $today)
        ->get();

        $lowStockProducts = Product::with('stock')
                ->whereHas('stock', function($query) {
                    $query->where('quantity', '<', 10);
                })->get();

        $daySalary      =Sale::whereDate('created_at', today())->sum('total_amount');
        $dayOrders     =Order::whereDate('created_at', today())->sum('total_amount');
        $dayPurchases     =Purchase::whereDate('created_at', today())->sum('total_amount');
        $dayprofit      =($daySalary+$dayOrders)-$dayPurchases;

        $monthlyPurchases = Purchase::with(['purchaseItems', 'supplier', 'user'])
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');;

        $monthlysales = Sale::with(['saleItems', 'customer', 'user'])
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');;

        $monthlyorders = Order::with(['orderItems', 'customer', 'user'])
            ->whereMonth('created_at', now()->month)
            ->where('status', 'shipped')
            ->sum('total_amount');;

        $monthlyProfit =($monthlysales+$monthlyorders)-$monthlyPurchases;

        $ordersShippedSales = Order::where('status', 'shipped')->sum('total_amount');
        $ordersCount = Order::count();

        // Analytics for charts
        $salesData = Sale::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $ordersData = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('status', 'shipped')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $purchasesData = purchase::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $profitData = collect();

            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();

                $sales = Sale::whereDate('created_at', $date)
                    ->sum('total_amount');

                $purchases = Purchase::whereDate('created_at', $date)
                    ->sum('total_amount');

                $profit = $sales - $purchases;

                $profitData->push([
                    'date' => $date,
                    'total' => $profit
                    ]);
}

        $openConversations = Conversation::where('status', 'open')->count();
        $totalConversations = Conversation::count();

        // Return View
        return view('dashboard', [
            'totalMedicines' => Cache::remember('totalMedicines', 3600, fn() => Product::count()),
            'totalCustomers' => Cache::remember('totalCustomers', 3600, fn() => user::where('role', 'customer')->count()),
            'daySalary'      => $daySalary,
            'dayOrders'      => $dayOrders,
            'dayPurchases'      =>$dayPurchases ,
            'dayprofit'         =>$dayprofit,
            'monthlyProfit'         =>$monthlyProfit,
            'monthlysales'   => $monthlysales,
            'monthlyPurchases'   => $monthlyPurchases,
            'monthlyorders'   => $monthlyorders,
            'todaysales'    => $todaysales,
            'todayPurchases'   => $todayPurchases,
            'lowStockProducts' =>$lowStockProducts,
            'ordersShippedSales' => Cache::remember('ordersShippedSales', 3600, fn() => Order::where('status', 'shipped')->sum('total_amount')),
            'ordersCount' => $ordersCount,
            'salesData' => $salesData,
            'ordersData' => $ordersData,
            'purchasesData' => $purchasesData,
            'profitData'    =>$profitData,
            'openConversations' => Cache::remember('openConversations', 600, fn() => Conversation::where('status', 'open')->count()), // Shorter cache
            'totalConversations' => Cache::remember('totalConversations', 3600, fn() => Conversation::count()),
        ]);
    }

}
