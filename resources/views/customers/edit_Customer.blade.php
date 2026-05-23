@extends('include.templat.main_page')
@section('title')
   Edit Customer
@endsection
@php
    $showNavbar = true;
@endphp

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Edit Customer</h3>
        <form autocomplete="off" method="POST" action="{{ route('update_customer', $customer->id) }}">
            @csrf


            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" name="username" placeholder="Supplier Name" value="{{ $customer->username }}" required>
                <label for="floatingName">Customer Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPhone" name="phone" placeholder="Phone" value="{{ $customer->phone }}">
                <label for="floatingPhone">Phone</label>
            </div>

             <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required value="{{ old('email', $customer->email) }}">
                    <label for="floatingEmail">Email address</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                    <label for="floatingPassword">Password (leave blank to keep current)</label>
                </div>


            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="floatingAddress" name="address" placeholder="Address" value="{{ $customer->address }}">
                <label for="floatingAddress">Address</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Customer</button>
        </form>
    </div>
</div>
@endsection
