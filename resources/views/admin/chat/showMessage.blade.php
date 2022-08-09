 {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/css/uikit.min.css" /> --}}
<div class="content-body">
    <div class="chat-overlay"></div>
    <section class="chat-app-window">
        <div class="start-chat-area  d-none">
            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
        </div>
        <div class="active-chat">
            <div class="chat_navbar">
                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                    <div class="vs-con-items d-flex align-items-center">
                        <div class="sidebar-toggle d-block d-lg-none mr-1">
                            <i class="feather icon-menu font-large-1"></i></div>
                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />
                            <span class="avatar-status-online"></span>
                        </div>
                        <h6 class="mb-0">
                            @if($chatHeadData->hasOneEmployee)
                                {{$chatHeadData->hasoneEmployee->name}}
                            @else
                                {{$chatHeadData->hasOneOfferCode->offer_code}}
                            @endif
                        </h6>
                    </div>
                    @if($chatHeadData->chat_type =='1')
                        <button type="button" class="btn btn-sm btn-danger delete-record" data-action="{{ route('admin.chat.destroy',$chatHeadData->id) }}"><i class="fa fa-trash"></i>
                        </button>
                    @endif
                </header>
            </div>  
          {{--   <div class="user-chats ps "> --}}
                <div class="user-chats" id="user-chats">

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
          {{--   </div> --}}
            
                       
                 {{--    <div data-emojiarea data-type="unicode" data-global-picker="false" > --}}
                       {{--   <a  class="first-btn uk-button uk-button-primary"  id="btnFile" title="Emoji"> <i class="fa fa-smile-o fa-2x"></i>
                        </a> --}}
                 {{--    </div> --}}
                   {{--  <div class="uk-container uk-container-small uk-section"> --}}
                    {{--  <a class="first-btn "> --}}{{-- </a> --}}
                {{--  </div> --}}
                   {{-- <a ><i class="feather icon-paperclip"></i></a> --}}
                    <span id="new_message" onclick="newMessage()" style="box-sizing: 20px;background: border-box;border: 2px solid;border-radius: 50%;padding: 7px;position: relative;left: 95%;display: none;"><i class="fa fa-chevron-down"></i></span>
                <div class="chat-app-form">
                <form class="chat-app-input d-flex" onsubmit="submit_chat();" action="javascript:void(0);">
                   {{--  <a title="Attached File" id="btnFile"> <i class="fa fa-paperclip fa-2x"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="fa fa-smile-o fa-2x first-btn " title="Emoji"></a>&nbsp;&nbsp; --}}
                    {{-- <input type="file" name="attach_file" id="attach_file" hidden>
                    <input type="text" class="form-control message mr-1 ml-50" id="message" placeholder="Type your message"> --}}
                    <input type="hidden" class="form-control message mr-1 ml-50" name="chat_head_id" id="chat_head_id" value="{{ isset($chatHeadData->id) ? $chatHeadData->id : '' }}">
                    <input type="hidden" class="form-control message mr-1 ml-50" name="recever_id" id="recever_id"value="{{ isset($chatHeadData->recever_id) ? $chatHeadData->recever_id : '' }}">
                    {{-- <input type="file" name="message" id="attach_file" hidden/> --}}
                    <input type="text" class="form-control message mr-1 ml-20" name="message" id="message" placeholder="Type your message">
                    <button type="button" class="btn btn-primary send" onclick="submit_chat();;"><i class="fa fa-paper-plane-o d-lg-none"></i>   <i class="fa fa-play"></i></button>
                </form>
            </div>
        </div>
    </section>
    <!-- User Chat profile right area -->
    <div class="user-profile-sidebar">
        <header class="user-profile-header">
            <span class="close-icon">
                <i class="feather icon-x"></i>
            </span>
            <div class="header-profile-sidebar">
                <div class="avatar">
                    <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="user_avatar" height="70" width="70">
                    <span class="avatar-status-busy avatar-status-lg"></span>
                </div>
                <h4 class="chat-user-name">Felecia Rower</h4>
            </div>
        </header>
        <div class="user-profile-sidebar-area p-2">
            <h6>About</h6>
            <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop. Sweet liquorice croissant candy danish dessert icing. Cake macaroon gingerbread toffee sweet.</p>
        </div>
    </div>
</div>
<script src="{{ asset('public/app-assets/emoji/js/vanillaEmojiPicker.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script type="text/javascript">
    newSms = {{ count($chatList) }};
    // $(function(){
    // });
        $("#btnFile").click(function(){
            $("#attach_file").trigger("click");
        });
    new EmojiPicker({
        trigger: [{
                    selector: '.first-btn',
                    insertInto: ['.one', '.two'] 
                },
            ],
        closeButton: true,
            //specialButtons: green
    });
    function submit_chat() {

        var message = $("#message").val();
        // alert(message);
        var chatHeadId = $("#chat_head_id").val();
        var receverId = $("#recever_id").val();
        // var newMessage = $("#new_message").val();
       // alert(newMessage);
       // var orderId = $("#order_id").val();
        if(message != "")
        {
            var html = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
            
            $("#message").val("");
            $("#user-chats").scrollTop($("#user-chats > .chats").height());
            $.ajax({
                url: '{{route('admin.chat.submitChat')}}',
                type: 'POST',
                data: { 
                _token: '{{ csrf_token() }}',
                message:message,
                chat_head_id:chatHeadId,
                recever_id:receverId,
                new_message:newMessage
                   },
                success:function(result)
                {
                    $('#user-chats').html(result);
                }
            });
              // refreshChat();
        }   
    };
    var totalMessage = "{{ count($chatList) }}";
    var newSms = 0;
    function refreshChat(offset = 0)
    {
        var message = '';
        var chatHeadId = $("#chat_head_id").val();
        if (chatHeadId == undefined || chatHeadId == '')
        {
            chatHeadId = mainChatHeadId;
        }
        var receverId = $("#recever_id").val();
        $.ajax({
            url: '{{ route('admin.chat.submitChat') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                 message:message,
                 chat_head_id:chatHeadId,
                 recever_id:receverId,
                 // new_message:newMessage,
                 offset:offset },
            success:function(result)
            {
                $('#user-chats').html(result);
                // console.log("new-=====",totalMessage);
                if (newSms > totalMessage)
                {
                    // $( "#new_message" ).animate(
                    //    { 
                    //       color: "red"
                    //    }
                    // );
                    $( "#new_message" ).css('background-color','yellow');
                    $('#new_message').show();
                    totalMessage = newSms;
                }
            }
        });
        setTimeout(refreshChat, 2000);
    }
    refreshChat();

    function newMessage() {
        // console.log($(".user-chats").scrollTop($(".user-chats > .chats").height()));
        var chatContainer = $("#user-chats");
        chatContainer.animate({ scrollTop: chatContainer[0].scrollHeight }, 400)
        // console.log("=====",chatContainer[0].scrollHeight)
        // var top = $(".user-chats").scrollTop();
        // console.log(top)
        $('#new_message').hide();
        firstTime = 0;
    }
    var firstTime = 0;
    $("#user-chats").scroll(function(){
        // console.log($(this).scrollTop());
        currentPosition = $(this).scrollTop();
        var chatContainer = $("#user-chats");
        var scrollHeight = chatContainer[0].scrollHeight;
        var difference = scrollHeight - currentPosition;
        $( "#new_message" ).css('background-color','white');
        if (difference > 500)
        {
            $('#new_message').show();
        }
        else
        {
            $('#new_message').hide();
        }
    });
    $(".user-chats").scrollTop($(".user-chats > .chats").height());
    $(".close-user-profile").on('click',function(){
        $('.user-profile-sidebar').removeClass('show');
    });
</script>