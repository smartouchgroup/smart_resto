@extends('admin.layouts.main')
@section('content')
@include('restaurants.components.header')
@include('restaurants.components.horizontalBar')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/vendors.min.css')}}">
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
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Restaurants {{ Auth::user()->firstname }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('categoriesMeals.index') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('categoriesMeals.edit', $category->id) }}">{{$category->name}}</a>
                                </li>
                                <li class="breadcrumb-item active">Editer
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
        @if(!$errors->isEmpty())
            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                <div class="alert-body d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-info me-50">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>Veuillez renseigner une catégorie de plat</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Basic table -->
                <div class="row" id="basic-table">
                    <div class="col-6 offset-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Modification de la catégorie <span class="text-uppercase ">{{ $category->name }}</span></h4>
                            </div>
                            <div class="card-body">
                                <form class="form form-horizontal" action="{{ route('categoriesMeals.update',$category->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="">
                                                    <input type="text" id="first-name" class="form-control" name="name" value="{{ $category->name }}" placeholder="Entrez la catégorie de plat"/>
                                                </div>
                                                @error('name')
                                                <div class="text-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-info me-50">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                    </svg>
                                                    <small>{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary me-1">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
