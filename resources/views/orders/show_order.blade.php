@extends('include.templat.main_page')

@section('title', 'Order Invoice')

@php
    $showNavbar = true;
@endphp

@section('contact')
<style>
    .invoice-box {
        background: #fff;
        padding: 30px;
        border: 1px solid #eee;
        border-radius: 10px;
        max-width: 800px;
        margin: auto;
        font-family: 'Cairo', sans-serif;
        box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }

    .invoice-box h3 {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .invoice-header {
        margin-bottom: 30px;
    }

    .invoice-footer {
        font-size: 18px;
        font-weight: bold;
        text-align: right;
        margin-top: 20px;
    }

    .table td, .table th {
        vertical-align: middle;
    }
</style>

<div class="container py-4">
    <div class="invoice-box">
        <div class="invoice-header d-flex justify-content-between">
            <div>
                <h3>Order Invoice</h3>
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Customer:</strong>  {{ $order->user->username ?? 'N/A' }}</p>
            </div>

        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->price, 2) }} EGP</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }} EGP</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Show phone and address for the first order item (assuming all items have the same info) -->
        @if($order->orderItems->count())
        <div class="mt-3">
            <strong>Phone:</strong> {{ $order->orderItems[0]->phone_number }}<br>
            <strong>Address:</strong> {{ $order->orderItems[0]->address }}
        </div>
        @endif

        <div class="invoice-footer">
            Total Amount: {{ number_format($order->total_amount, 2) }} EGP
        </div>
    </div>
</div>
@endsection
