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
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <div class="card-header d-flex justify-content-between border-bottom">
                            <h4 class="card-title d-flex jusitfy-content-between">Nos horaires</h4>
                            <div class="d-flex-justify-content-between align-items-center">
                                @if (Auth::user()->custom->schedules)
                                    <button type="button" class="dt-button create-new btn btn-primary"data-bs-toggle="modal" data-bs-target="#editModal">
                                        Editer
                                    </button>
                                @endif
                                @if (!json_decode(Auth::user()->custom->schedules, true) ||
                                    count(json_decode(Auth::user()->custom->schedules, true)) < 7)
                                    <button type="button"class="dt-button create-new btn btn-primary" data-bs-toggle="modal"data-bs-target="#addModal">
                                        Ajouter un horaire
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if (Auth::user()->custom->schedules)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach (array_keys(json_decode(Auth::user()->custom->schedules, true)) as $days)
                                            <th>{{ $days }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold bg-light" style="width: fit-content;">Heure d'ouverture</td>
                                        @foreach (json_decode(Auth::user()->custom->schedules, true) as $schedule)
                                        <td>
                                            {{ $schedule['open'] }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td class="text-bold bg-light" style="width: fit-content;">Heure de Ferméture</td>
                                        @foreach (json_decode(Auth::user()->custom->schedules, true) as $schedule)
                                        <td>
                                            {{ $schedule['close'] }}
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <div style="width: 90%;" class="mt-2 mx-auto">
                                <div class="alert alert-dark">
                                    <div class="alert-body">
                                        <p>Vous n'avez aucune horaire d'ouverture et de fermeture disponible !</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::user()->custom->schedules)
<div class="modal fade m-auto" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier les horaires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_schedules" class="form form-horizontal"
                    action="{{ route('schedules.update', Auth::user()->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            @foreach (json_decode(Auth::user()->custom->schedules, true) as $key => $schedule)
                            <fieldset class="border p-1 mb-1" data-key="{{ $key }}">
                                <legend>{{ $key }}</legend>
                                <div class="mb-1">
                                    <label for="{{ $key }}_open" class="form-label">Heure d'ouverture</label>
                                    <input type="time" name="{{ $key }}_open" id="{{ $key }}_open" value="{{ $schedule['open'] }}"
                                        class="form-control" required>
                                </div>
                                <div class="mb-1">
                                    <label for="{{ $key }}_close" class="form-label">Heure d'ouverture</label>
                                    <input type="time" name="{{ $key }}_close" id="{{ $key }}_close"
                                        value="{{ $schedule['close'] }}" class="form-control" required>
                                </div>
                            </fieldset>
                            @endforeach
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary me-1">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@if (Auth::user()->custom->schedules === null || count(json_decode(Auth::user()->custom->schedules, true)) < 7) <div
    class="modal fade m-auto" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ajouter un horaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_schedules" class="form form-horizontal" action="{{ route('schedules.store') }}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <select name="day" id="day" class="form-control">
                                    @foreach ($jours as $jour)
                                    {{-- @if (!json_decode(Auth::user()->custom->schedules, true) ||
                                    !in_array($jour->name, array_keys(json_decode(Auth::user()->custom->schedules,
                                    true)))) --}}
                                    <option value="{{ $jour->name }}">{{ $jour->name }}</option>
                                    {{-- @endif --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="open">Heure d'ouverture</label>
                                <input type="time" name="open" id="open" class="form-control" required>
                            </div>
                            <div class="mb-1">
                                <label for="close">Heure de fermeture</label>
                                <input type="time" name="close" id="close" class="form-control" required>
                            </div>

                        </div>
                        <div class="mt-1">
                            <button type="submit" class="btn btn-primary me-1">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @endif
    <script src="{{ asset('js/schedules.js') }}"></script>
