@extends('admin.layout.admin')

@section('title')
Add Colour
@endsection
@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css" integrity="sha512-HcfKB3Y0Dvf+k1XOwAD6d0LXRFpCnwsapllBQIvvLtO2KMTa0nI5MtuTv3DuawpsiA0ztTeu690DnMux/SuXJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Add Colour</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.colour.index') }}">Colour Master</a>
                        </li>
                        <li class="breadcrumb-item active">Add Colour
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Colour</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.colour.store') }}" id="export_type_form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="name" class="mb-1">Name <span class="text-danger h6">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Name..."
                                                value="{{ old('name') }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="code" class="mb-1">Colour Code <span class="text-danger h6">*</span></label>
                                            <div class="input-group colorpicker-element">
                                                <input type="text" name="code" class="form-control input-block color-io @error('code') is-invalid @enderror" id="name" placeholder="Name..." value="{{ old('code') }}">
                                                <span class="input-group-append">
                                                    <span id="color_picker" class="input-group colorpicker-element"
                                                        title="Using input value">
                                                        <input type="hidden" class="form-control input-lg" value="#000000">
                                                        <span class="input-group-text colorpicker-input-addon"
                                                            data-original-title="" title="" tabindex="0">
                                                            <i style="background: #000000"></i>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="status" class="mb-1">Status</label>
                                            <select class="select2 form-control select2-hidden-accessible @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="userType" class="mb-1">User Type</label>
                                            <select class="select2 form-control select2-hidden-accessible @error('userType') is-invalid @enderror" name="userType" id="userType">
                                                <option value="1">Buyer</option>
                                                <option value="2">Seller</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light"> Submit </button>
                            <form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@section('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"
    integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $("#export_type_form").validate({
            debug: true,
            errorClass: 'error',
            validClass: 'success',
            errorElement: 'span',
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents(".error").removeClass("error");
                $(element).removeClass("is-invalid");
            },
            rules:{                
                name:{
                    required:true,
                },
                status:{
                    required:true,
                }
            },

            messages: {
                name: {
                    required: "Name is required",
                },
                status:{
                    required: "Status is required",
                }
            },
            submitHandler: function(form) {
                form.submit();
            }   
        });

        let color_picker = $('#color_picker').colorpicker()
        .on('colorpickerCreate', function (e) {
            // initialize the input on colorpicker creation
            var io = $('.color-io');

            io.val(e.color.string());

            io.on('change keyup', function () {
                e.colorpicker.setValue(io.val());
            });
        })
        .on('colorpickerChange', function (e) {
            var io = $('.color-io');

            if (e.value === io.val() || !e.color || !e.color.isValid()) {
                // do not replace the input value if the color is invalid or equals
                return;
            }

            io.val(e.color.string());
        });
    });
</script>
@endsection