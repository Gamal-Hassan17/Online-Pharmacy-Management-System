@extends('include.templat.main_page')
@section('title')
    Dashboard
@endsection




@section('contact')
<div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="mobileSidebar">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Pharmacy Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        <a class="nav-link text-white fw-bold mb-2" href="{{route('home')}}">🏠 Online Pharmacy</a>
        <a class="nav-link text-white mb-2" href="{{route('index')}}">🏠 Cashier POS</a>
        <a class="nav-link text-white mb-2" href="{{route('show_user')}}">👤 Users</a>
        <a class="nav-link text-white mb-2" href="{{route('show_product')}}">💊 Medicines</a>
        <a class="nav-link text-white mb-2" href="{{route('category.index')}}">📂 Categories</a>
        <a class="nav-link text-white mb-2" href="{{route('show_supplier')}}">🏭 Suppliers</a>
        <a class="nav-link text-white mb-2" href="{{route('index_purchase')}}">🛒 Purchases</a>
        <a class="nav-link text-white mb-2" href="{{route('orders.index')}}">💰 Orders</a>
        <a class="nav-link text-white mb-2" href="{{route('show_stock')}}">📦 Stock</a>
        <a class="nav-link text-white mb-2" href="{{ route('admin_conversation') }}">💬 Customer Support</a>


        <hr class="text-white">

        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger w-100">
            🚪 Logout
        </button>
        </form>

    </div>
</div>
<div class="container-fluid">
    <div class="col-lg-2 p-0">
        <nav class="sidebar d-none d-lg-block">
                    <h3 class="mb-4">Pharmacy Dashboard</h3>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white fw-bold" href="{{route('home')}}">🏠 Online Pharmacy</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('index')}}"> 🏠Cashier POS</a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('show_user')}}">👤 Users</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('show_product')}}">💊 Medicines</a>
                    </li>
                    <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="{{route('category.index')}}">💊 Categories</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('show_supplier')}}">🏭 Suppliers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('index_purchase') }}">🛒 Purchases</a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('orders.index')}}">💰 Orders</a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{route('show_stock')}}">📦 Stock</a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('admin_conversation') }}">💬 Customer Support</a>
                    </li>


                    <li class="nav-item d-flex align-items-center">
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button class="btn d-flex align-items-center">🚪 Logout</button>
                        </form>
                    </li>
                </ul>
        </nav>
    </div>

        <div class="content col-12 col-lg-10 p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
                <nav class="navbar navbar-light p-0 d-lg-none">
                    <button class="btn btn-success" type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobileSidebar"
                        aria-controls="mobileSidebar">
                        ☰ Menu
                    </button>

                </nav>

                <h2 class="mb-0">
                    Welcome to the Pharmacy Dashboard
                </h2>

            </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Stats Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-info shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Customers</h6>
                                <a class="h3 text-info fw-bold" href="{{route('show_user')}}">{{$totalCustomers}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-success shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Total Medicines</h6>
                                <a class="h3 text-success fw-bold" href="{{route('show_product')}}">{{$totalMedicines}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-warning shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Day Sales</h6>
                                <p class="h3 text-warning fw-bold">{{ number_format($daySalary, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-warning shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Monthly Sales</h6>
                                <p class="h3 text-warning fw-bold">{{number_format($monthlysales, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-primary shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Day Orders</h6>
                                <p class="h3 text-primary fw-bold">{{ number_format($dayOrders, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-primary shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Monthly Orders</h6>
                                <p class="h3 text-primary fw-bold">{{number_format($monthlyorders, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-success shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Day Purchases</h6>
                                <p class="h3 text-success fw-bold">{{ number_format($dayPurchases, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-success shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Monthly Purchases</h6>
                                <p class="h3 text-success fw-bold">{{ number_format($monthlyPurchases, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-success shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Day profit</h6>
                                <p class="h3 text-success fw-bold">{{ number_format($dayprofit, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-success shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Monthly profit</h6>
                                <p class="h3 text-success fw-bold">{{ number_format($monthlyProfit, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-dark shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Orders Count</h6>
                                <a class="h3 text-dark fw-bold" href="{{ route('orders.index') }}">{{ $ordersCount }}</a>
                            </div>
                        </div>
                    </div>




                    <div class="col-12 col-sm-6 col-xl-3">
                            <div class="card text-center border-info shadow">
                            <div class="card-body">
                                <h6 class="text-muted">Open Conversations</h6>
                                <a class="h3 text-info fw-bold" href="{{ route('admin_conversation') }}">{{ $openConversations }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytics Section -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-xl-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5>Sales Over Last 30 Days</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5>Orders Over Last 30 Days</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5>Purchases Over Last 30 Days</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="purchasesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5>Profit Over Last 30 Days</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="profitChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div class="row g-4">
            <!-- Today's Orders -->
            <div class="col-lg-6">
                <div class="card shadow border-success">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <span>📅 Today's Sales</span>
                        {{-- <form action="{{ route('delete_today_orders') }}" method="POST" onsubmit="return confirm('Delete all today\'s orders?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light">Delete All</button>
                        </form> --}}
                    </div>
                    <div class="card-body p-0">
                        @if($todaysales->count())
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-success">
                                        <tr>
                                            <th>#</th>
                                            <th>Customer</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($todaysales as $sale)
                                            <tr>
                                                <td>{{ $sale->id }}</td>
                                                <td>{{ $sale->customer?->name ?? 'N/A' }}</td>
                                                <td>{{ $sale->user?->username ?? 'N/A' }}</td>
                                                <td>{{ number_format($sale->total, 2) }} EGP</td>
                                                <td>{{ $sale->created_at->format('H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('show_sale_items', $sale->id) }}" class="btn btn-sm btn-outline-success">View Items</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-3 text-center text-muted">
                                No orders found for today.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Today's Purchases -->
            <div class="col-lg-6">
                <div class="card shadow border-primary">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span>📦 Today's Purchases</span>
                        {{-- <form action="{{ route('delete_today_purchases') }}" method="POST" onsubmit="return confirm('Delete all today\'s purchases?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light">Delete All</button>
                        </form> --}}
                    </div>
                    <div class="card-body p-0">
                        @if($todayPurchases->count())
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($todayPurchases as $purchase)
                                            <tr>
                                                <td>{{ $purchase->id }}</td>
                                                <td>{{ $purchase->supplier?->name ?? 'N/A' }}</td>
                                                <td>{{ $purchase->user?->username ?? 'N/A' }}</td>
                                                @foreach ($purchase->purchaseItems as $item)
                                                <td>
                                                    {{  number_format($item->quantity * $item->unit_cost, 2) }} EGP
                                                </td>
                                                @endforeach
                                                <td>{{ $purchase->created_at->format('H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('show_purchase_items', $purchase->id) }}" class="btn btn-sm btn-outline-primary">View Items</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-3 text-center text-muted">
                                No purchases found for today.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($lowStockProducts->count())
            <h4 class="mt-5 mb-3 text-success">🛒 Products Low in Stock (Below 5)</h4>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Barcode</th>
                            <th>Quantity in Stock</th>
                            <th>Supplier</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->barcode ?? 'N/A' }}</td>
                                <td class="text-danger fw-bold">{{ $product->stock->quantity ?? 'N/A' }}</td>
                                <td>{{ $product->supplier->name ?? 'N/A' }}</td>
                                <td>{{ $product->expiry_date ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-3 text-center text-muted">
                ✅ All products have enough stock.
            </div>
        @endif

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // function reusable لإنشاء أي line chart
    function createLineChart(canvasId, label, dataArray, borderColor, bgColor) {
        const ctx = document.getElementById(canvasId).getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataArray.map(item => item.date),
                datasets: [{
                    label: label,
                    data: dataArray.map(item => item.total),
                    borderColor: borderColor,
                    backgroundColor: bgColor,
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio:false,
                plugins:{
                    legend:{
                        display:true,
                        position:'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks:{
                            callback: value => value + ' EGP'
                        }
                    }
                }
            }
        });
    }

    // البيانات من Laravel
    const salesData     = @json($salesData);
    const ordersData    = @json($ordersData);
    const purchasesData = @json($purchasesData);

    // إنشاء الرسومات
    createLineChart(
        'salesChart',
        'Sales',
        salesData,
        'rgba(75,192,192,1)',
        'rgba(75,192,192,0.2)'
    );

    createLineChart(
        'ordersChart',
        'Orders',
        ordersData,
        'rgba(255,159,64,1)',
        'rgba(255,159,64,0.2)'
    );

    createLineChart(
        'purchasesChart',
        'Purchases',
        purchasesData,
        'rgba(153,102,255,1)',
        'rgba(153,102,255,0.2)'
    );
    const profitData = @json($profitData);
    createLineChart(
    'profitChart',
    'Profit',
    profitData,
    'rgba(40,167,69,1)',   // أخضر = ربح 💚
    'rgba(40,167,69,0.2)'
);
</script>
@endsection
