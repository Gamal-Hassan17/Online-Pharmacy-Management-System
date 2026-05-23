@extends('include.templat.main_page')

@section('title')
    Edit Category
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
    <div class="form-container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Edit Category</h3>

            <form method="POST" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" name="name"
                        value="{{ old('name', $category->name) }}" placeholder="Category Name" required>
                    <label for="floatingName">Category Name</label>
                </div>

                <!-- Slug -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingSlug" name="slug"
                        value="{{ old('slug', $category->slug) }}" placeholder="Slug" required>
                    <label for="floatingSlug">Slug (SEO URL)</label>
                </div>

                <!-- Description -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Description" id="floatingDescription"
                        name="description" style="height: 100px">{{ old('description', $category->description) }}</textarea>
                    <label for="floatingDescription">Description</label>
                </div>

                <!-- Status -->
                <div class="form-floating mb-4">
                    <select class="form-select" id="floatingStatus" name="is_active">
                        <option value="1" {{ $category->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <label for="floatingStatus">Status</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Category</button>
            </form>
        </div>
    </div>
@endsection
