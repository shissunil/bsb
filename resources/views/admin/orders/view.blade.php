@extends('admin.layout.admin')
@section('title')
Order Management
@endsection

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/app-assets/vendors/css/tables/datatable/datatables.min.css')  }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-chat.css') }}">
<style>
    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }
    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
        display: inline-flex;
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 25%;
        float: left;
        position: relative
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f023"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: skyblue
    }
    #open_attach_model:hover{
        background: skyblue;
        color: white;
        cursor: pointer;
    }
</style>
@endsection

@section('content')

<div class="content-header row">

    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Orders</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Order Detail
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body chat-application">
    <section>
        <div class="row">
            <div class="col col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Detail</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table offer_detail">
                                        <tr>
                                            <th>Offer Code: </th>
                                            <td>{{ isset($orderData->offer_code) ? $orderData->offer_code : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Material: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneMaterial->name) ? $orderData->hasOneOffer->hasOneMaterial->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Grade: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneGrade->name) ? $orderData->hasOneOffer->hasOneGrade->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Colour: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneColour->name) ? $orderData->hasOneOffer->hasOneColour->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Origin: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneCountry->name) ? $orderData->hasOneOffer->hasOneCountry->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Packaging: </th>
                                            <td>{{ isset($orderData->hasOneOffer->packaging) ? $orderData->hasOneOffer->packaging : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rate: </th>
                                            <td>{{ isset($orderData->hasOneOffer->rate) ? $orderData->hasOneOffer->rate.' '. $orderData->hasOneOffer->hasOneCurency->name  : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneCountry->name) ? $orderData->hasOneOffer->hasOneCountry->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Offer Type: </th>
                                            <td>
                                                @if (isset($orderData->hasOneOffer->offer_type) && $orderData->hasOneOffer->offer_type == '1')
                                                    CIF
                                                @elseif(isset($orderData->hasOneOffer->offer_type) && $orderData->hasOneOffer->offer_type == '2')
                                                    CNF
                                                @else
                                                    FOB
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Material Status: </th>
                                            <td>{{ isset($orderData->hasOneOffer->material_status) ? $orderData->hasOneOffer->material_status : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Buyer Name: </th>
                                            <td>{{ isset($orderData->hasOneUser->name) ? $orderData->hasOneUser->name : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table offer_detail">
                                        <tr>
                                            <th>Port Of Loading: </th>
                                            <td>{{ isset($orderData->hasOneOffer->port_of_loading) ? $orderData->hasOneOffer->port_of_loading : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Loading Time: </th>
                                            <td>{{ isset($orderData->hasOneOffer->loading_time) ? $orderData->hasOneOffer->loading_time : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Material Availability: </th>
                                            <td>{{ (isset($orderData->hasOneOffer->material_availability) && $orderData->hasOneOffer->material_availability == '1') ? 'One Time' : 'Regular' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sample Availability: </th>
                                            <td>{{ (isset($orderData->hasOneOffer->sample_availability) && $orderData->hasOneOffer->sample_availability == '1') ? 'Available' : 'Un Available' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Technical date sheet: </th>
                                            <td>{{ (isset($orderData->hasOneOffer->technical_date_sheet) && $orderData->hasOneOffer->technical_date_sheet == '1') ? 'Available' : 'Un Available' }}</td>
                                        </tr>
                                        <tr>
                                            <th>K Value: </th>
                                            <td>{{ isset($orderData->hasOneOffer->k_value) ? $orderData->hasOneOffer->k_value.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Calcium: </th>
                                            <td>{{ isset($orderData->hasOneOffer->calcium) ? $orderData->hasOneOffer->calcium.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Maisture: </th>
                                            <td>{{ isset($orderData->hasOneOffer->maisture) ? $orderData->hasOneOffer->maisture.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contamination: </th>
                                            <td>{{ isset($orderData->hasOneOffer->contamination) ? $orderData->hasOneOffer->contamination.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Order Status: </th>
                                            <td>
                                                @if ($orderData->status == '1')
                                                    <p class="badge badge-pill badge-light-primary">On Hold</p>
                                                @elseif($orderData->status == '2')
                                                    <p class="badge badge-pill badge-light-info">Confirmed</p>
                                                @elseif($orderData->status == '3')
                                                    <p class="badge badge-pill badge-light-warning">Cancelled</p>
                                                @elseif($orderData->status == '4')
                                                    <p class="badge badge-pill badge-light-danger">Rejected</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Seller Name: </th>
                                            <td>{{ isset($orderData->hasOneOffer->hasOneUser->name) ? $orderData->hasOneOffer->hasOneUser->name : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role_id == '1' || isset(Auth::user()->hasOneAssignEmployee))
            <div class="col col-md-12 col-12">
                <div class="card">
                    <div class="card-header border-bottom mx-2 px-0">
                        <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Chat History
                        </h6>
                    </div>
                    <div class="card-body px-75">
                        <section id="dashboard-analytics" class="vertical-layout vertical-menu-modern content-left-sidebar chat-application navbar-floating footer-static">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <div class="col col-md-10">
                                                        <h4 class="mb-0">Chat List</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body card-dashboard">
                                                <div class="app-content content" style="margin-left: 0px;">
                                                    <div class="content-overlay"></div>
                                                    <div class="header-navbar-shadow"></div>
                                                    <div class="">
                                                        <div class="">
                                                            <div class="content-wrapper" style="margin-top: 0px;">
                                                                <div class="content-header row">
                                                                </div>
                                                                <div class="content-body">
                                                                    <p class="user-profile-toggle" style="cursor:pointer;">{!! isset($orderData->hasOneOffer->hasOneMaterial->name) ? '<b>Material Name: </b>'.$orderData->hasOneOffer->hasOneMaterial->name : '' !!}</p>
                                                                    <div class="chat-overlay"></div>
                                                                    <section class="chat-app-window">
                                                                        <div class="start-chat-area d-none">
                                                                            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                                                            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                                                                        </div>
                                                                        <div class="active-chat">
                                                                            <div class="chat_navbar">
                                                                            </div>
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
                                                                            <span id="new_message" onclick="newMessage()" style="box-sizing: 20px;background: border-box;border: 2px solid;border-radius: 50%;padding: 7px;position: relative;left: 95%;display: none;"><i class="fa fa-chevron-down"></i></span>
<div class="chat-app-form">
    <img src="" id="attach_preview" height="100px" width="100px" style="display:none;">
    <form class="chat-app-input d-flex" onsubmit="submit_chat();" action="javascript:void(0);">
        <input type="hidden" name="chat_head_id" id="chat_head_id" value="{{ isset($chatHeadData->id) ? $chatHeadData->id : '' }}">
        <input type="hidden" name="order_id" id="order_id" value="{{ isset($orderData->id) ? $orderData->id : '' }}">
        <input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1" placeholder="Type your message">
        <input type="file" name="attach_file" id="attach_file" style="display: none;">
        <span onclick="openUpload()" title="Attach" class="open_attach_model" id="open_attach_model" style="margin-right: 10px; border: 1px solid; border-radius: 50%; line-height: 30px; width: 46px; height: 41px;display: none;"><i class="fa fa-paperclip" style="font-size:27px; line-height: 39px; margin-left: 7px;"></i></span>
        <input type="button" name="button" class="btn btn-primary send" onclick="submit_chat();" value="Send">
    </form>
</div>

                                                                        </div>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                <p style="margin-bottom:2px">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}</p>
                                @if (count($assignEmployeeList) > 0)
                                    @foreach ($assignEmployeeList as $employee)
                                        @if (Auth::id() != $employee->user_id)
                                            <p style="margin-bottom:2px">{{ isset($employee->hasOneUser->name) ? $employee->hasOneUser->name : '' }}</p>
                                        @endif
                                    @endforeach
                                @endif
                                <p style="margin-bottom:2px">{{ isset($orderData->hasOneUser->name) ? $orderData->hasOneUser->name : '' }}</p>
                                <p style="margin-bottom:2px">{{ isset($orderData->hasOneOffer->hasOneUser->name) ? $orderData->hasOneOffer->hasOneUser->name : ''}}</p>
                            </div>
                        </div>
                        <!--/ User Chat profile right area -->
                    </div>
                </div>
            </div>
            @endif
            @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
                <div class="col col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Assigned Employees</h4>
                            @if(Auth()->user()->permissions->contains('name','admin.assignEmployee.employee') )
                                <button class="btn-icon btn btn-primary  waves-effect waves-light" type="button" data-toggle="modal" data-target="#assign_employee_modal" aria-haspopup="true" aria-expanded="false"><i class="feather icon-plus"> Add </i></button>
                            @endif
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataex-html5-selectors_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                @if(Auth()->user()->permissions->contains('name','admin.assignEmployee.destroy') )
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($assignEmployeeList) > 0)
                                                @foreach ($assignEmployeeList as $employee)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ isset($employee->hasOneUser->name) ? $employee->hasOneUser->name : '' }}</td>
                                                        @if( Auth()->user()->permissions->contains('name','admin.assignEmployee.destroy'))
                                                            <td>
                                                                @if(Auth()->user()->permissions->contains('name','admin.assignEmployee.destroy'))
                                                                    <button type="button" class="btn btn-sm btn-danger delete-record"
                                                                        data-action="{{ route('admin.assignEmployee.destroy',$employee->id) }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Process Tracking</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="#" class="icons-tab-steps wizard-circle" id="msform">
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>Offer Status Accepted</strong></li>
                                    <li class="active" id="personal"><strong>Offer Accepted</strong></li>
                                    <li id="payment"><strong>Proforma issued by supplier</strong></li>
                                    <li id="confirm"><strong>30% advance payment against proforma invoice</strong></li>
                                    <li id="confirm"><strong>manufaturer</strong></li>
                                    <li id="confirm"><strong>Port Of Loading ETD: 29/04/2022 ETA: 29/04/2022</strong></li>
                                    <li id="confirm"><strong>On Board / sailing</strong></li>
                                    <li id="confirm"><strong>On Board / sailing</strong></li>
                                    <li id="confirm"><strong>Port Of discharge ETD: 29/04/2022 ETA: 29/04/2022</strong></li>
                                </ul>
                            </form>
                            {{-- <div class="row">
                                <div class="col-12">    
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="nav-justified">
        <div class="row">
            <div class="col-sm-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <h4 class="card-title">Offer Media</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="materilal_photos" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true">Material Photo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sample_photos" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="true">Sample Photo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="loading_photos" data-toggle="tab" href="#messages-just" role="tab" aria-controls="messages-just" aria-selected="false">Loading Photo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="invoice" data-toggle="tab" href="#settings-just" role="tab" aria-controls="settings-just" aria-selected="false">Invoice</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content pt-1">
                                <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="materilal_photos" style="height:300px !important; overflow: auto;">
                                    <div class="row">
                                        @if (isset($orderData->hasOneOffer->hasManyOfferMedia) && count($orderData->hasOneOffer->hasManyOfferMedia) > 0)
                                            @foreach ($orderData->hasOneOffer->hasManyOfferMedia as $offerMedia)
                                                @if ($offerMedia->media_type == '1')
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/uploads/offerMedia/'.$offerMedia->media_name) }}" class="img-thumbnail">
                                                        <label class="font-weight-bold"><a href="{{ route('admin.offers.download',$offerMedia->media_name) }}">{{ $offerMedia->media_title }}</a></label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="sample_photos" style="height:300px !important; overflow: auto;">
                                    <div class="row">
                                        @if (isset($orderData->hasOneOffer->hasManyOfferMedia) && count($orderData->hasOneOffer->hasManyOfferMedia) > 0)
                                            @foreach ($orderData->hasOneOffer->hasManyOfferMedia as $offerMedia)
                                                @if ($offerMedia->media_type == '2')
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/uploads/offerMedia/'.$offerMedia->media_name) }}">
                                                        <label class="font-weight-bold"><a href="{{ route('admin.offers.download',$offerMedia->media_name) }}">{{ $offerMedia->media_title }}</a></label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages-just" role="tabpanel" aria-labelledby="loading_photos" style="height:300px !important; overflow: auto;">
                                    <div class="row">
                                        @if (isset($orderData->hasOneOffer->hasManyOfferMedia) && count($orderData->hasOneOffer->hasManyOfferMedia) > 0)
                                            @foreach ($orderData->hasOneOffer->hasManyOfferMedia as $offerMedia)
                                                @if ($offerMedia->media_type == '3')
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/uploads/offerMedia/'.$offerMedia->media_name) }}">
                                                        <label class="font-weight-bold"><a href="{{ route('admin.offers.download',$offerMedia->media_name) }}">{{ $offerMedia->media_title }}</a></label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings-just" role="tabpanel" aria-labelledby="invoice" style="height:300px !important; overflow: auto;">
                                    <div class="row">
                                        @if (isset($orderData->hasOneOffer->hasManyOfferMedia) && count($orderData->hasOneOffer->hasManyOfferMedia) > 0)
                                            @foreach ($orderData->hasOneOffer->hasManyOfferMedia as $offerMedia)
                                                @if ($offerMedia->media_type == '4')
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/uploads/offerMedia/'.$offerMedia->media_name) }}">
                                                        <label class="font-weight-bold"><a href="{{ route('admin.offers.download',$offerMedia->media_name) }}">{{ $offerMedia->media_title }}</a></label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- modal for assign employee --}}
<div class="modal fade text-left" id="assign_employee_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Assign Employee </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.assignEmployee.employee') }}" id="model_form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Select Employee </label>
                    <div class="form-group">
                        <input type="hidden" name="order_id" value="{{ $orderData->id }}">
                        <select class="select2 form-control" name="employee[]">
                            @if (count($employeeList) > 0)
                                @foreach ($employeeList as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="save" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end assign employee modal --}}
@endsection

@section('footer')
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/app-assets/js/scripts/datatables/datatable.js') }}"></script>
<script src="{{ asset('public/app-assets/js/scripts/pages/app-chat.js') }}"></script>
<script type="text/javascript">
    function submit_chat(source) {
        var message = $(".message").val();
        var chatHeadId = $("#chat_head_id").val();
        var orderId = $("#order_id").val();
        if(message != ""){
            var html = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
            // $(".chat:last-child .chat-body").append(html);
            $(".message").val("");
            $(".user-chats").scrollTop($(".user-chats > .chats").height());

            $.ajax({
                url: '{{ route('admin.orders.submitChat') }}',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}', message:message,chat_head_id:chatHeadId,order_id:orderId },
                success:function(result)
                {
                    $('#user-chats').html(result);
                }
            });

        }
        
    }
    var totalMessage = "{{ count($chatList) }}";
    // console.log(totalMessage);
    function refreshChat(offset = 0)
    {
        var message = '';
        var chatHeadId = '';
        var orderId = $("#order_id").val();

        $.ajax({
            url: '{{ route('admin.orders.submitChat') }}',
            type: 'POST',
            data: { _token: '{{ csrf_token() }}', message:message,chat_head_id:chatHeadId,order_id:orderId,offset:offset },
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
    $(".close-user-profile").on('click',function(){
        $('.user-profile-sidebar').removeClass('show');
    });
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