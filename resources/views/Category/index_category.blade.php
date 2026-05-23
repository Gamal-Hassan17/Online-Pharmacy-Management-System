@extends('include.templat.main_page')

@section('title')
    Show Categories
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container py-4">

    <!-- زر إضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="{{ route('category.create') }}"
           class="btn btn-outline-success px-4">
            Add Category
        </a>
    </div>

    <!-- جدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $cat)
                <tr>
                    <th>{{ $cat->id }}</th>

                    <td>{{ $cat->name }}</td>

                    <td>
                        <span class="text-muted">{{ $cat->slug }}</span>
                    </td>

                    <td>
                        {{ $cat->description ?? '---' }}
                    </td>

                    <!-- Status -->
                    <td>
                        <form action="{{ route('category.toggle', $cat->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            @if($cat->is_active)
                                <button class="btn btn-success btn-sm w-100">
                                    Active
                                </button>
                            @else
                                <button class="btn btn-secondary btn-sm w-100">
                                    Hidden
                                </button>
                            @endif
                        </form>
                    </td>

                    <!-- Actions -->
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                            <a href="{{ route('category.edit', $cat->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <form action="{{ route('category.delete', $cat->id) }}"
                                  method="POST">
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
