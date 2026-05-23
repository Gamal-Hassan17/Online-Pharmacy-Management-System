@extends('include.templat.main_page')
@section('title')
    Login
@endsection
@section('contact')


    <div class="card-center">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>

                <form method="POST" action="{{ route('do_login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="userType" class="form-label">Choose Account Type</label>
                        <select class="form-select" id="userType" name="userType" required>
                            <option selected disabled>Choose...</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                             <option value="customer">Customer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <a href="{{ route('register') }}" class="btn btn-primary bg-green w-100 mt-2">
                    📝 Register
                </a>
            </div>
        </div>
    </div>
@endsection

