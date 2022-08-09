@extends('admin.layout.admin')
@section('title')
Offer Management
@endsection

@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/app-assets/vendors/css/tables/datatable/datatables.min.css')  }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-chat.css') }}">
<style>
    .btn-print {
        color: #FFFFFF !important;
        background-color: #1E1E1E !important;
        border-color: #1E1E1E !important;
    }
    .offer_detail tr td {
        padding-bottom: 0px !important;
    }
    .offer_detail tr th {
        padding-bottom: 0px !important;
    }
</style>
@endsection

@section('content')

<div class="content-header row">

    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Offers</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Offer Detail
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section>
        <div class="row">
            <div class="col col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Offer Detail</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table offer_detail">
                                        <tr>
                                            <th>Material: </th>
                                            <td>{{ isset($offerData->hasOneMaterial->name) ? $offerData->hasOneMaterial->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Grade: </th>
                                            <td>{{ isset($offerData->hasOneGrade->name) ? $offerData->hasOneGrade->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Colour: </th>
                                            <td>{{ isset($offerData->hasOneColour->name) ? $offerData->hasOneColour->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Origin: </th>
                                            <td>{{ isset($offerData->hasOneCountry->name) ? $offerData->hasOneCountry->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Packaging: </th>
                                            <td>{{ isset($offerData->packaging) ? $offerData->packaging : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rate: </th>
                                            <td>{{ isset($offerData->rate) ? $offerData->rate : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country: </th>
                                            <td>{{ isset($offerData->hasOneCountry->name) ? $offerData->hasOneCountry->name : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Offer Type: </th>
                                            <td>
                                                @if (isset($offerData->offer_type) && $offerData->offer_type == '1')
                                                    CIF
                                                @elseif(isset($offerData->offer_type) && $offerData->offer_type == '2')
                                                    CNF
                                                @else
                                                    FOB
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Material Status: </th>
                                            <td>{{ isset($offerData->material_status) ? $offerData->material_status : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table offer_detail">
                                        <tr>
                                            <th>Port Of Loading: </th>
                                            <td>{{ isset($offerData->port_of_loading) ? $offerData->port_of_loading : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Loading Time: </th>
                                            <td>{{ isset($offerData->loading_time) ? $offerData->loading_time : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Material Availability: </th>
                                            <td>{{ (isset($offerData->material_availability) && $offerData->material_availability == '1') ? 'One Time' : 'Regular' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sample Availability: </th>
                                            <td>{{ (isset($offerData->sample_availability) && $offerData->sample_availability == '1') ? 'Available' : 'Un Available' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Technical date sheet: </th>
                                            <td>{{ (isset($offerData->technical_date_sheet) && $offerData->technical_date_sheet == '1') ? 'Available' : 'Un Available' }}</td>
                                        </tr>
                                        <tr>
                                            <th>K Value: </th>
                                            <td>{{ isset($offerData->k_value) ? $offerData->k_value.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Calcium: </th>
                                            <td>{{ isset($offerData->calcium) ? $offerData->calcium.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Maisture: </th>
                                            <td>{{ isset($offerData->maisture) ? $offerData->maisture.' %' : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contamination: </th>
                                            <td>{{ isset($offerData->contamination) ? $offerData->contamination.' %' : '' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" style="display:none;">
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
                                                        <h4 class="mb-0">Chat Listweqf</h4>
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
                                                                    <div class="chat-overlay"></div>
                                                                    <section class="chat-app-window">
                                                                        <div class="start-chat-area d-none">
                                                                            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                                                            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                                                                        </div>
                                                                        <div class="active-chat">
                                                                            <div class="chat_navbar">
                                                                                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                                                                    <div class="vs-con-items d-flex align-items-center">
                                                                                        <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                                                                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                                                            <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                                                                                            <span class="avatar-status-busy"></span>
                                                                                        </div>
                                                                                        <h6 class="mb-0">first name</h6>
                                                                                    </div>
                                                                                    <div class="vs-con-items d-flex align-items-center">
                                                                                        <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                                                                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">

                                                                                            <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                                                                                            <span class="avatar-status-busy"></span>
                                                                                        </div>
                                                                                        <h6 class="mb-0">Last Name</h6>
                                                                                    </div>
                                                                                    {{-- <span class="favorite"><i class="feather icon-star font-medium-5"></i></span> --}}
                                                                                </header>
                                                                            </div>
                                                                            <div class="user-chats" style="height:500px !important;">
                                                                                <div class="chats">
                                                                                    <div class="chat">
                                                                                        <div class="chat-avatar">
                                                                                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                                                                <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="chat-body">
                                                                                            <div class="chat-content">
                                                                                                <p>TEST MSG</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="chat chat-left">
                                                                                        <div class="chat-avatar">
                                                                                            <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                                                                <img src="{{ URL::asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40" />
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="chat-body">
                                                                                            <div class="chat-content">
                                                                                                <p>TEST MSG LEFT</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
                                        @if (isset($offerData->hasManyOfferMedia) && count($offerData->hasManyOfferMedia) > 0)
                                            @foreach ($offerData->hasManyOfferMedia as $offerMedia)
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
                                        @if (isset($offerData->hasManyOfferMedia) && count($offerData->hasManyOfferMedia) > 0)
                                            @foreach ($offerData->hasManyOfferMedia as $offerMedia)
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
                                        @if (isset($offerData->hasManyOfferMedia) && count($offerData->hasManyOfferMedia) > 0)
                                            @foreach ($offerData->hasManyOfferMedia as $offerMedia)
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
                                        @if (isset($offerData->hasManyOfferMedia) && count($offerData->hasManyOfferMedia) > 0)
                                            @foreach ($offerData->hasManyOfferMedia as $offerMedia)
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

@endsection