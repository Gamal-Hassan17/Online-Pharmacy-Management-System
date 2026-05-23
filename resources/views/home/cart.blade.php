@extends('include.templat.layout')
@section('title', 'Shopping Cart')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-center">🛒 Shopping Cart</h2>
  <div class="card shadow-sm">
    <div class="card-body">
        {{-- ✅ Display success message --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- ❌ Display error message --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- ⚠️ Display validation errors --}}
{{-- @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

      {{-- <pre>{{ print_r(session('cart'), true) }}</pre> --}}

      @if(session('cart') && count(session('cart')))
        <ul class="list-group mb-4">
          @foreach(session('cart') as $id => $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <strong>{{ $item['name'] }}</strong>
                <small class="text-muted ms-2">(x{{ $item['quantity'] }})</small>
              </div>
              <span class="badge bg-primary rounded-pill">
                {{ number_format($item['quantity'] * $item['price'], 2) }} EGP
              </span>
            </li>
          @endforeach
        </ul>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('customer.cart.checkout') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="text" name="phone" id="phone" class="form-control" required placeholder="Enter your phone number">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
            <textarea name="address" id="address" class="form-control" rows="2" required placeholder="Enter your full address"></textarea>
          </div>
          <button class="btn btn-success w-100">
            ✅ Proceed to Checkout
          </button>
        </form>
      @else
        <p class="text-muted text-center mb-0">Your cart is empty.</p>
      @endif

    </div>
  </div>
</div>
@endsection
