@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
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
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Restaurant</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}">Liste</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurants.edit', $restaurant->user->uuid) }}">{{$restaurant->user->firstname}}</a>
                                </li>
                                <li class="breadcrumb-item active">Editer
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
                <div class="card-header">
                    <h4 class="card-title">Formulaire de modification du restaurant</h4>
                </div>
                <div class="card-body">
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
                            <span>Il y'a eu une erreur lors de la modification!</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('restaurants.update', $restaurant->user->uuid) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="firstname">Nom du restaurant</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="firstname"  name="firstname" class="form-control"
                                            placeholder="Nom du restaurant" value="{{ $restaurant->user->firstname }}"
                                             />
                                    </div>
                                    @error('firstname')
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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                        <input type="email" id="email" class="form-control" name="email"
                                            placeholder="exemple@gmail.com" value="{{ $restaurant->user->email }}"
                                             />
                                    </div>
                                    @error('email')
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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="phone">Numero de téléphone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                        <input type="number" id="phone" class="form-control" name="phone"
                                            placeholder="00226 XX XX XX XX" value="{{ $restaurant->user->phone }}" />
                                    </div>
                                    @error('phone')
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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="slogan">Slogan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="file-text"></i></span>
                                        <input type="text" id="slogan" class="form-control" name="slogan"
                                            placeholder="Slogan du restaurant" value="{{ $restaurant->slogan }}" />
                                    </div>
                                    @error('slogan')
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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="localization">Localisation</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="map-pin"></i></span>
                                        <input type="text" id="localization" class="form-control" name="localization"
                                            placeholder="Localisation du restaurant"
                                            value="{{ $restaurant->localization }}" />
                                    </div>
                                    @error('localization')
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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="description">Description du restaurant</label>
                                    <textarea name="description" class="form-control" id="description" rows="3"
                                        placeholder="Votre description ...">{{ $restaurant->description }}</textarea>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="profile">Profil</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"></span>
                                    <input type="file" id="profile" class="form-control" name="profile" />
                                </div>
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
                                <div class="mt-1">
                                    @if (stristr($restaurant->user->profile, 'avatar.png'))
                                    <img src="{{ asset('storage/avatars/restaurant_avatar.png') }}" class="me-75"
                                        height="100" width="100" alt="{{ $restaurant->user->firstname }}">
                                    @else
                                    <img src="{{ asset('storage/avatars/' . $restaurant->user->profile) }}"
                                        class="me-75" height="100" width="100" alt="{{ $restaurant->user->firstname }}">
                                    @endif
                                </div>
                            </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1">Modifier la structure</button>
                </div>

                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
