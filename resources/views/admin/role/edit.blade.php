@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/semi-dark-layout.css">


    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Role cards -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Super Administrateur</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item mx-2"><a href="#">Rôles</a>
                                </li>
                            </ol>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulaire de modification du rôle</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" action="{{ route('role.update',$role->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-icon">Nom du rôle</label>
                                                <input type="text" id="first-name-icon" class="form-control" name="label" value="{{ $role->label }}" />
                                         </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- END:

@endsection
