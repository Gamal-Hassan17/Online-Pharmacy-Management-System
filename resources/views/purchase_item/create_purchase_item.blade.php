@extends('include.templat.main_page')

@section('title')
    Create Purchase Item
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add New Purchase Item</h3>
       <form method="POST" action="{{ route('store_purchase_item', $purchases->id) }}">
    @csrf




            <div class="form-floating mb-3">
                <select class="form-select" id="floatingProduct" name="product_id" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <label for="floatingProduct">Product</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingQuantity" name="quantity" placeholder="Quantity" min="1" required>
                <label for="floatingQuantity">Quantity</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingUnitCost" name="unit_cost" placeholder="Unit Cost" step="0.01" min="0" required>
                <label for="floatingUnitCost">Unit Cost</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" class="form-control" id="floatingTotalCost" name="total_cost" placeholder="Total Cost \\not required" step="0.01" min="0" >
                <label for="floatingTotalCost">Total Cost</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Purchase Item</button>
        </form>
    </div>
</div>
@endsection
