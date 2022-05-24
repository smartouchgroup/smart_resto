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
                                <li class="breadcrumb-item active">Tickets
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

        <div class="col-md-12">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Configuration ticket</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket/total</th>
                                        <th>Ticket/journalier</th>
                                        <th>Prix</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($tickets as $ticket)
                                <tbody>
                                    <td>
                                        <h3>{{$ticket->ticketNumber}} tickets </h3>
                                    </td>
                                    <td>
                                        <h3>0{{$ticket->allowedDishPerDay}} tickets</h3>
                                    </td>
                                    <td>
                                        <h3> {{ $ticket->ticketPrice }} Fcfa</h3>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="{{route('tickets.edit',$ticket->user->uuid)}}">
                                                <button type="submit" class="btn btn-relief-success btn-sm ">Editer</button>
                                            </a>
                                        </div>
                                    </td>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
</div>
@endsection
