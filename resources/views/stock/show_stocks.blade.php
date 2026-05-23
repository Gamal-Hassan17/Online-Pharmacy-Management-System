@extends('include.templat.main_page')

@section('title')
    Show Stocks
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر الإضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('create_stock') }}"
           class="btn btn-outline-success px-4">
            Add Stock
        </a>
    </div>

    <!-- الجدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($stocks as $stock)
                <tr>

                    <th>{{ $stock->id }}</th>

                    <td>
                        <span class="fw-semibold">
                            {{ $stock->product->name }}
                        </span>
                    </td>

                    <!-- Quantity -->
                    <td>
                        @if($stock->quantity <= 5)
                            <span class="badge bg-danger">
                                {{ $stock->quantity }} (Low)
                            </span>
                        @elseif($stock->quantity <= 20)
                            <span class="badge bg-warning text-dark">
                                {{ $stock->quantity }}
                            </span>
                        @else
                            <span class="badge bg-success">
                                {{ $stock->quantity }}
                            </span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td style="white-space: nowrap;">
                        {{ $stock->created_at }}
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('edit_stock', $stock->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form action="{{ route('destroy_stock', $stock->id) }}" method="POST">
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
