@extends('organization.layouts.main')
@section('content')
@include('organization.components.header')
@include('organization.components.horizontalBar')
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
                        <h2 class="content-header-title float-start mb-0">{{ Auth::user()->firstname }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ asset('org/tickets') }}">Accueil</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Configuration générale</a>
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
   <div class="container">
    <div class="row">
        <div class=" offset-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Modification Configuration de tickets (générale)</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('tickets.update',$ticket->user->uuid) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" >Nombre de tickets total mensuel </label>
                                    <div class="input-group input-group-merge">
                                        <input type="number"  class="form-control" value="{{ $ticket->ticketNumber }}" name="ticketNumber" placeholder="Entrer le nombre de ticket total mensuel" />
                                    </div>
                                    @if($errors->has('ticketNumber'))
                                    <div class="text-danger">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                         <small>{{$errors->first('ticketNumber') }}</small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                                <div class="mb-2">
                                    <label class="form-label" >Prix total (Fcfa) mensuel</label>
                                    <div class="input-group input-group-merge">
                                        <input type="number" class="form-control" value="{{ $ticket->ticketPrice }}" name="ticketPrice" placeholder="Entrer le prix total mensuel "/>
                                    </div>
                                    @if($errors->has('ticketPrice'))
                                    <div class="text-danger">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                         <small>{{$errors->first('ticketPrice') }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" >Nombre de tickets journalier autorisé </label>
                                        <div class="input-group input-group-merge">
                                            <input type="number"  class="form-control" value="{{ $ticket->allowedDishPerDay }}" name="allowedDishPerDay" placeholder="Entrer le nombre de ticket journalier autorisé" />
                                        </div>
                                        @if($errors->has('allowedDishPerDay'))
                                        <div class="text-danger">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                             <small>{{$errors->first('allowedDishPerDay') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1">Valider</button>
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
@endsection
