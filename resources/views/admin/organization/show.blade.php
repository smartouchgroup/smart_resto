@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')

<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/semi-dark-layout.css">
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Structures</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('organization.index') }}">Liste</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('organization.show', $organization->user->uuid) }}">{{$organization->user->firstname}}</a>
                                </li>
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
                <div class="card-header">
                    <h4 class="card-title">Détails de la structure</h4>
                </div>
                <div class="card-body">

                    <div>
                        <div class="row">
                            <div class="col-12 mb-2 d-flex justify-content-between">
                                <div class="mt-1 p-1 border rounded text-center" style="width: fit-content;">
                                    <p class="small">Photo de profil</p>
                                    @if (stristr($organization->user->profile, 'avatar.png'))
                                    <img src="{{ asset('storage/avatars/organization_avatar.png') }}" class="mx-auto"
                                        height="100" width="100" alt="{{ $organization->user->firstname }}">
                                    @else
                                    <img src="{{ asset('storage/avatars/' . $organization->user->profile) }}"
                                        class="mx-auto" height="100" width="100" alt="{{ $organization->user->firstname }}">
                                    @endif
                                </div>
                                <div class="mt-1">
                                    <a href="{{ route('org_groups.index') }}" class="btn btn-primary me-1 ">Les groupes de la structure</a><br>
                                    <a href="{{ route('org_employees.index') }}" class="btn btn-primary mt-2">Les employées de la structure</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Nom de la structure</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $organization->user->firstname }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Adresse email</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $organization->user->email }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Numéro de téléphone</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $organization->user->phone }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Slogan</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $organization->slogan }}</p>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Description de la structure</small><br>
                                    <p class="p-2 bg-light border rounded">{{ $organization->description }}</p>
                                </div>
                            </div>
                            @if ($organization->schedules)
                            <div class="col-12">
                                <div class="mb-1" style="overflow-x: scroll;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Lundi</th>
                                                <th>Mardi</th>
                                                <th>Mercredi</th>
                                                <th>Jeudi</th>
                                                <th>Vendredi</th>
                                                <th>Samedi</th>
                                                <th>Dimanche</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-bold bg-light">Heure d'ouverture</td>
                                                @foreach (json_decode($organization->schedules, true) as $key => $schedule)
                                                    <td>
                                                        {{ $schedule['open'] }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold bg-light">Heure de Ferméture</td>
                                                @foreach (json_decode($organization->schedules, true) as $key => $schedule)
                                                    <td>
                                                        {{ $schedule['close'] }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>










</div>
@endsection
