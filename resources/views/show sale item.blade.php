@extends('include.templat.main_page')

@section('title', '🧾 Sale Details')

@section('contact')
<style>
    .container{
        margin-top: 30px
    }
</style>


  <div class="container">
    <a class="btn btn-light fw-bold" href="{{ route('index') }}">
      💰 Pharmacy POS
    </a>


  </div>



<div class="receipt-container">
    <div class="card shadow" style="max-width: 600px; width: 100%;">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="mb-1">🏪 Pharmacy POS</h2>
                <h5 class="text-muted">🧾 Sales Receipt</h5>
                <hr>
                <p class="mb-1"><strong>Sale ID:</strong> #{{ $sale->id }}</p>
                <p class="mb-1"><strong>Date:</strong> {{ $sale->created_at->format('Y-m-d H:i') }}</p>
                <p class="mb-3"><strong>Cashier:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
            </div>

            <!-- Items Table -->
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr class="text-center">
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->saleItems as $item)
                        <tr class="text-center">
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }} EGP</td>
                            <td>{{ number_format($item->total_price, 2) }} EGP</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total -->
            <div class="text-end mt-3">
                <h4 class="text-success">Total Amount: {{ number_format($sale->total_amount, 2) }} EGP</h4>
            </div>

            <hr class="my-4">

            <!-- Footer -->
            <div class="text-center">
                <p class="text-muted mb-1">Thank you for shopping with us ❤️</p>
                <a href="{{ route('list of sale') }}" class="btn btn-secondary mt-2">⬅️ Back to Sales</a>
            </div>

        </div>
    </div>
</div>

@endsection
