@extends('include.templat.main_page')

@section('title')
    Show Users
@endsection

@section('contact')

@php
    $showNavbar = true;
@endphp

<div class="container py-4">

    <!-- زر الإضافة -->
    <div class="d-flex justify-content-center mb-4">
        <a href="create_user" class="btn btn-outline-success px-4">
            Add User
        </a>
    </div>

    <!-- جدول المستخدمين -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($show_users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>

                        <td>{{ $user->username }}</td>

                        <td>
                            <span class="badge bg-success">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td style="white-space: nowrap;">
                            {{ $user->created_at }}
                        </td>

                        <td>
                            <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">

                                <a href="{{ route('edit_user', $user->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <a href="{{ route('destroy_user', ['id' => $user->id]) }}"
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
