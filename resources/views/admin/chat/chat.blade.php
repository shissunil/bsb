@extends('admin.layout.admin')

@section('title')
 Chat History
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> --}}
{{-- <script src="{{ asset('public/app-assets/emoji/js/jquery.emojiarea.js') }}"></script>
<script src="{{ asset('public/app-assets/emoji/js/main.js') }}"></script> --}}
{{-- <script type="text/javascript">
        google_ad_client = "ca-pub-2783044520727903";
        /* jQuery_demo */
        google_ad_slot = "2780937993";
        google_ad_width = 728;
        google_ad_height = 90;

</script> --}}
@section('content')
    <div class="sidebar-left">
        <div class="sidebar">
            <!-- User Chat profile area -->
          <div class="chat-profile-sidebar">
                <header class="chat-profile-header">
                    <span class="close-icon">
                        <i class="feather icon-x"></i>
                    </span>
                    <div class="header-profile-sidebar">
                        <div class="avatar">
                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="user_avatar" height="70" width="70">
                            <span class="avatar-status-online avatar-status-lg"></span>
                        </div>
                        <h4 class="chat-user-name">John Doe</h4>
                    </div>
                </header>
                <div class="profile-sidebar-area">
                    <div class="scroll-area">
                        <div class="about-user">
                            <form method="post" action="{{ route('admin.chat.store') }}" id="export_type_form"
                                enctype="multipart/form-data">
                                @csrf
                                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="Employee" class="mb-1">Employee Name <span class="text-danger h6">*</span></label>
                                                <select class="select2 form-control select2-hidden-accessible @error('name') is-invalid @enderror"
                                                    name="name" id="name" >
                                                    <option value="">Select Employee Name</option>
                                                        @foreach ($user as $user)
                                                            <option value="{{$user->id}}">
                                                                {{$user->name}}
                                                            </option> 
                                                        @endforeach 
                                                </select>
                                            </fieldset>
                                        </div>
                              
                                <div class="col-xl-8 col-md-6 col-12 mb-1">
                                    <button type="submit" class="btn btn-primary float-right" value="submit">Chat Start</button>
                                </div>
                            </form>
                        </div>
                       
                       
                    </div>
                </div>
          </div>
            <!--/ User Chat profile area -->
            <!-- Chat Sidebar area -->
            <div class="sidebar-content card">
                <span class="sidebar-close-icon">
                    <i class="feather icon-x"></i>
                </span>
                <div class="chat-fixed-search">
                    <div class="d-flex align-items-center">
                        <div class="sidebar--toggle position-relative d-inline-flex">
                            <div class="avatar">
                                <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="user_avatar" height="40" width="40">
                                <span class="avatar-status-online"></span>
                            </div>
                            <div class="bullet-success bullet-sm position-absolute"></div>
                        </div>
                        <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                            <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chat">
                            <div class="form-control-position">
                                <i class="feather icon-search"></i>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div id="users-list" class="chat-user-list list-group position-relative">
                    <h3 class="primary p-1 mb-0">Chats</h3>
                    <ul class="chat-users-list-wrapper media-list">
                        @foreach($groupChat as $groupChat)
                        <li onclick="openChat({{$groupChat->id}})">
                            <div class="pr-1">
                                <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-3.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                    <i></i>
                                </span>
                            </div>
                            <div class="user-chat-info">
                                <div class="contact-info"@if($groupChat->hasOneOffer) id="{{$groupChat->order_id}}"@endif>
                                    <h5 class="font-weight-bold mb-0">
                                        @if($groupChat->hasOneOffer)
                                            {{$groupChat->hasOneOffer->hasOneMaterial->name}}
                                        @endif
                                    </h5>
                                   <p class="truncate">Last Massage  &nbsp;&nbsp;<b></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{-- <a class="feather icon-trash-2 text-danger" style=" width:30px; height:40px;" href="{{ route('admin.chat.destroy',$groupChat->id) }}"> --}}
            
                                    </a>
                                        </p>
                                </div>
                                <div class="contact-meta">
                                    <span class="float-right mb-25">4:14 PM</span>
                                    <span class="badge badge-primary badge-pill float-right">3</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h3 class="primary p-1 mb-0">Contacts &nbsp;&nbsp;&nbsp;   
                      <div class="sidebar-profile-toggle position-relative d-inline-flex "><i class="fa fa-plus"></i></div>   
                    </h3>
                    <ul class="chat-users-list-wrapper media-list">
                        @foreach($chatHeads as $chat)
                        {{-- @foreach($lastMassage as $lastMassage) --}}
                           <li onclick="openChat({{ $chat->id }})">
                                <div class="pr-1">
                                    <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-7.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                        <i></i>
                                    </span>
                                </div>
                                <div class="user-chat-info ">
                                    <div class="contact-info"  @if($chat->hasOneEmployee) id="{{$chat->hasOneEmployee->recever_id}}" @endif>
                                        <h5 class="font-weight-bold mb-0">
                                            @if($chat->hasOneEmployee)
                                                {{$chat->hasOneEmployee->name}}
                                            @endif
                                        </h5>
                                       <p class="truncate">
                                        @if($chat->hasOneMassage)
                                            {{$chat->hasOneMassage->message}}
                                        @endif
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
                                            @if($chat->hasOneMassage)
                                                {{$chat->hasOneMassage->created_at->format('h:i')}}
                                            @endif
                                        </b>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="badge badge-primary badge-pill float-right">3</span>
                                        </p>
                                    </div>
                                </div>
                           </li>
                            {{-- @endforeach --}}
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="content-right">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" id="chat_list">

                <p class="user-profile-toggle" style="cursor:pointer;">{{-- {!! isset($orderData->hasOneOffer->hasOneMaterial->name) ? '<b>Material Name: </b>'.$orderData->hasOneOffer->hasOneMaterial->name : '' !!} --}}</p>
                <div class="chat-overlay"></div>
                <section class="chat-app-window">
                    <div class="start-chat-area">
                        <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                        <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                    </div>
                    
                </section>
                    
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" id="chat_list">
                <div class="chat-overlay"></div>
                <section class="chat-app-window">
                   
                </section>
            </div>
        </div>
    </div> --}}
@endsection
@section('footer')
<script src="{{ asset('public/app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script> 
    var mainChatHeadId = 0;
    function openChat(id)
    {
        mainChatHeadId = id;
        var route = "{{route('admin.chat.getMessage')}}";
        $.ajax({
            url : route,
            type : "POST",
            data : {
                chat_head_id : id,
                _token : '{{csrf_token()}}'
                },
            success: function(result){
                $('#chat_list').html(result);
            }
        });
        refreshChat();
    };
    function submit_chat() {

        var message = $("#iconLeft4-1").val();
        // alert(message);
        var chatHeadId = $("#chat_head_id").val();
        var receverId = $("#recever_id").val();

        var newMessage = $("#new_message").val();
       // alert(newMessage);
       // var orderId = $("#order_id").val();
        if(message != "")
        {
            var html = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
            
            $(".message").val("");
            $(".user-chats").scrollTop($(".user-chats > .chats").height());
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
             refreshChat();
        }   
    };

    var totalMessage = "{{ count($chatHeads) }}";
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
                 new_message:newMessage,
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
    // refreshChat();
      function newMessage() {
        // console.log($(".user-chats").scrollTop($(".user-chats > .chats").height()));
        var chatContainer = $(".user-chats");
        chatContainer.animate({ scrollTop: chatContainer[0].scrollHeight }, 400)
        // console.log("=====",chatContainer[0].scrollHeight)
        // var top = $(".user-chats").scrollTop();
        // console.log(top)
        $('#new_message').hide();
        firstTime = 0;
    }
    var firstTime = 0;
    $(".user-chats").scroll(function(){
        // console.log($(this).scrollTop());
        currentPosition = $(this).scrollTop();
        var chatContainer = $(".user-chats");
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
    // $(".close-user-profile").on('click',function(){
    //     $('.user-profile-sidebar').removeClass('show');
    // });
    function openUpload() {
        $('#attach_file').trigger('click');
    }
    $("#attach_file").on('change',function()
    {
        const preview = document.getElementById('attach_preview');

        const file = this.files[0]; 
        const reader = new FileReader();
        reader.addEventListener("load", function () {
            // convert image file to base64 string
            console.log(reader)
            preview.src = reader.result;
        }, false);
        if (file) {
            reader.readAsDataURL(file);
        }
        $('#attach_preview').show();
    });
</script>
@endsection
