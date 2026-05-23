@extends('include.templat.main_page')

@section('title')
    Sale Items
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container my-4">

    <!-- كارت معلومات البيع -->
    <div class="card shadow mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Sale #{{ $sale->id }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4">
                    <strong>Customer:</strong> {{ $sale->customer?->name ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>User:</strong> {{ $sale->user?->username ?? 'N/A' }}
                </div>
                <div class="col-md-4">
                    <strong>Total Amount:</strong>
                    {{ $sale->saleItems->sum(fn($item) => $item->quantity * $item->unit_price) }}
                    EGP
                </div>
            </div>
            <div class="text-muted">
                <strong>Created At:</strong> {{ $sale->created_at }}
            </div>
        </div>
    </div>

    <!-- عنوان -->
    <h5 class="text-success mb-3">Sale Items</h5>

    @if($sale->saleItems->count())
        <div class="row">
            @foreach ($sale->saleItems as $item)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100 border-success shadow-sm">
                        <div class="card-header bg-success text-white">
                            Item #{{ $item->id??0 }}
                        </div>
                        <div class="card-body">
                            <p><strong>Product:</strong> {{ $item->product?->name ?? 'N/A' }}</p>
                            <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                            <p><strong>Unit Price:</strong> {{ $item->unit_price }} EGP</p>
                            <p class="text-success fw-bold"><strong>Total:</strong> {{ $item->quantity * $item->unit_price }} EGP</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('edit_sale_item', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('destroy_sale_item', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">No sale items found.</div>
    @endif

    <!-- زر إضافة Item جديد -->
    <div class="text-center my-4">
        <a href="{{ route('create_sale_item', $sale->id) }}" class="btn btn-success">
            Add New Sale Item
        </a>
    </div>

</div>

@endsection
