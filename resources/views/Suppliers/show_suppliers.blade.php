@extends('include.templat.main_page')

@section('title')
    Show Supplier
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر الإضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('create_supplier') }}"
           class="btn btn-outline-success px-4">
            Add Supplier
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
                    <th>Email</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($show_suppliers as $supplier)
                <tr>

                    <th>{{ $supplier->id }}</th>

                    <td>{{ $supplier->name }}</td>

                    <td>
                        <span class="text-nowrap">
                            {{ $supplier->phone }}
                        </span>
                    </td>

                    <td>
                        <small class="text-muted">
                            {{ $supplier->email }}
                        </small>
                    </td>

                    <td>
                        {{ Str::limit($supplier->address, 30) }}
                    </td>

                    <td style="white-space: nowrap;">
                        {{ $supplier->created_at }}
                    </td>

                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('edit_supplier', $supplier->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <a href="{{ route('destroy_supplier', ['id' => $supplier->id]) }}"
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
