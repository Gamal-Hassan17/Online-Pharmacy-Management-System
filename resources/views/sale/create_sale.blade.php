@extends('include.templat.main_page')

@section('title')
    Add New Sale
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add New Sale</h3>

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

        <form method="POST" action="{{ route('store_sale') }}">
    @csrf

    <!-- اختيار عميل موجود -->
    <div class="form-floating mb-3">
        <select class="form-select" id="floatingCustomer" name="customer_id">
            <option value="">-- Select Existing Customer --</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->username }}
                </option>
            @endforeach
        </select>
        <label for="floatingCustomer">Choose Customer</label>
    </div>

    <!-- أو كتابة اسم عميل جديد -->
    <div class="form-floating mb-3">
        <input type="text" name="customer_name" class="form-control" id="floatingNewCustomer" placeholder="New Customer Name" value="{{ old('customer_name') }}">
        <label for="floatingNewCustomer">Or Enter New Customer Name</label>
    </div>

    <!-- اختيار المستخدم -->
    <div class="form-floating mb-3">
        <select class="form-select" name="user_id" required>
            <option value="">-- Select User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->username }}
                </option>
            @endforeach
        </select>
        <label for="user_id">User</label>
    </div>

    <button type="submit" class="btn btn-success w-100">Create Sale</button>
</form>

    </div>
</div>
@endsection
