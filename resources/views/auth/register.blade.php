@extends('include.templat.main_page')

@section('title')
   Register
@endsection

@section('contact')
<div class="form-container">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Register</h3>

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

        <form autocomplete="off" method="POST" action="{{ route('do_register') }}">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username" required value="{{ old('username') }}">
                <label for="floatingUsername">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email" required value="{{ old('email') }}">
                <label for="floatingEmail">Email</label>
            </div>

            {{-- <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingAddress" name="address" placeholder="Address" required value="{{ old('address') }}">
                    <label for="floatingAddress">Address</label>
            </div> --}}
            {{-- <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPhone" name="phone" placeholder="Phone" required value="{{ old('phone') }}">
                <label for="floatingPhone">Phone</label>
            </div> --}}


            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password" required>
                <label for="floatingPasswordConfirm">Confirm Password</label>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Select Role</label>
                <select class="form-select" name="role" id="role" required>
                    <option value="" disabled selected>Choose Role</option>
                     {{-- <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option> --}}
                    {{-- <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier</option> --}} --}}
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                📝 Register
            </button>
        </form>

        <!-- Link to Login -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                Already registered?
            </a>
        </div>
    </div>
</div>
@endsection
