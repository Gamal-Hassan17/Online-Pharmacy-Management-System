@extends('include.templat.main_page')

@section('title')
    Show Customer
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر الإضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="create_customer" class="btn btn-outline-success px-4">
            Add Customer
        </a>
    </div>

    <!-- الجدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($show_customers as $customer)
                <tr>
                    <th>{{ $customer->id }}</th>

                    <td>{{ $customer->username }}</td>

                    <td>
                        <span class="text-nowrap">{{ $customer->phone }}</span>
                    </td>

                    <td>
                        {{ $customer->address }}
                    </td>

                    <td style="white-space: nowrap;">
                        {{ $customer->created_at }}
                    </td>

                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('edit_customer', $customer->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <a href="{{ route('destroy_customer', ['id' => $customer->id]) }}"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?')">
                                Delete
                            </a>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
