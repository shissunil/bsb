@extends('admin.layout.admin')

@section('title')
Edit Material
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Edit Material</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.material.index') }}">Material Master</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Material
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
                        <h4 class="card-title">Edit Material</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.material.update',$materialData->id) }}" id="export_type_form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="name" class="mb-1">Name <span class="text-danger h6">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name" placeholder="Name..."
                                                value="{{ old('name') ? old('name') : $materialData->name }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="status" class="mb-1">Status</label>
                                            <select class="select2 form-control select2-hidden-accessible @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="1" {{ ($materialData->status == '1') ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ ($materialData->status == '0') ? 'selected' : '' }}>InActive</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                 <div class="row">
                                     <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="userType" class="mb-1">User Type</label>
                                            <select class="select2 form-control select2-hidden-accessible @error('userType') is-invalid @enderror" name="userType" id="userType">
                                                <option value="1" {{ ($materialData->userType == '1') ? 'selected' : '' }}>Buyer</option>
                                                <option value="2" {{ ($materialData->userType == '2') ? 'selected' : '' }}>Seller</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">
                                    Submit
                                </button>
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