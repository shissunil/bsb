@extends('admin.layout.admin')
@section('title')
Final Chat 
@endsection

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
                                    <button type="submit" class="btn btn-primary float-right"  value="submit">Chat Start</button>
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
                    <h3 class="primary p-1 mb-0">Chats 
                        <div class="sidebar-profile-toggle position-relative d-inline-flex " style="float: right;"><i class="feather icon-user-plus"></i></div> 
                    </h3>
                    <ul class="chat-users-list-wrapper media-list">
                        @foreach($groupChat as $groupChat) 
                        <li onclick="openChat({{ $groupChat->id }})">
                            <div class="pr-1">
                                <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-3.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                    <i></i>
                                </span>
                            </div>
                            <div class="user-chat-info">
                                <div class="contact-info"@if($groupChat->hasOneOfferCode) id="{{$groupChat->order_id}}"@endif>
                                    <h5 class="font-weight-bold mb-0">
                                        @if($groupChat->hasOneOfferCode)
                                            {{$groupChat->hasOneOfferCode->offer_code}}
                                        @endif</h5>
                                    <p class="truncate">
                                        @if($groupChat->hasOneMassage)
                                            {{$groupChat->hasOneMassage->message}}
                                        @endif
                                    </p>
                                </div>
                                <div class="contact-meta">
                                    <span class="float-right mb-25">
                                        @if($groupChat->hasOneMassage)
                                            {{$groupChat->hasOneMassage->created_at->format('h:i A', strtotime($groupChat->hasOneMassage->created_at))}}
                                        @endif
                                    </span>
                                    {{-- <span class="badge badge-primary badge-pill float-right">3</span> --}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h3 class="primary p-1 mb-0">Contacts</h3>
                    <ul class="chat-users-list-wrapper media-list">
                        @foreach($chatHeads as $chat)
                            <li onclick="openChat({{ $chat->id }})">
                                <div class="pr-1">
                                    <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-3.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                        <i></i>
                                    </span>
                                </div>
                                <div class="user-chat-info">
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
                                        </p>
                                    </div>
                                    <div class="contact-meta">
                                        <span class="float-right mb-25">
                                            @if($chat->hasOneMassage)
                                                {{$chat->hasOneMassage->created_at->format('h:i A', strtotime($chat->hasOneMassage->created_at))}}
                                            @endif
                                        </span>
                                        {{-- <span class="badge badge-primary badge-pill float-right">3</span> --}}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--/ Chat Sidebar area -->

        </div>
    </div>
    <div class="content-right">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" id="chat_list">
                <div class="chat-overlay"></div>
                <section class="chat-app-window">
                    <div class="start-chat-area ">
                        <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                        <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                    </div>
                   {{--  <div class="active-chat d-none">
                        <div class="chat_navbar">
                            <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                <div class="vs-con-items d-flex align-items-center">
                                    <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                    <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                        <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />
                                        <span class="avatar-status-busy"></span>
                                    </div>
                                    <h6 class="mb-0">Felecia Rower</h6>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger delete-record"data-action=""><i class="   fa fa-trash"></i>
                                </button>
                            </header>
                        </div>
                        <div class="user-chats">
                            <div class="chats">
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>How can we help? We're here for you!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>Hey John, I am looking for the best admin template.</p>
                                            <p>Could you please help me to find it out?</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>It should be Bootstrap 4 compatible.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div class="divider-text">Yesterday</div>
                                </div>
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>Absolutely!</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>Vuexy admin is the responsive bootstrap 4 admin template.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>Looks clean and fresh UI.</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>It's perfect for my next project.</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>How can I purchase it?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>Thanks, from ThemeForest.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>I will purchase it for sure.</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>Thanks.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            <p>Great, Feel free to get in touch on</p>
                                        </div>
                                        <div class="chat-content">
                                            <p>https://pixinvent.ticksy.com/</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-app-form">
                            <form class="chat-app-input d-flex" onsubmit="enter_chat();" action="javascript:void(0);">
                                <input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1" placeholder="Type your message">
                                <button type="button" class="btn btn-primary send" onclick="enter_chat();"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Send</span></button>
                            </form>
                        </div>
                    </div> --}}
                </section>
                <!-- User Chat profile right area -->
               {{--  <div class="user-profile-sidebar">
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
                </div> --}}
                <!--/ User Chat profile right area -->
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script src="{{ asset('public/app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script>
    var mainChatHeadId = 0;
    function openChat(id)
    {    //alert(id);
        mainChatHeadId = id;
        var route = "{{route('admin.chat.showMessage')}}";
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
        // refreshChat();
    };
       

    
    
</script>
@endsection