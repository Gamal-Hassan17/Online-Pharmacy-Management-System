@extends('include.templat.main_page')

@section('title')
    Create Purchase
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add New Purchase</h3>
        <form autocomplete="off" method="POST" action="{{ route('store_purchase') }}">
            @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSupplier" name="supplier_id">
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                <label for="floatingSupplier">Supplier</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingUser" name="user_id">
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
                <label for="floatingUser">User</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" class="form-control" id="floatingAmount" name="total_amount" placeholder="Total Amount" step="0.01" min="0" required>
                <label for="floatingAmount">Total Amount</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Purchase</button>
        </form>
    </div>
</div>
@endsection
