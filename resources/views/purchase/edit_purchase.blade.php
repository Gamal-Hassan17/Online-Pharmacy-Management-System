@extends('include.templat.main_page')

@section('title')
    Edit Purchase
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Edit Purchase</h3>
        <form autocomplete="off" method="POST" action="{{ route('update_purchase', $purchase->id) }}">
            @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSupplier" name="supplier_id">
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingSupplier">Supplier</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingUser" name="user_id">
                    <option value="">-- Select User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $purchase->user_id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingUser">User</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" step="0.01" min="0" class="form-control" id="floatingAmount" name="total_amount" placeholder="Total Amount" value="{{ $purchase->total_amount }}" required>
                <label for="floatingAmount">Total Amount</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Purchase</button>
        </form>
    </div>
</div>
@endsection
