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
                        👋 مرحباً! كيف يمكننا مساعدتك؟<br>
                        أرسل رسالتك وسيتم الرد عليك قريباً.
                    </div>

                </div>

                <!-- Input -->
                <div class="card-footer bg-white">
                    <div class="input-group">
                        <input id="msg" type="text"
                               class="form-control"
                               placeholder="اكتب رسالتك هنا...">
                        <button onclick="sendSupport()"
                                class="btn btn-success">
                            إرسال
                        </button>
                    </div>
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

.user-msg, .bot-msg {
    margin-bottom: 15px;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 70%;
    word-wrap: break-word;
}

.user-msg {
    background-color: #007bff;
    color: white;
    margin-left: auto;
    text-align: right;
}

.bot-msg {
    background-color: #e9ecef;
    color: #333;
    margin-right: auto;
    text-align: left;
}
</style>

<script>

let chatBox = document.getElementById("chatBox");

function addMessage(text, type){
    let div = document.createElement("div");

    if(type === "user"){
        div.className = "user-msg";
    }else{
        div.className = "bot-msg";
    }

    div.textContent = text; // Changed to prevent XSS
    chatBox.appendChild(div);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendSupport(){

    let input = document.getElementById("msg");
    let msg = input.value.trim();

    if(msg === "") return;

    console.log('Sending message:', msg);
    console.log('Conversation ID:', "{{ $conversation->id }}");

    // عرض رسالة المستخدم
    addMessage(msg, "user");

    input.value = "";

    fetch("/support/send", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            message: msg,
            conversation_id: "{{ $conversation->id }}"
        })
    })
    .then(res => {
        console.log('Response status:', res.status);
        return res.json();
    })
    .then(data => {
        console.log('Response data:', data);
        addMessage(data.reply, "bot");
    })
    .catch(err => {
        console.error('Error:', err);
        addMessage("حدث خطأ في الإرسال ❌", "bot");
    });

}

</script>