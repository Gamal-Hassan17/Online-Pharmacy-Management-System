@extends('include.templat.main_page')

@section('title')
    Purchase Items
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر إضافة Purchase Item -->
    <div class="text-center mb-4">
        <a href="{{ route('create_purchase_item', $purchase->id) }}" class="btn btn-lg btn-success px-4">
            + Add New Purchase Item
        </a>
    </div>

    <!-- بيانات الفاتورة -->
    <!-- بطاقة الفاتورة -->
    <div class="card shadow border-primary mx-auto" style="max-width: 900px;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">📦 Purchase Invoice #{{ $purchase->id }}</h4>
        </div>
        <div class="card-body">

            <!-- معلومات عامة عن الفاتورة -->
            <div class="row mb-4 text-center">
                <div class="col-md-4"><strong>Supplier:</strong><br>{{ $purchase->supplier?->name ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>User:</strong><br>{{ $purchase->user?->username ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>Date:</strong><br>{{ $purchase->created_at->format('Y-m-d H:i') }}</div>
            </div>

            <!-- جدول العناصر -->
            @if($purchase->purchaseItems->count())
                @php
                    $total = $purchase->purchaseItems->sum(fn($item) => $item->quantity * $item->unit_cost);
                @endphp
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Cost (EGP)</th>
                                <th>Total Cost (EGP)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->purchaseItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product?->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->unit_cost, 2) }}</td>
                                    <td class="fw-bold text-success">{{ number_format($item->quantity * $item->unit_cost, 2) }}</td>
                                    <td>
                                        {{-- <a href="{{ route('edit_purchase_items', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
                                        <form action="{{ route('destroy_purchase_item', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
                <div class="alert alert-warning text-center">No purchase items found.</div>
            @endif
        </div>
    </div>
</div>
@endsection
