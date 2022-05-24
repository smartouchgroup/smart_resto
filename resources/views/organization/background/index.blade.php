@extends('organization.layouts.main')
@section('content')
@include('organization.components.header')
@include('organization.components.horizontalBar')
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
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Configuration générale</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">

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
            <section id="input-file-browser">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Couleur de L'entreprise</h4>
                            </div>
                            @foreach ($backgrounds as $background )
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-1 mb-sm-0">
                                        <label for="formFile" class="form-label">Choisir la couleur principal de l'entreprise</label>
                                        <div>
                                            <input id="largeInput" class="form-control form-control-lg" value="{{ $background->background }}" type="color"/>
                                        </div>
                                    </div>
                                </div>
                              <a href="{{route('background.edit',$background->id) }}">
                                <button
                                type="submit"
                                class="btn btn-primary data-submit me-1 my-2"
                                @if ($background->background)
                                style="background-color: {{ $background->background }} !important;"
                                @endif>Choisir une couleur</button>
                               </a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<script src="{{ asset('js/changeStatus.js') }}"></script>
<script>
    const form = document.querySelector('#delete__dish__form')
    const delete__dish__btns = Array.from(document.querySelectorAll('.delete__dish__btn'))

    delete__dish__btns.forEach(delete__dish__btn => {
        const route = delete__dish__btn.dataset.route;
        delete__dish__btn.addEventListener('click', _ => form.setAttribute('action', route))
    });
</script>

@endsection
