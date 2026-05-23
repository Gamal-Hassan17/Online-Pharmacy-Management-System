@extends('include.templat.layout')

@section('title', 'My Orders')

@php
    $showNavbar = true;
@endphp

@section('content')
<style>
.products-list {
    max-height: 200px;
    overflow-y: auto;
}

.product-item {
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.product-item:hover {
    background-color: #e9ecef;
    transform: translateX(5px);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.badge {
    font-size: 0.8rem;
    padding: 0.5em 0.8em;
}
</style>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="section-title mb-4">📋 My Orders</h1>

            @if($orders->count() > 0)
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        Order : #{{ $order->id }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-info">Approved</span>
                                                @break
                                            @case('shipped')
                                                <span class="badge bg-primary">Shipped</span>
                                                @break
                                            @case('delivered')
                                                <span class="badge bg-success">Delivered</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endswitch
                                    </div>

                                    <div class="mb-3">
                                        <strong>Total Price:</strong>
                                        <span class="text-success fw-bold">{{ number_format($order->total_amount, 2) }} EGP</span>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Order Date:</strong>
                                        <span>{{ $order->created_at->format('Y-m-d H:i') }}</span>
                                    </div>

                                    <hr>

                                    <h6 class="fw-bold mb-3">Ordered Products:</h6>
                                    <div class="products-list">
                                        @foreach($order->orderItems as $item)
                                            <div class="product-item border rounded p-2 mb-2">
                                                <div class="d-flex align-items-center">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="me-2"
                                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <div class="me-2 bg-light rounded d-flex align-items-center justify-content-center"
                                                             style="width: 40px; height: 40px;">
                                                            💊
                                                        </div>
                                                    @endif
                                                    <div class="flex-grow-1">
                                                        <div class="fw-semibold">{{ $item->product->name ?? 'Unavailable Product' }}</div>
                                                        <div class="text-muted small">
                                                            Qty: {{ $item->quantity }} × {{ number_format($item->price, 2) }} EGP
                                                        </div>
                                                        <div class="text-muted small">
                                                            📞 <b>Phone:</b> {{ $item->phone_number }}<br>
                                                            🏠 <b>Address:</b> {{ $item->address }}
                                                        </div>
                                                    </div>
                                                    <div class="text-success fw-bold">
                                                        {{ number_format($item->total_price, 2) }} EGP
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-bag" style="font-size: 4rem; color: #ccc;"></i>
                    </div>
                    <h3 class="text-muted mb-3">No Orders Yet</h3>
                    <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                    <a href="{{ route('all_pro') }}" class="btn btn-success btn-lg">
                        🛒 Shop Now
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection
