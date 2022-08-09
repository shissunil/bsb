@extends('admin.layout.admin')

@section('title')
Add Payment Terms
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Add Payment Terms</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.paymentTerms.index') }}">Payment Terms</a>
                        </li>
                        <li class="breadcrumb-item active">Add Payment Terms
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
                        <h4 class="card-title">Add Payment Terms</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.paymentTerms.store') }}" id="export_type_form"
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
                                            <label for="status" class="mb-1">Status</label>
                                            <select class="select2 form-control select2-hidden-accessible @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="1">Active</option>
                                                <option value="0">InActive</option>
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
    });
</script>
@endsection