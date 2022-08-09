@extends('admin.layout.admin')

@section('title')
Dashboard
@endsection

@section('content')

<div class="content-header row">

    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>                       
                        <li class="breadcrumb-item active">Dashboard
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <a href="{{-- {{ route('admin.setting.index') }} --}}"><button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light"
                    type="button">
                    <i class="feather icon-settings"></i>
                </button></a>
            </div>
        </div>
    </div>
</div>

<div class="content-body">

    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-12">
                <h3>Total Statistics</h3>
            </div>
        </div>
	        <div class="row">
        		@if (Auth::user()->role_id != '4')
		            <div class="col-lg-3 col-sm-6 col-12">
		                <a href="#">
		                    <div class="card">
		                        <div class="card-header d-flex align-items-start pb-0">
		                            <div>
		                                <h2 class="text-bold-700" style="margin-top: 10px;">10</h2>
		                            </div>
		                            <div class="avatar bg-rgba-danger p-50 m-0">
		                                <div class="avatar-content">
		                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
		                                </div>
		                            </div>
		                        </div>
		                        <br/>
		                        <div>
		                            <p>&nbsp;&nbsp;&nbsp;Total Stock in House</p>
		                        </div>
		                    </div>
		                </a>
		            </div>
		            <div class="col-lg-3 col-sm-6 col-12">
		                <a href="#">
		                    <div class="card">
		                        <div class="card-header d-flex align-items-start pb-0">
		                            <div>
		                                <h2 class="text-bold-700" style="margin-top: 10px;">10</h2>
		                            </div>
		                            <div class="avatar bg-rgba-danger p-50 m-0">
		                                <div class="avatar-content">
		                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
		                                </div>
		                            </div>
		                        </div>
		                        <br/>
		                        <div>
		                            <p>&nbsp;&nbsp;&nbsp;Total Stock in Market</p>
		                        </div>
		                    </div>
		                </a>
		            </div>
		            <div class="col-lg-3 col-sm-6 col-12">
		                <a href="#">
		                    <div class="card">
		                        <div class="card-header d-flex align-items-start pb-0">
		                            <div>
		                                <h2 class="text-bold-700" style="margin-top: 10px;">10</h2>
		                            </div>
		                            <div class="avatar bg-rgba-danger p-50 m-0">
		                                <div class="avatar-content">
		                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
		                                </div>
		                            </div>
		                        </div>
		                        <br/>
		                        <div>
		                            <p>&nbsp;&nbsp;&nbsp;Total Reginal Manager</p>
		                        </div>
		                    </div>
		                </a>
		            </div>
        		@endif
        		@if (Auth::user()->role_id != '4' && Auth::user()->role_id != '3')
		        	<div class="col-lg-3 col-sm-6 col-12">
		                <a href="#">
		                    <div class="card">
		                        <div class="card-header d-flex align-items-start pb-0">
		                            <div>
		                                <h2 class="text-bold-700" style="margin-top: 10px;">10</h2>
		                            </div>
		                            <div class="avatar bg-rgba-danger p-50 m-0">
		                                <div class="avatar-content">
		                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
		                                </div>
		                            </div>
		                        </div>
		                        <br/>
		                        <div>
		                            <p>&nbsp;&nbsp;&nbsp;Total Area Manager</p>
		                        </div>
		                    </div>
		                </a>
		            </div>
        		@endif
	        </div>
	        <div class="row">
	        	@if (Auth::user()->role_id != '4')
		        	<div class="col-lg-3 col-sm-6 col-12">
			                <a href="#">
			                    <div class="card">
			                        <div class="card-header d-flex align-items-start pb-0">
			                            <div>
			                                <h2 class="text-bold-700" style="margin-top: 10px;">10</h2>
			                            </div>
			                            <div class="avatar bg-rgba-danger p-50 m-0">
			                                <div class="avatar-content">
			                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
			                                </div>
			                            </div>
			                        </div>
			                        <br/>
			                        <div>
			                            <p>&nbsp;&nbsp;&nbsp;Total Clients</p>
			                        </div>
			                    </div>
			                </a>
			            </div>
			        </div>
	        	@endif
	        	@if (Auth::user()->role_id == '4')
		        	<div class="col-lg-3 col-sm-6 col-12">
			                <a href="#">
			                    <div class="card">
			                        <div class="card-header d-flex align-items-start pb-0">
			                            <div>
			                                <h2 class="text-bold-700" style="margin-top: 10px;">1000</h2>
			                            </div>
			                            <div class="avatar bg-rgba-danger p-50 m-0">
			                                <div class="avatar-content">
			                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
			                                </div>
			                            </div>
			                        </div>
			                        <br/>
			                        <div>
			                            <p>&nbsp;&nbsp;&nbsp;Total Purchase Stock</p>
			                        </div>
			                    </div>
			                </a>
			            </div>
			        </div>
			        <div class="col-lg-3 col-sm-6 col-12">
			                <a href="#">
			                    <div class="card">
			                        <div class="card-header d-flex align-items-start pb-0">
			                            <div>
			                                <h2 class="text-bold-700" style="margin-top: 10px;">1000</h2>
			                            </div>
			                            <div class="avatar bg-rgba-danger p-50 m-0">
			                                <div class="avatar-content">
			                                    <i class="fa fa-shopping-cart text-danger font-medium-5"></i>
			                                </div>
			                            </div>
			                        </div>
			                        <br/>
			                        <div>
			                            <p>&nbsp;&nbsp;&nbsp;Total Sell Stock</p>
			                        </div>
			                    </div>
			                </a>
			            </div>
			        </div>
	        	@endif
	        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
</div>

@endsection

@section('footer')
<script src="{{ asset('assets/admin/app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
@endsection