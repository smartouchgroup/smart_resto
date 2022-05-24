@extends('restaurants.layouts.main')
@section('content')
    @include('restaurants.components.header')
    @include('restaurants.components.horizontalBar')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/semi-dark-layout.css') }}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Restaurant</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Détails
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-info me-50">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                            <span>{{ $message }}</span>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="col-12 mb-2 d-flex justify-content-between">
                                    <div class="mt-1 p-1 border rounded text-center" style="width: fit-content;">
                                        <p class="small">Photo</p>
                                        @if (Auth::user()->profile !== null)
                                            <img src="{{ asset('storage/avatars' . '/' . Auth::user()->profile) }}"
                                                alt="{{ Auth::user()->firstname }}" class="mx-auto" height="90"
                                                width="100">
                                        @else
                                            <img src="{{  asset('storage/avatars/restaurant_avatar.png') }}" class="mx-auto" height="100" width="100" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h4>Restaurant - {{ Auth::user()->firstname }}</h4>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <small class="small">Adresse email</small><br>
                                        <p class="p-1 bg-light border rounded text-italic">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <small class="small">Numéro de téléphone</small><br>
                                        <p class="p-1 bg-light border rounded text-italic">{{ Auth::user()->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('restaurantProfile') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <small class="small">Changer de profile</small>
                                        <input type="file"  class="form-control" name="profile" value="{{ Auth::user()->profile }}" />
                                        @error('profile')
                                        <div class="text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-info me-50">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                        <button type="submit"
                                            class="btn btn-primary data-submit me-1 mt-1">Modifier</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('restaurantName') }}" method="post">
                                        @csrf
                                        <small class="small">Changer le nom du restaurant</small>
                                        <input type="text"  class="form-control" name="firstname"
                                            value="{{ Auth::user()->firstname }}"
                                            placeholder="Entrez le nom du restaurant" />
                                            @error('firstname')
                                            <div class="text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-info me-50">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                </svg>
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                        <button type="submit"
                                            class="btn btn-primary data-submit me-1 mt-1">Modifier</button>
                                    </form>
                                </div>

                                <div class="col-md-6 my-2">
                                    <form action="{{ route('restaurantPhone') }}" method="post">
                                        @csrf
                                        <small class="small">Changer de numéro de téléphone</small>
                                        <input type="number"  class="form-control" name="phone" value="{{ Auth::user()->phone }}"
                                            placeholder="Entrez votre nouveau numéro de téléphone" />
                                            @error('phone')
                                            <div class="text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-info me-50">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                </svg>
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                        <button type="submit"
                                            class="btn btn-primary data-submit me-1 mt-1">Modifier</button>
                                    </form>
                                </div>
                                <div class="col-md-6 my-2">
                                    <form action="{{ route('restaurantEmail') }}" method="post">
                                        @csrf
                                        <small class="small">Changer d'email</small>
                                        <input type="text"  class="form-control" name="email" value="{{ Auth::user()->email }}"
                                            placeholder="Entrez votre nouveau email" />
                                            @error('email')
                                            <div class="text-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-info me-50">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                </svg>
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                        <button type="submit"
                                            class="btn btn-primary data-submit me-1 mt-1">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
