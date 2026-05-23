@extends('include.templat.main_page')

@section('title')
    Show Medicines
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('create_product') }}"
           class="btn btn-outline-success px-4">
            Add Medicine
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Selling</th>
                    <th>Cost</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Expiry</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($show_products as $product)
                <tr>

                    <th>{{ $product->id }}</th>

                    <td>{{ $product->name }}</td>

                    <td>
                        {{ Str::limit($product->description, 30) }}
                    </td>

                    <td>
                        <span class="text-success fw-bold">
                            {{ $product->price }}
                        </span>
                    </td>

                    <td>
                        <span class="text-muted">
                            {{ $product->cost_price }}
                        </span>
                    </td>

                    <td>
                        {{ $product->supplier ? $product->supplier->name : '---' }}
                    </td>
                    <td>
                        {{ $product->stock->quantity ?? 0 }}
                    </td>

                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $product->category ? $product->category->name : '---' }}
                        </span>
                    </td>

                    <td style="white-space: nowrap;">
                        {{ $product->expiry_date }}
                    </td>

                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('edit_product', $product->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <a href="{{ route('create_purchase') }}"
                            class="btn btn-sm btn-primary">
                                Add Purchase
                            </a>


                            <form action="{{ route('destroy_product', $product->id) }}" method="POST">
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
