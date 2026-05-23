@extends('include.templat.main_page')

@section('title')
    Show Purchases
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر الإضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('create_purchase') }}"
           class="btn btn-outline-success px-4">
            Add Purchase
        </a>
    </div>

    <!-- الجدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($purchases as $purchase)
                <tr>

                    <th>{{ $purchase->id }}</th>

                    <td>
                        {{ $purchase->supplier?->name ?? 'N/A' }}
                    </td>

                    <td>
                        <span class="text-primary">
                            {{ $purchase->user?->username ?? 'N/A' }}
                        </span>
                    </td>

                    <!-- Total -->
                    <td>
                        <span class="fw-bold text-success">
                            {{ number_format(
                                $purchase->purchaseItems->sum(fn($item) => $item->quantity * $item->unit_cost),
                                2
                            ) }}
                        </span>
                    </td>

                    <!-- Date -->
                    <td style="white-space: nowrap;">
                        {{ $purchase->created_at }}
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('show_purchase_items', $purchase->id) }}"
                               class="btn btn-sm btn-info text-white">
                                View
                            </a>

                            <a href="{{ route('edit_purchase', $purchase->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form action="{{ route('destroy_purchase', $purchase->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm w-100"
                                    onclick="return confirm('Are you sure?')">
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
