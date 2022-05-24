@extends('restaurants.layouts.main')
@section('content')
@include('restaurants.components.header')
@include('restaurants.components.horizontalBar')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
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
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Restaurants {{ Auth::user()->firstname }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dishes.index') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active">Horaires</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div style="width: 90%;" class="mx-auto">
                            @if(!$errors->isEmpty())
                            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <span>Il y'a eu une erreur avec l'ajout du restaurant!</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <span>{{$message}}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="offset-3 col-md-6">
                                <div class="card">
                                    <form action="" method="post">
                                        <label for="">Changer le status de disponibilité</label>
                                       <select class="form-select mt-2" name="availibility" aria-label="Default select example">
                                        <option selected>Choix de disponiblité</option>
                                        <option value="1">Disponible</option>
                                        <option value="2">Indisponible</option>
                                      </select>
                                    <button type="submit" class="btn btn-primary data-submit me-1 mt-2" >Changer</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2"
                                        data-bs-dismiss="modal">Fermer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/schedules.js') }}"></script>
