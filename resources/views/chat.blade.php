<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live Chat</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;500;600;700&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat.css') }}">
    <script>
        const $token = '{{ csrf_token() }}';
        const $username = '{{ auth()->user()->username ?? auth()->user()->email }}';
        const $email = '{{ auth()->user()->email }}';
        try {
            Typekit.load({ async: true });
        } catch (e) {}
    </script>
</head>
<body class="body">
<section class="main-wrapper">
    <div class="cgl-live-chat">
        <div class="chat-wrapper">
            <div class="chat-title">
                Live Chat
            </div>
            <div class="chat-view">


            </div>
            <div class="chat-message">
                <div id="form_chat">
                    <div class="input-group align-items-center">
                        <input type="text" id="chat_inp" class="form-control" placeholder="Type something...">
                        <div class="input-group-append">
                            <button class="submit" type="button" id="button-addon2">
                                <img src="https://github.com/suryavmds/Live-chat-HTML-design--like-YT-chat-/blob/master/assets/img/send-btn.svg?raw=true" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/chat.js') }}"></script>
</html>
