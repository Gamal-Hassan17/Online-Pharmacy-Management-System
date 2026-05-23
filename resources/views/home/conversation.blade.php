@extends('include.templat.layout')

@section('title','Contact Support')

@section('content')

<div class="container my-5">

    <h2 class="text-center text-success mb-4">
        📞 Contact Support
    </h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow border-success">

                <!-- Chat Messages -->
                <div id="chatBox" class="card-body chat-body">

                    <div class="bot-msg">
                        👋 مرحباً {{ $user->username }}! كيف يمكننا مساعدتك؟
                    </div>

                    @foreach($messages as $msg)

                        @if($msg->role == 'user')
                            <!-- User (Right) -->
                            <div class="user-msg">
                                {{ $msg->message }}
                            </div>

                        @elseif($msg->role == 'admin')
                            <!-- Admin (Left) -->
                            <div class="bot-msg border border-danger">
                                Admin:{{ $msg->message }}
                            </div>

                        @elseif($msg->role == 'cashier')
                            <!-- Cashier (Left) -->
                            <div class="bot-msg border border-warning">
                                💼 Cashier: {{ $msg->message }}
                            </div>

                        @else
                            <div class="bot-msg">
                                {{ $msg->message }}
                            </div>
                        @endif

                    @endforeach

                </div>

                <!-- Input -->
                <div class="card-footer bg-white">

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf

                        <div class="input-group">

                            <input id="msg" name="message" type="text"
                                   class="form-control"
                                   placeholder="اكتب رسالتك هنا..." required>

                            <input type="hidden" name="conversation_id"
                                   value="{{ $conversation->id }}">

                            <button class="btn btn-success">
                                إرسال
                            </button>

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
    background-color: #f8f9fa;
    padding: 15px;
}

/* Common message style */
.user-msg, .bot-msg {
    margin-bottom: 15px;
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 70%;
    word-wrap: break-word;
}

/* USER (RIGHT SIDE) */
.user-msg {
    background-color: #007bff;
    color: white;
    margin-left: auto;
    text-align: right;
    border-radius: 15px 15px 0 15px;
}

/* ADMIN / BOT (LEFT SIDE) */
.bot-msg {
    background-color: #e9ecef;
    color: #333;
    margin-right: auto;
    text-align: left;
    border-radius: 15px 15px 15px 0;
}
</style>

@endsection
