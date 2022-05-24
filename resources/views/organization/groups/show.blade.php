@extends('organization.layouts.main')
@section('content')
@include('organization.components.header')
@include('organization.components.horizontalBar')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/components.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/bordered-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/semi-dark-layout.css') }}">
@include('admin.components.horizontalBar')
<div class="app-content content">
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
                                <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Liste</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('groups.edit', $group->id) }}">{{$group->name}}</a>
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
                    <h4 class="card-title">Détails du groupe</h4>
                </div>
                <div class="card-body">

                    <div>
                        <div class="row">
                            <div class="col-12 mb-2 d-flex justify-content-between">
                                <div class="mt-1 p-1 border rounded text-center" style="width: fit-content;">
                                    <p class="small">Photo de profile</p>
                                    @if (stristr($group->organization->user->profile, 'avatar.png'))
                                    <img src="{{ asset('storage/avatars/organization_avatar.png') }}" class="mx-auto"
                                        height="100" width="100" alt="{{ $group->organization->user->firstname }}">
                                    @else
                                    <img src="{{ asset('storage/avatars/' . $group->organization->user->profile) }}"
                                        class="mx-auto" height="100" width="100"
                                        alt="{{ $group->organization->user->firstname }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Nom de la structure</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{
                                        strtoupper($group->organization->user->firstname) }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Nom du groupe</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $group->name }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Adresse email de la structure</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{
                                        $group->organization->user->email }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Numéro de téléphone du groupe</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $group->phone }}</p>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Localisation du groupe</small><br>
                                    <p class="p-1 bg-light border rounded">{{ $group->localization }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection