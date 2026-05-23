@extends('include.templat.main_page')

@section('title', 'Order Invoice')

@php
    $showNavbar = true;
@endphp
@section('contact')
<div class="container mt-5">

    <h3 class="mb-4">📋 All Conversations</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($conversations as $conv)
                <tr>
                    <td>{{ $conv->id }}</td>
                    <td>{{ $conv->user->username ?? 'Unknown User' }}</td>
                    <td>
                        <a href="{{ route('admin.conversations.show', $conv->id) }}"
                           class="btn btn-success">
                           View Conversation
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
