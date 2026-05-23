@extends('include.templat.main_page')

@section('title')
    Add New Category
@endsection

@php
    $showNavbar = true;
@endphp

@section('contact')
    <div class="form-container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Add New Category</h3>

            <form autocomplete="off" method="POST" action="{{ route('category.store') }}">
                @csrf

                <!-- Name -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" name="name" placeholder="Category Name" required>
                    <label for="floatingName">Category Name</label>
                </div>

                <!-- Slug -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingSlug" name="slug" placeholder="Slug" required>
                    <label for="floatingSlug">Slug (SEO URL)</label>
                </div>

                <!-- Description -->
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Description" id="floatingDescription" name="description" style="height: 100px"></textarea>
                    <label for="floatingDescription">Description</label>
                </div>

                <!-- Active Status -->
                <div class="form-floating mb-4">
                    <select class="form-select" id="floatingStatus" name="is_active">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <label for="floatingStatus">Status</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add Category</button>
            </form>
        </div>
    </div>
@endsection
