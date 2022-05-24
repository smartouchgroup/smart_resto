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
                                <li class="breadcrumb-item"><a href="{{ route('org_restaurants.index') }}">Liste</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="#">{{$restaurant->user->firstname}}</a>
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
                    <h4 class="card-title">Détails du restaurant</h4>
                </div>
                <div class="card-body">

                    <div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mt-1 p-1 border rounded text-center" style="width: fit-content;">
                                    <p class="small">Photo de profile</p>
                                    @if (stristr($restaurant->user->profile, 'avatar.png'))
                                    <img src="{{ asset('storage/avatars/restaurant_avatar.png') }}" class="mx-auto"
                                        height="100" width="100" alt="{{ $restaurant->user->firstname }}">
                                    @else
                                    <img src="{{ asset('storage/avatars/' . $restaurant->user->profile) }}"
                                        class="mx-auto" height="100" width="100"
                                        alt="{{ $restaurant->user->firstname }}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Nom du restaurant</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $restaurant->user->firstname
                                        }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Adresse email</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $restaurant->user->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Numéro de téléphone</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $restaurant->user->phone }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Slogan</small><br>
                                    <p class="p-1 bg-light border rounded text-italic">{{ $restaurant->slogan }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Localisation du restaurant</small><br>
                                    <p class="p-1 bg-light border rounded">{{ $restaurant->localization }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <small class="small">Description du restaurant</small><br>
                                    <p class="p-2 bg-light border rounded">{{ $restaurant->description }}</p>
                                </div>
                            </div>
                            @if ($restaurant->schedules)
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
                                                @foreach (json_decode($restaurant->schedules, true) as $key =>
                                                $schedule)
                                                <td>
                                                    {{ $schedule['open'] }}
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold bg-light">Heure de Ferméture</td>
                                                @foreach (json_decode($restaurant->schedules, true) as $key =>
                                                $schedule)
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
    <script src="{{ asset('js/admin.restaurant.js') }}"></script>
    @endsection
