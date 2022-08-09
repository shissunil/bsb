<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{-- <div class="brand-logo"></div> --}}
                    <h2 class="brand-logo mb-0 p-0"><img src="{{ asset('public/assets/admin/app-assets/images/logo/logo.png') }}" height="26px" width="33px"></h2>
                    <h2 class="brand-text mb-0">
                        {{config('app.name', 'Laravel')}}
                    </h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" data-placement="right"
                    data-original-title="Dashboard">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            @if(Auth()->user()->permissions->contains('name','admin.sub_admins.index'))
                <li class="nav-item {{ (Request::segment(2) == 'sub-admins') ? 'active' : '' }}">
                    <a href="{{ route('admin.sub_admins.index') }}" data-toggle="tooltip" data-placement="right" data-original-title="Sub Admin Management">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Sub Admin Management">Sub Admin Management</span>
                    </a>
                </li>
            @endif
            @if(Auth()->user()->permissions->contains('name','admin.buyer.index'))
                <li class="nav-item {{ (Request::segment(2) == 'Buyer') ? 'active' : '' }}">
                    <a href="{{ route('admin.buyer.index') }}" data-toggle="tooltip" data-placement="right" data-original-title="Buyer Management">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Buyer Management">Buyer Management</span>
                    </a>
                </li>
            @endif
            @if(Auth()->user()->permissions->contains('name','admin.seller.index'))
                <li class="nav-item {{ (Request::segment(2) == 'Seller') ? 'active' : '' }}">
                    <a href="{{ route('admin.seller.index') }}" data-toggle="tooltip" data-placement="right" data-original-title="Seller Management">
                        <i class="feather icon-users"></i>
                        <span class="menu-title" data-i18n="Seller Management">Seller Management</span>
                    </a>
                </li>
            @endif
            <li class=" nav-item"><a href="#"><i class="feather icon-database"></i><span class="menu-title" data-i18n="Masters">Masters</span></a>
                <ul class="menu-content">
                    @if(Auth()->user()->permissions->contains('name','admin.roles.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'Roles') ? 'active' : '' }}" style="display:none;">
                            <a href="{{ route('admin.roles.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Sub Admin Roles">
                                <i class="feather icon-type"></i>
                                <span class="menu-title" data-i18n="Sub Admin Roles">Sub Admin Roles</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.exportType.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'exportType') ? 'active' : '' }}">
                            <a href="{{ route('admin.exportType.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Export Type">
                                <i class="feather icon-type"></i>
                                <span class="menu-title" data-i18n="Export Type">Export Type</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.userType.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'userType') ? 'active' : '' }}">
                            <a href="{{ route('admin.userType.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="User Type">
                                <i class="feather icon-user"></i>
                                <span class="menu-title" data-i18n="User Type">User Type</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.dealType.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'dealType') ? 'active' : '' }}">
                            <a href="{{ route('admin.dealType.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Deal Type">
                                <i class="feather icon-check-square"></i>
                                <span class="menu-title" data-i18n="Deal Type">Deal Type</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.exportCapacity.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'exportCapacity') ? 'active' : '' }}">
                            <a href="{{ route('admin.exportCapacity.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Export Capacity">
                                <i class="feather icon-trending-up"></i>
                                <span class="menu-title" data-i18n="Export Capacity">Export Capacity</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.document.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'document') ? 'active' : '' }}">
                            <a href="{{ route('admin.document.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Document Master">
                                <i class="feather icon-file-text"></i>
                                <span class="menu-title" data-i18n="Document Master">Document Master</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.material.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'material') ? 'active' : '' }}">
                            <a href="{{ route('admin.material.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Material Master">
                                <i class="feather icon-shopping-cart"></i>
                                <span class="menu-title" data-i18n="Material Master">Material Master</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.grade.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'grade') ? 'active' : '' }}">
                            <a href="{{ route('admin.grade.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Grade Master">
                                <i class="feather icon-percent"></i>
                                <span class="menu-title" data-i18n="Grade Master">Grade Master</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.currency.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'currency') ? 'active' : '' }}">
                            <a href="{{ route('admin.currency.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Currency Master">
                                <i class="feather icon-zap"></i>
                                <span class="menu-title" data-i18n="Currency Master">Currency Master</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.colour.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'colour') ? 'active' : '' }}">
                            <a href="{{ route('admin.colour.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Colour Master">
                                <i class="feather icon-droplet"></i>
                                <span class="menu-title" data-i18n="Colour Master">Colour Master</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth()->user()->permissions->contains('name','admin.paymentTerms.index'))
                        <li class="nav-item {{ (Request::segment(2) == 'paymentTerms') ? 'active' : '' }}">
                            <a href="{{ route('admin.paymentTerms.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Payment terms">
                                <i class="feather icon-file-text"></i>
                                <span class="menu-title" data-i18n="Payment terms">Payment terms</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

             <li class=" nav-item"><a href="#"><i class="feather icon-gift"></i><span class="menu-title" data-i18n="Masters">Offers</span></a>
                <ul class="menu-content">
                    @if(Auth()->user()->permissions->contains('name','admin.offers.index'))
                           <li class="nav-item {{ (Request::segment(2) == 'offers') ? 'active' : '' }}">
                            <a href="{{ route('admin.offers.index') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Seller Offers">
                                <i class="feather icon-gift"></i>
                                <span class="menu-title" data-i18n="Offers">Seller Offers</span>
                            </a>
                           </li>
                           <li class="nav-item {{ (Request::segment(2) == 'bayeroffers') ? 'active' : '' }}">
                            <a href="{{ route('admin.offers.buyerindex') }}" data-toggle="tooltip" data-placement="right"
                                data-original-title="Buyer Offers">
                               <i class="feather icon-gift "></i>
                                <span class="menu-title" data-i18n="Offers">Buyer Offers</span>
                            </a>
                           </li>
                    @endif
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Masters">Orders</span></a>
                <ul class="menu-content">
            @if(Auth()->user()->permissions->contains('name','admin.orders.index'))
                <li class="nav-item {{ (Request::segment(2) == 'orders') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" data-toggle="tooltip" data-placement="right"
                        data-original-title="Seller Orders">
                        <i class="feather icon-shopping-cart"></i>
                        <span class="menu-title" data-i18n="Orders">Seller Orders</span>
                    </a>
                </li>
                <li class="nav-item {{ (Request::segment(2) == 'buyerorders') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.buyerindex') }}" data-toggle="tooltip" data-placement="right"
                        data-original-title="Buyer Orders">
                        <i class="feather icon-shopping-cart"></i>
                        <span class="menu-title" data-i18n="Orders">Buyer Orders</span>
                    </a>
                </li>
            @endif 
             
            </ul>
                {{-- <li class="nav-item {{ (Request::segment(2) == 'chat') ? 'active' : '' }}">
                        <a href="{{ route('admin.chat.index') }}" data-toggle="tooltip" data-placement="right"
                            data-original-title="Chat">
                            <i class="feather icon-message-square"></i>
                            <span class="menu-title" data-i18n="Orders">Chat History</span>
                        </a>
                </li> --}}
                <li class="nav-item {{ (Request::segment(2) == 'chat') ? 'active' : '' }}">
                        <a href="{{ route('admin.chat.harsh') }}" data-toggle="tooltip" data-placement="right"
                            data-original-title="Chat History">
                            <i class="feather icon-message-square"></i>
                            <span class="menu-title" data-i18n="Orders">Chat History</span>
                        </a>
                </li>
                </li>
            
            </li>
        </ul>
    </div>
</div>