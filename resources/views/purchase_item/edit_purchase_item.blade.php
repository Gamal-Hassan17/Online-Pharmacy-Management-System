@extends('include.templat.main_page')

@section('title')
    Edit Purchase Item
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Edit Purchase Item</h3>
        <form autocomplete="off" method="POST" action="{{ route('update_purchase_item', $purchases->id) }}">
            @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingPurchase" name="purchase_id" required>
                    <option value="">-- Select Purchase --</option>
                    @foreach($purchases as $purchase)
                        <option value="{{ $purchase->id }}" {{ $purchase->id == $purchase->purchase_id ? 'selected' : '' }}>
                            {{ $purchase->id }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingPurchase">Purchase</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingProduct" name="product_id" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $purchase_item->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingProduct">Product</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" min="1" class="form-control" id="floatingQuantity" name="quantity" placeholder="Quantity" value="{{ $purchase_item->quantity }}" required>
                <label for="floatingQuantity">Quantity</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" min="0" class="form-control" id="floatingUnitCost" name="unit_cost" placeholder="Unit Cost" value="{{ $purchase_item->unit_cost }}" required>
                <label for="floatingUnitCost">Unit Cost</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" step="0.01" min="0" class="form-control" id="floatingTotalCost" name="total_cost" placeholder="Total Cost" value="{{ $purchase_item->total_cost }}" required>
                <label for="floatingTotalCost">Total Cost</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Purchase Item</button>
        </form>
    </div>
</div>
@endsection
