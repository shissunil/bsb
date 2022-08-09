@extends('admin.layout.admin')

@section('title')
Export Type
@endsection

@section('head')
<link rel="stylesheet" type="text/css"
    href="{{ asset('public/assets/admin/app-assets/vendors/css/tables/datatable/datatables.min.css')  }}">
<style>
    .btn-print {
        color: #FFFFFF !important;
        background-color: #1E1E1E !important;
        border-color: #1E1E1E !important;
    }
</style>
@endsection

@section('content')

<div class="content-header row">

    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Export Type</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Export Type
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
                        <h4 class="card-title">Type List</h4>
                    </div>
                    <div class="card-content">

                        <div class="card-body">
                            <div class="button-container text-right mt-1 mb-1"></div>
                            @if(Auth()->user()->permissions->contains('name','admin.exportType.create'))
                                <a href="{{ route('admin.exportType.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add</a>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped dataex-html5-selectors_1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>User Type</th>
                                            @if( Auth()->user()->permissions->contains('name','admin.exportType.edit') || Auth()->user()->permissions->contains('name','admin.exportType.destroy') )
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($exportTypeList) > 0)
                                            @foreach ($exportTypeList as $exportType)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $exportType->name }}</td>
                                                    <td>{!! ($exportType->status == '1') ? '<p class="badge badge-pill badge-light-primary">Active</p>' : '<p class="badge badge-pill badge-light-danger">Inactive</p>' !!}</td>
                                                     <td>{!! ($exportType->userType == '2') ? '<p class="badge badge-pill badge-light-success">Seller</p>' : '<p class="badge badge-pill badge-light-danger">Buyer</p>' !!}</td>
                                                  {{--   <td>{{!! ($exportType->userType == '1') ? '<p class="badge badge-pill badge-light-primary">Buyer</p>' : '<p class="badge badge-pill badge-light-danger">Seller</p>'}}</td> --}}
                                                    @if( Auth()->user()->permissions->contains('name','admin.exportType.edit') || Auth()->user()->permissions->contains('name','admin.exportType.destroy') )
                                                        <td>
                                                            @if(Auth()->user()->permissions->contains('name','admin.exportType.edit'))
                                                                <a href="{{ route('admin.exportType.edit',$exportType->id) }}"
                                                                    class="btn btn-primary btn-sm" title="Edit"><i
                                                                        class="fa fa-pencil fa-lg"></i>
                                                                </a>
                                                            @endif
                                                            @if(Auth()->user()->permissions->contains('name','admin.exportType.destroy'))
                                                                <button type="button" class="btn btn-sm btn-danger delete-record"
                                                                    data-action="{{ route('admin.exportType.destroy',$exportType->id) }}">
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

<script type="text/javascript">
    var table = $('.dataex-html5-selectors_1').DataTable( {
    
    dom: 'Blfrtip',
    buttons: [
        // {
        //     extend: 'copyHtml5',
        //     exportOptions: {
        //         columns: [ 0, ':visible' ]
        //     }
        // },
        {   
            extend: 'csv',
            text: '<i class="fa fa-file-excel-o"></i> &nbsp; EXCEL',
            className: 'btn-success',
            exportOptions: {
                columns: ':visible:not(.not-export-col)'
            }
        },
        {
            extend: 'pdfHtml5',
            text: '<i class="fa fa-file-pdf-o"></i> &nbsp; PDF',
            className: 'btn-danger',
            exportOptions: {
                columns: ':visible:not(.not-export-col)'
            }
        },
        {
            extend: 'print',
            text: '<i class="fa fa-print"></i> &nbsp; PRINT',
            className: 'btn-print',
            exportOptions: {
                columns: ':visible:not(.not-export-col)'
            }
        }
    ]
    });

    table.buttons().container()
    .appendTo('.button-container');
</script>
@endsection