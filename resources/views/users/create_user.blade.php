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
            <h3 class="text-center mb-4">Create New User</h3>

            <!-- رسائل النجاح -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- رسائل الأخطاء -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6 class="mb-2">Please fix the following errors:</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form autocomplete="off" method="POST" action="{{ route('store_user') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username" required value="{{ old('username') }}">
                    <label for="floatingUsername">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email" required value="{{ old('email') }}">
                    <label for="floatingEmail">Email</label>
                </div>

                <div class="form-floating mb-3">
                   <select class="form-select" id="floatingRole" name="role" required>
    <option value="" selected disabled>Choose Role</option>
    <option value="admin" >Admin</option>
    <option value="cashier" >Cashier</option>
    <option value="customer" >Customer</option>
</select>

                    <label for="floatingRole">User Role</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="floatingPasswordConfirm">Confirm Password</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Create User</button>
            </form>
        </div>
    </div>
@endsection
