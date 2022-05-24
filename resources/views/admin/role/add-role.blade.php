@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/vendors.min.')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/components.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/themes/dark-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/themes/bordered-layout.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css/themes/semi-dark-layout.css')}}">

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <!-- Role cards -->
                <div class="row">
                    <div class="col-9">
                        <h2 class="content-header-title float-start mb-0">Super Administrateur</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item mx-2">
                                    <a href="#">Roles</a>
                                </li>
                            </ol>
                        </div>
                      </div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                                    <span class="btn btn-primary mb-1">Ajouter un rôle</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <section id="alerts-closable">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="card-body">
                                    <div class="demo-spacing-0">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <div class="alert-body">
                                                {{ $message }}
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </section>
                @endif
                <div class="row">
                    @foreach ($roles as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="fw-bolder">{{ $role->label }}</h4>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <a href="{{ route('role.edit',$role->id) }}" class="">
                                            <small class="fw-bolder">Editer</small>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="customSwitch4">Status</label>
                                        <form action="{{ route('role.changeStatus') }}" method="post">
                                            <div class="form-check form-check-success form-switch">
                                                <input type="hidden" name="uuid" value="{{ $role->id }}" required>
                                                <input type="checkbox" {{ $role->status ? "checked" : null }} class="form-check-input statusInput">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-xl-4 col-lg-6 col-md-6">
                 </div>

                </div>

                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Ajouter un Rôle</h1>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" action="{{ route('role.store') }}" method="post" class="row" >
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label" for="modalRoleName">Nom</label>
                                        <input type="text" id="modalRoleName" name="label" class="form-control" placeholder="Entrer un rôle" />
                                        {!! $errors->first('label', '<small class="text-danger "> Ce champ est réquis</small>') !!}

                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary me-1">Ajouter </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Add Role Modal -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/changeStatus.js') }}"></script>
    <!-- END:

@endsection
