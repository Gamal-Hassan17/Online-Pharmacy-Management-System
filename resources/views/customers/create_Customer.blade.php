@extends('include.templat.main_page')

@section('title')
    Create Customer
@endsection
@php
    $showNavbar = true;
@endphp

@section('contact')
    <div class="form-container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Create New Customer</h3>
            <form autocomplete="off" method="POST" action="{{route('store_customer')}}">
                @csrf


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" name="name" placeholder="Customer Name" required>
                    <label for="floatingName">Customer Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPhone" name="phone" placeholder="Phone">
                    <label for="floatingPhone">Phone</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email" required value="{{ old('email') }}">
                    <label for="floatingEmail">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                 <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="floatingPasswordConfirm">Confirm Password</label>
                </div>


                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="floatingAddress" name="address" placeholder="Address">
                    <label for="floatingAddress">Address</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Create Customer</button>
            </form>
        </div>
    </div>
@endsection
