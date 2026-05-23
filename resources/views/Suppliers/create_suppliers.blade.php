@extends('include.templat.main_page')

@section('title')
    Create User
@endsection
@php
    $showNavbar = true;
@endphp
@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Add New Supplier</h3>
        <form autocomplete="off" method="POST" action="{{ route('store_supplier') }}">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" name="name" placeholder="Supplier Name" required>
                <label for="floatingName">Supplier Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPhone" name="phone" placeholder="Phone">
                <label for="floatingPhone">Phone</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" class="form-control" id="floatingAddress" name="address" placeholder="Address">
                <label for="floatingAddress">Address</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Create Supplier</button>
        </form>
    </div>
</div>

@endsection
