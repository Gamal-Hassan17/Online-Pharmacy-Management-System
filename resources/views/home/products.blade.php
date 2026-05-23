@extends('include.templat.layout')
@section('title', 'All Medicines')

@section('content')
<div class="container my-5">
  <h2 class="mb-4 text-center text-success">🩺 All Medicines</h2>

  <div class="row g-4">

    @foreach($products as $product)

      @php
          $qty = $product->stock->quantity ?? 0;
      @endphp

      <div class="col-sm-6 col-md-4 col-lg-3">

        <div class="card h-100 border-success shadow-sm text-center
            {{ $qty == 0 ? 'opacity-75' : '' }}">

          <div class="card-body d-flex flex-column justify-content-between">

            <div>
              <h5 class="card-title fw-bold text-success">
                {{ $product->name }}
              </h5>

              <p class="card-text text-muted mb-2">
                💰 {{ number_format($product->price, 2) }} EGP
              </p>

              {{-- Stock Status --}}
              @if($qty > 0)
                  <span class="badge bg-success mb-3">In Stock</span>
              @else
                  <span class="badge bg-danger mb-3">Out of Stock</span>
              @endif
            </div>

            <div>

              {{-- Add to Cart --}}
              @if($qty > 0)

                <form action="{{ route('customer.cart.add') }}" method="POST" class="mb-2">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <div class="input-group mb-2">
                    <input type="number"
                           name="quantity"
                           class="form-control text-center"
                           value="1"
                           min="1"
                           max="{{ $qty }}">
                  </div>

                  <button type="submit" class="btn btn-success w-100">
                    ➕ Add to Cart
                  </button>
                </form>

              @else
                <button class="btn btn-secondary w-100 mb-2" disabled>
                  ❌ Unavailable
                </button>
              @endif


              {{-- Remove from Cart --}}
              @if(session('cart') && isset(session('cart')[$product->id]))
                <form action="{{ route('customer.cart.remove') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" class="btn btn-outline-danger w-100">
                    🗑️ Remove from Cart
                  </button>
                </form>
              @endif


              {{-- View Cart --}}
              @if(session('cart') && count(session('cart')) > 0)
                <form action="{{ route('customer.cart') }}" method="GET" class="mt-2">
                    <button type="submit" class="btn btn-outline-success fw-semibold w-100">
                        🛒 View Cart ({{ count(session('cart')) }})
                    </button>
                </form>
              @else
                <a class="btn btn-outline-secondary fw-semibold w-100 mt-2"
                   href="{{ route('customer.cart') }}">
                    🛒 Cart
                </a>
              @endif

            </div>
          </div>
        </div>

      </div>

    @endforeach

  </div>
</div>

{{-- Hover effect --}}
<style>
.card:hover {
    transform: scale(1.02);
    transition: 0.3s ease;
}
</style>

@endsection
