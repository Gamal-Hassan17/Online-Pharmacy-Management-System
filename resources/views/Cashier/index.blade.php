@extends('include.templat.main_page')

@section('title', 'Cashier POS')

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand " href="{{ route('home') }}">
      🏥 Online Pharmacy
    </a>

    <a class="navbar-brand" href="{{ route('index') }}">
      💰 Pharmacy POS
    </a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pharmacyNavbar" aria-controls="pharmacyNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="pharmacyNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">





        @if(auth()->user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">📊 Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('show_product') }}">📦 Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('show_user') }}">👥 Users</a>
          </li>
           <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{route('show_stock')}}">📦 Stock</a>
            </li>
        @endif
         <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('list of sale') }}">📜 Sales</a>
        </li>

            <li class="nav-item d-flex align-items-center">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn d-flex align-items-center">🚪 Logout</button>
                </form>
            </li>
      </ul>
    </div>
  </div>
</nav>


@section('contact')
<style>
    .cashier-hero {
        background: linear-gradient(90deg, #e8f5e9 60%, #fff 100%);
        border-radius: 18px;
        padding: 2rem 2rem 1rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 16px rgba(40,167,69,0.07);
    }
    .product-card {
        transition: box-shadow 0.2s, transform 0.2s;
        border-radius: 16px;
        border: 1px solid #e0e0e0;
        background: #fff;
    }
    .product-card:hover {
        box-shadow: 0 8px 24px rgba(40,167,69,0.12);
        transform: translateY(-4px) scale(1.03);
    }
    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 10px;
        background: #f8f9fa;
    }
    .cart-summary {
        background: #f8f9fa;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(33,150,243,0.07);
    }
    .cart-summary .list-group-item {
        background: transparent;
        border: none;
    }
    .cart-summary .total-row {
        font-weight: bold;
        font-size: 1.1rem;
        color: #28a745;
    }
    /* Category scroll green */
.category-scroll .overflow-auto::-webkit-scrollbar {
    height: 10px;
}

.category-scroll .overflow-auto::-webkit-scrollbar-track {
    background: #e8f5e9;
    border-radius: 20px;
}

.category-scroll .overflow-auto::-webkit-scrollbar-thumb {
    background: #28a745;
    border-radius: 10px;
}

.category-scroll .overflow-auto {
    scrollbar-color: #28a745 #e8f5e9;
    scrollbar-width: thin;
}
</style>

<div class="container py-4">

    <!-- HERO -->
    <div class="cashier-hero mb-4 d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <h2 class="fw-bold text-success mb-1">🛒 Cashier POS</h2>
            <p class="text-muted mb-0">Easily add products to the cart and complete sales quickly.</p>
        </div>

        <form action="{{ route('index') }}" method="GET" class="d-flex" style="max-width: 350px;">
            <input class="form-control me-2" type="search" name="search"
                   placeholder="Search for medicine..." value="{{ request('search') }}">
            <button class="btn btn-outline-success">🔍</button>
        </form>
    </div>

    <!-- CATEGORY PILLS -->
        <div class="mb-4 text-center">

            <h4 class="fw-bold text-success mb-3">All Categories</h4>

            <div class="category-scroll d-flex justify-content-center">
                <div class="d-flex gap-2 overflow-auto pb-2 px-2">

                    <a href="{{ route('index') }}"
                    class="btn {{ request('category') ? 'btn-outline-success' : 'btn-success' }}">
                    All
                    </a>

                    @foreach($categories as $cat)
                        <a href="{{ route('index',['category'=>$cat->id]) }}"
                        class="btn {{ request('category') == $cat->id ? 'btn-success' : 'btn-outline-success' }}">
                        {{ $cat->name }}
                        </a>
                    @endforeach

                </div>
            </div>

        </div>

    <div class="row g-4">

        <!-- PRODUCTS -->
        <div class="col-lg-8 order-2 order-lg-1">
            <h4 class="fw-bold text-success mb-4">Medicine</h4>

            <div class="row g-4">
                @foreach($products as $product)
                    @php
                        $qty = $product->stock->quantity ?? 0;
                    @endphp
                    <div class="col-md-4 col-sm-6">
                        <div class="product-card p-3 h-100 d-flex flex-column align-items-center justify-content-between">
                            <img src="{{ asset('images/medicine.jpg') }}" alt="{{ $product->name }}" class="product-img mb-2">
                            <h5 class="fw-bold text-success mb-1">{{ $product->name }}</h5>
                            <p class="text-muted mb-2">{{ number_format($product->price, 2) }} EGP</p>
                            @if($qty > 0)
                  <span class="badge bg-success mb-3">In Stock</span>
              @else
                  <span class="badge bg-danger mb-3">Out of Stock</span>
              @endif
                            <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" class="form-control mb-2" value="1" min="1" style="max-width: 90px; margin: 0 auto;">
                                <button type="submit" class="btn btn-success btn-sm w-100">Add to Cart</button>
                            </form>
                            @if(session('cart') && isset(session('cart')[$product->id]))
                                <form action="{{ route('cart.remove') }}" method="POST" class="w-100 mt-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">🗑️ Remove from Cart</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- CART -->
        <div class="col-lg-4 order-1 order-lg-2">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="cart-summary p-4 shadow-sm bg-light rounded">
                <h5 class="mb-3 text-primary">🛍️ Cart</h5>

                @if(session('cart') && count(session('cart')))
                    <ul class="list-group mb-3">
                        @php $total = 0; @endphp

                        @foreach(session('cart') as $id => $item)
                            @php $total += $item['quantity'] * $item['price']; @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    {{ $item['name'] }}
                                    <span class="badge bg-light text-dark">x{{ $item['quantity'] }}</span>
                                </span>
                                <span>{{ number_format($item['quantity'] * $item['price'], 2) }} EGP</span>

                            </li>

                        @endforeach

                        <li class="list-group-item d-flex justify-content-between fw-bold">
                            <span>Total</span>
                            <span>{{ number_format($total, 2) }} EGP</span>
                        </li>
                    </ul>

                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button class="btn btn-success w-100">Checkout</button>
                    </form>
                @else
                    <p class="text-muted text-center">No items in cart.</p>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
