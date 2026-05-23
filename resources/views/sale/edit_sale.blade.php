@extends('include.templat.main_page')

@section('title')
    Edit Sale
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Edit Sale</h3>
        <form action="{{ route('update_sale', $sale->id) }}" method="POST">
            @csrf

            <!-- اختيار العميل -->
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingCustomer" name="customer_id" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $customer->id == $sale->customer_id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingCustomer">Customer</label>
            </div>

            <!-- اختيار المستخدم -->
            <div class="form-floating mb-4">
                <select class="form-select" id="floatingUser" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $sale->user_id ? 'selected' : '' }}>
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingUser">User</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Sale</button>
        </form>
    </div>
</div>
@endsection
