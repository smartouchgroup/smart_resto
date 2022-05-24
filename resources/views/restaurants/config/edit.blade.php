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
                                <li class="breadcrumb-item"><a href="{{ route('dishes.index') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dishes.edit', $dish->id) }}">{{$dish->name}}</a>
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
                    <span>Impossible d'ajouter un nouveau plat veuillez réessayer</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                <div class="alert-body d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-info me-50">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>{{$message}}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


            <div class="row">
                <div class="offset-3 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulaire de modification du plat {{$dish->name}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{ route('dishes.update',$dish->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-4">
                                            <label class="form-label" for="profile">Image 1</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"></span>
                                                <input type="file" class="form-control" name="picture1" required/>
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
                                            <div class="mt-1  p-1 border  rounded" style="width: fit-content;">
                                                @if ($dish->picture1 == null)
                                                <img src="{{ asset('assets/plats/default_dish.png') }}" class="me-75"
                                                height="100" width="100" alt="">
                                                @else
                                                <img src="{{asset('storage/dishes'.'/'.$dish->picture1)}}" class="me-75"
                                                height="100" width="100" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-4">
                                            <label class="form-label" for="profile">Image 2</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"></span>
                                                <input type="file"  class="form-control" name="picture2" />
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
                                            <div class="mt-1  p-1 border  rounded" style="width: fit-content;">
                                                @if ($dish->picture2 == null)
                                                <img src="{{ asset('assets/plats/default_dish.png') }}" class="me-75"
                                                height="100" width="100" alt="">
                                                @else
                                                <img src="{{asset('storage/dishes'.'/'.$dish->picture2)}}" class="me-75"
                                                height="100" width="100" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-4">
                                            <label class="form-label" for="profile">Image 3</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"></span>
                                                <input type="file"  class="form-control" name="picture3" />
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
                                            <div class="mt-1  p-1 border  rounded" style="width: fit-content;">
                                                @if ($dish->picture3 == null)
                                                <img src="{{ asset('assets/plats/default_dish.png') }}" class="me-75"
                                                height="100" width="100" alt="">
                                                @else
                                                <img src="{{asset('storage/dishes'.'/'.$dish->picture3)}}" class="me-75"
                                                height="100" width="100" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="dishes">Nom du plat</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <input type="text"  class="form-control" name="name"
                                                    placeholder="Entrez le nom du plat" value="{{ $dish->name }}" required />
                                            </div>
                                            @error('dishes')
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
                                            <label class="form-label" for="dishes">Catégorie</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <select class="form-select" name="categoryId" id="basicSelect">
                                                    @foreach (Auth::user()->custom->categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('categoryId')
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
                                            <label class="form-label" for="description">Description du plat</label>
                                            <textarea name="description"  class="form-control" id="description" rows="3"
                                                placeholder="Votre description ..." required>{{ $dish->description }} </textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1">Modifier le plat</button>
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
