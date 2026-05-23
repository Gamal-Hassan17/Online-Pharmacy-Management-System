@extends('include.templat.main_page')

@section('title')
    Add New Medicine
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
    <div class="form-container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Add New Medicine</h3>

            <form autocomplete="off" method="POST" action="{{ route('store_product') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" name="name" placeholder="Medicine Name" required>
                    <label for="floatingName">Medicine Name</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Description" id="floatingDescription" name="description" style="height: 100px"></textarea>
                    <label for="floatingDescription">Description</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="floatingPrice" name="price" placeholder="Selling Price" required>
                    <label for="floatingPrice">Selling Price</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="floatingCostPrice" name="cost_price" placeholder="Cost Price">
                    <label for="floatingCostPrice">Cost Price (Hidden from Customer)</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingBarcode" name="barcode" placeholder="Barcode">
                    <label for="floatingBarcode">Barcode</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingExpiry" name="expiry_date" placeholder="Expiry Date">
                    <label for="floatingExpiry">Expiry Date</label>
                </div>

                <div class="form-floating mb-4">
                    <select class="form-select" id="floatingSupplier" name="supplier_id">
                        <option selected disabled>Choose Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingSupplier">Supplier</label>
                </div>
                <div class="form-floating mb-4">
                    <select class="form-select" id="floatingcategory" name="category_id">
                        <option selected disabled>Choose category</option>
                        @foreach($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="floatingcategory">category</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add Medicine</button>
            </form>
        </div>
    </div>
@endsection
