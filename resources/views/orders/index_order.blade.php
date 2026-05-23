@extends('include.templat.main_page')

@section('title', 'All Orders')

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <h2 class="mb-4 text-center">🧾 All Orders</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($orders as $order)
                <tr>

                    <td>{{ $order->id }}</td>

                    <td>
                        {{ $order->user->username ?? 'N/A' }}
                    </td>

                    <!-- Total -->
                    <td>
                        <span class="fw-bold text-success">
                            {{ number_format($order->total_amount, 2) }} EGP
                        </span>
                    </td>

                    <!-- Status -->
                    <td>
                        @if ($order->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($order->status === 'approved')
                            <span class="badge bg-primary">Approved</span>
                        @elseif ($order->status === 'shipped')
                            <span class="badge bg-success">Shipped</span>
                        @else
                            <span class="badge bg-secondary">{{ $order->status }}</span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td style="white-space: nowrap;">
                        {{ $order->created_at }}
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('orders.show', $order->id) }}"
                               class="btn btn-sm btn-info text-white">
                                View
                            </a>

                            @if ($order->status === 'pending')
                                <form action="{{ route('orders.approve', $order->id) }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Approve this order?')"
                                            class="btn btn-sm btn-success w-100">
                                        Approve
                                    </button>
                                </form>
                            @elseif ($order->status === 'approved')
                                <form action="{{ route('orders.ship', $order->id) }}" method="POST">
                                    @csrf
                                    <button onclick="return confirm('Mark as shipped?')"
                                            class="btn btn-sm btn-warning w-100">
                                        Ship
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-danger w-100">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
