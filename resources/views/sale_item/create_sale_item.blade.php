@extends('include.templat.main_page')

@section('title')
    Add New Sale Item
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add New Item for Sale #{{ $sale->id }}</h3>

        <!-- عرض الأخطاء -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form autocomplete="off" method="POST" action="{{ route('store_sale_item', $sale->id) }}">
            @csrf

            <!-- اختيار المنتج -->
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingProduct" name="product_id" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingProduct">Product</label>
            </div>

            <!-- إدخال الكمية -->
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingQuantity" name="quantity" placeholder="Quantity" min="1" value="{{ old('quantity', 1) }}" required>
                <label for="floatingQuantity">Quantity</label>
            </div>

            <!-- إدخال السعر للوحدة -->
            <div class="form-floating mb-4">
                <input type="number" step="0.01" class="form-control" id="floatingUnitPrice" name="unit_price" placeholder="Unit Price" min="0" value="{{ old('unit_price', 0) }}" required>
                <label for="floatingUnitPrice">Unit Price</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Item</button>
        </form>
    </div>
</div>
@endsection
