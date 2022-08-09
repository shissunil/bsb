{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/emoji/emojis.css') }}"> --}} 
 <!-- UIkit CSS -->
{{--  <link rel="stylesheet" href="{{ asset('public/app-assets/emoji/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('public/app-assets/emoji/css/style.css') }}"> --}}

{{-- <link rel="stylesheet" href="{{ asset('public/app-assets/emoji/stylesheet.css') }}"> --}}
 <div class="content-body">
    <div class="chat-overlay"></div>
    <section class="chat-app-window">
        <div class="start-chat-area  d-none">
            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
        </div>T
        <div class="active-chat">
            <div class="chat_navbar">
                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                    <div class="vs-con-items d-flex align-items-center">
                        <div class="sidebar-profile-toggle d-block d-lg-none mr-1">
                            <i class="feather icon-menu font-large-1"></i></div>
                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                            <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />
                            <span class="avatar-status-online"></span>
                        </div>
                        <h6 class="mb-0">
                            @if($chatHeadData->hasOneEmployee)
                                {{$chatHeadData->hasoneEmployee->name}}
                            @endif
                        </h6>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger delete-record"data-action="{{ route('admin.chat.destroy',$chatHeadData->id) }}"><i class="   fa fa-trash"></i>
                    </button>
                </header>
            </div>
            <div class="user-chats ps ps--active-y" style="height:500px ! !important;" id="user-chats">
                <div class="chats">
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
            </div>
            <span id="new_message" onclick="newMessage()" style="box-sizing: 20px;background: border-box;border: 2px solid;border-radius: 50%;padding: 7px;position: relative;left: 95%;display: none;"><i class="fa fa-chevron-down"></i></span>
            <div class="chat-app-form">
                <form class="chat-app-input d-flex" onsubmit="submit_chat();" action="javascript:void(0);">
                    <input type="hidden" class="form-control message mr-1 ml-50" name="chat_head_id" id="chat_head_id" value="{{$chatHeadData->id}}">
                    <input type="hidden" class="form-control message mr-1 ml-50" name="recever_id" id="recever_id" value="{{$chatHeadData->recever_id}}">
                    <input type="file" name="message" id="attach_file" hidden/>
                    <input type="text" class="form-control message mr-1 ml-20" id="iconLeft4-1" placeholder="Type your message">
                   {{--  <div class=" fonticon-container">
                    <div class="fonticon-wrap  " id="btnFile" ><i  class="fa fa-paperclip"  ></i></div>
                    </div> --}}
                    <div data-emojiarea data-type="unicode" data-global-picker="false" >
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Attached File" class="btn btn-link text-decoration-none font-size-10 btn-lg waves-effect" id="btnFile"> <i class="fa fa-paperclip fa-lg"></i>
                            </button>&nbsp;&nbsp;
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Emoji" class=" emoji-button btn btn-link text-decoration-none  btn-lg waves-effect " id="input1" > <i class="fa fa-smile-o fa-lg"></i>
                            </button>
                           
                            <button type="submit" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light" onclick="submit_chat();">
                                                    <i class="fa fa-play"></i>
                            </button> 
                    </div>
                   {{-- <script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js"></script> --}}
                   {{--  <div class="example"> --}}
                        {{-- <h2>Unicode</h2> --}}
                       {{--  <div data-emojiarea data-type="unicode" data-global-picker="false" >
                            <div class="emoji-button font-size-16 btn-lg waves-effect"  title="Emoji"  data-bs-toggle="tooltip" data-bs-placement="top"> <i class="fa fa-smile-o fa-lg"></i></div> --}}
                       {{-- <textarea id="input1" rows="5">You can insert unicode emojis here &#x1f604;</textarea> --}}
                </form>
            </div>
        </div>
    </section>

    
    <!-- User Chat profile right area -->
        <div class="user-profile-sidebar">
                            <header class="user-profile-header">
                                <span class="close-user-profile">
                                    <i class="feather icon-x"></i>
                                </span>
                            </header>
                            <div class="user-profile-sidebar-area p-2" style="height: 100%;">
                                <h6>Participants</h6>
                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                <img src="{{ asset('public/assets/admin/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />
                                <span class="avatar-status-online"></span>
                                </div>
                                <p style="margin-bottom:2px">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}</p>
                                
                            </div>
                        </div>
    <!--/ User Chat profile right area -->
</div>
<script src="{{ asset('public/app-assets/emoji/js/jquery.emojiarea.js') }}"></script>
<script src="{{ asset('public/app-assets/emoji/js/main.js') }}"></script>
<script type="text/javascript">
    newSms = {{ count($chatList) }};
    $(function(){
        $("#btnFile").click(function()
                {
                 $("#attach_file").trigger("click");
                 });
        });
    // $('#input').on('input',function(){

    // })
</script>


















