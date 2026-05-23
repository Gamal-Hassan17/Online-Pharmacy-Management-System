@extends('include.templat.main_page')

@section('title', 'Chat')

@php
    $showNavbar = true;
@endphp

@section('contact')

<div class="container mt-5">

    <h4 class="text-center mb-4">
        💬 Chat with {{ optional($conversation->user)->username ?? 'User' }}
    </h4>

    <div class="d-flex justify-content-center">

        <div style="width: 100%; max-width: 600px;">

            <div class="card shadow">

                <!-- Messages -->
                <div class="card-body chat-body">

                    @foreach($conversation->messages as $msg)

                        @if($msg->role == 'admin')
                            <div class="user-msg">
                                {{ $msg->message }}
                            </div>
                        @else
                            <div class="bot-msg">
                                {{ $msg->message }}
                            </div>
                        @endif

                    @endforeach

                </div>

                <!-- Send -->
                <div class="card-footer">
                    <form action="{{ route('admin.messages.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">

                        <div class="input-group">
                            <input type="text" name="message" class="form-control" required>
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

</div>

<style>
.chat-body {
    height: 400px;
    overflow-y: auto;
}

/* Admin (يمين) */
.user-msg {
    background: #007bff;
    color: white;
    padding: 10px;
    margin-bottom: 10px;
    margin-left: auto;
    width: fit-content;
    border-radius: 10px;
}

/* User (شمال) */
.bot-msg {
    background: #eee;
    padding: 10px;
    margin-bottom: 10px;
    width: fit-content;
    border-radius: 10px;
}
</style>

@endsection
