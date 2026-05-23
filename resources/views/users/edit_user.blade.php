@extends('include.templat.main_page')

@section('title')
   Edit User
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
    <div class="form-container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Edit User</h3>

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

            <form autocomplete="off" method="POST" action="{{ route('update_user', ['id' => $user->id]) }}">
                @csrf

                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingRole" name="role" required>
                        <option disabled>Choose Role</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cashier" {{ old('role', $user->role) == 'cashier' ? 'selected' : '' }}>Cashier</option>
                        <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>

                    </select>
                    <label for="floatingRole">User Role</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username" required value="{{ old('username', $user->username) }}">
                    <label for="floatingUsername">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="name@example.com" required value="{{ old('email', $user->email) }}">
                    <label for="floatingEmail">Email address</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                    <label for="floatingPassword">Password (leave blank to keep current)</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password">
                    <label for="floatingPasswordConfirm">Confirm Password</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
