@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')
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
                        <h2 class="content-header-title float-start mb-0">Groupe</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Accueil</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">groupe</a>
                                </li>
                                <li class="breadcrumb-item active">Liste
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
                    <span>Impossible d'ajouter une nouveau groupe veuillez réesayer</span>
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
            <!-- Basic table -->
                <section id="basic-datatable">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Liste des differents groupes</h4>
                            <button class="dt-button create-new btn btn-primary" tabindex="0"
                                aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                data-bs-target="#modals-slide-in">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>Ajouter un groupe
                                </span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <section id="basic-datatable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <table class="datatables-basic table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Groupe</th>
                                                            <th>localization</th>
                                                            <th>Téléphone</th>
                                                            <th>isPrincipal</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                   
                                                    <tbody>
                                                        @foreach ($groups as $group)
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                {{ $group->name }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $group->localization }}
                                                            </td>
                                                            
                                                            <td>
                                                                {{ $group->phone }}
                                                            </td>
                                                           
                                                            <td>
                                                                <form action="{{ route('restaurant.changeStatus') }}" method="post">
                                                                    <div class="form-check form-check-success form-switch">
                                                                        <input type="hidden" name="uuid" value="{{ $group->organization->uuid }}" required>
                                                                        <input type="checkbox" {{ $group->organization->status ? "checked" : null }} class="form-check-input statusInput">
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td class="d-flex">  
                                                                <a href="">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-edit-2 me-50">
                                                                            <path
                                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                                                class="text-info"></path>
                                                                        </svg>
                                                                        <span class="text-info">Editer</span>
                                                                    </button>
                                                                </a>
                                                                <form action="" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                            viewBox="0 0 24 24" fill="none" stroke="#EA5455"
                                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-trash me-50">
                                                                            <polyline points="3 6 5 6 21 6" class="text-danger"></polyline>
                                                                            <path
                                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                            </path>
                                                                        </svg>
                                                                        <span class="text-danger">Supprimer</span>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                              
                                                    </tbody>


                                                </table>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal modal-slide-in fade show" id="modals-slide-in" aria-modal="true">
                                        <div class="modal-dialog sidebar-sm">
                                            @if ($message = Session::get('success'))
                                            <div class="">
                                                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i
                                                        data-feather="alert-triangle" class="w-6 h-6 mr-2 text-theme-9"></i> <strong>{{
                                                        $message }}</strong><i data-feather="x" class="w-4 h-4 ml-auto"
                                                        onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'
                                                        id="close"></i> </div>
                                            </div>
                                            @endif
                                            <form action=" {{ route('groups.store') }} " method="post" enctype="multipart/form-data"
                                                class="add-new-record modal-content pt-0">
                                                @csrf
                                                <div class="modal-header mb-1">
                                                    <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout du groupes</h5>
                                                </div>
                                                <div class="modal-body flex-grow-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Nom du groupe</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                                            <input type="text" id="name" class="form-control" name="name"
                                                                placeholder="Entrez le nom du group" @if(old('name'))
                                                                value="{{ old('name') }}" @endif required />
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


                                                        <div class="mb-1">
                                                            <label class="form-label" for="phone">Téléphone</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                                <input type="number" id="phone" class="form-control" name="phone"
                                                                    placeholder="00226 XX XX XX XX" @if(old('smartphone'))
                                                                    value="{{ old('smartphone') }}" @endif required />
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



                                                        <div class="mb-1">
                                                            <label class="form-label" for="localization">Localisation</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i data-feather="map-pin"></i></span>
                                                                <input type="text" id="localization" class="form-control"
                                                                    name="localization"
                                                                    placeholder="Entrez la localisation du group" />
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

                                                        <!-- <div class="mb-1">
                                                            <label class="form-label" for="password">Mot de passe</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                                                <input type="password" id="password" class="form-control"
                                                                    name="password" placeholder="Confirmez votre mot de passe" />
                                                            </div>
                                                            @error('password')
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
                                                        <div class="mb-1">
                                                            <label class="form-label" for="confirm_password">Confirmation du mot de
                                                                passe</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                                                <input type="password" id="confirm_password" class="form-control"
                                                                    name="confirm_password" placeholder="Confirmez votre mot de passe" />
                                                            </div>
                                                            @error('confirm_password')
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
                                                        </div> -->
                                                        <button type="submit" class="btn btn-primary data-submit me-1">Ajouter</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>

                                </section>
                            </table>
            <!--/ Basic table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
