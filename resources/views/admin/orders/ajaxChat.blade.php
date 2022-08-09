<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-chat.css') }}">
<div class="user-chats" style="height:500px !important;" id="user-chats">
    <div class="chats">
        @if (count($chatList) > 0)
            @foreach ($chatList as $chat)
                @if (Auth::user()->id == $chat->sender_id)
                    <div class="chat">
                        <div class="chat-avatar">
                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">

                                <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content" style="padding-top: 1px !important;">
                                <p style="color:black;">{{ Auth::user()->name }}</p>
                                <p>{{ isset($chat->message) ? $chat->message : '' }}</p>
                            </div>
                        </div>
                        <span><i cl></i></span>
                    </div> 
                @else
                    <div class="chat chat-left">
                        <div class="chat-avatar">
                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-content" style="padding-top: 1px !important;">
                                <p style="color: #33c7d4;">{{ isset($chat->hasOneUser->name) ? $chat->hasOneUser->name : '' }}</p>
                                <p>{{ isset($chat->message) ? $chat->message : '' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach    
        @endif
    </div>
</div>
<script src="{{ asset('public/app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script type="text/javascript">
    var newSms = "{{ count($chatList) }}";
    // console.log(totalMessage);
</script>
