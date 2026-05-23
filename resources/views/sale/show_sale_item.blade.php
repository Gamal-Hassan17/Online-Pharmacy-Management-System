@extends('include.templat.main_page')

@section('title')
    Sale Invoice
@endsection

@php
    $showNavbar = true;
    $total = $sale->saleItems->sum(fn($item) => $item->quantity * $item->unit_price);
@endphp

@section('contact')

<div class="container py-4">

    <div class="text-center mb-4">
        <a href="{{ route('create_sale_item', $sale->id) }}" class="btn btn-lg btn-success px-4">
            + Add New Sale Item
        </a>
    </div>

    <!-- فاتورة البيع -->
    <div class="card shadow border-primary mx-auto" style="max-width: 900px;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">🧾 Sale Invoice #{{ $sale->id }}</h4>
        </div>
        <div class="card-body">

            <!-- معلومات عامة -->
            <div class="row mb-4 text-center">
                <div class="col-md-4"><strong>Customer:</strong><br>{{ $sale->customer?->name ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>User:</strong><br>{{ $sale->user?->username ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>Date:</strong><br>{{ $sale->created_at->format('Y-m-d H:i') }}</div>
            </div>

            <!-- جدول العناصر -->
            @if($sale->saleItems->count())
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price (EGP)</th>
                                <th>Total (EGP)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="fw-bold text-success">{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('destroy_sale_item', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total</th>
                                <th colspan="2" class="text-success fw-bold">{{ number_format($total, 2) }} EGP</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center">No sale items found.</div>
            @endif
        </div>
    </div>

</div>

@endsection
