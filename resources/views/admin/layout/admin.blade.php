<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

@include('admin.layout.head')

<!-- <body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns"> -->
<body class="vertical-layout vertical-menu-modern content-left-sidebar chat-application navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    @include('admin.layout.header')
    @include('admin.layout.sidebar')

    <div class="app-content content">

        <div class="content-overlay"></div>

        <div class="header-navbar-shadow"></div>
        <?php 
        // print_r(Request::segment(2));die;
        if((Request::segment(2) == 'chat'))
        {
        ?>
            <div class="content-area-wrapper">                            
        <?php
        }
        else
        {
        ?>
            <div class="content-wrapper">                            
        <?php
        }
        ?>
            @yield('content')
        </div>

    </div>

    @include('admin.layout.footer')
    
</body>

</html>