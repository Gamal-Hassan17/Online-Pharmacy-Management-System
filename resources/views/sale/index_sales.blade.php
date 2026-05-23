@extends('include.templat.main_page')

@section('title')
    Show Sales
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<!-- زر الإضافة في الأعلى -->
<div class="text-center my-4">
    <a href="{{ route('create_sale') }}" class="btn btn-outline-success">Add Sale</a>
</div>

<!-- جدول المبيعات -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer</th>
            <th scope="col">User</th>
            {{-- <th scope="col">Total Amount</th> --}}
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($sales as $sale)
            <tr>
                <th scope="row">{{ $sale->id }}</th>
                <td>{{ $sale->customer?->name ?? 'N/A' }}</td>
                <td>{{ $sale->user?->username ?? 'N/A' }}</td>
                {{-- <td>{{ $sale->total_amount }}</td> --}}
                <td>{{ $sale->created_at }}</td>
                <td class="text-center">

                    {{-- <a href="{{ route('create_sale_item', $sale->id) }}" class="btn btn-sm btn-outline-success mb-1">Add Item</a> --}}


                    <a href="{{ route('show_sale_items', $sale->id) }}" class="btn btn-sm btn-outline-info mb-1">View Items</a>


                    <a href="{{ route('edit_sale', $sale->id) }}" class="btn btn-sm btn-outline-primary mb-1">Edit</a>




                    <form action="{{ route('destroy_sale', $sale->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sale?')">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
@endsection
