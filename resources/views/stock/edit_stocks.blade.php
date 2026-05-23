@extends('include.templat.main_page')

@section('title')
    Edit Stock
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Edit Stock</h3>
<form action="{{ route('update_stock', $stock->id) }}" method="POST">
        @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingProduct" name="product_id" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingProduct">Product</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" class="form-control" id="floatingQuantity" name="quantity" placeholder="Quantity" value="{{ $stock->quantity }}" min="0" required>
                <label for="floatingQuantity">Quantity</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Stock</button>
        </form>
    </div>
</div>
@endsection
