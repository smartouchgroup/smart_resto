@extends('restaurants.layouts.main')
@section('content')
    @include('restaurants.components.header')
    @include('restaurants.components.horizontalBar')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <!-- BEGIN: Theme CSS-->
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
                            <h2 class="content-header-title float-start mb-0">Restaurants {{ Auth::user()->firstname }}
                            </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dishes.index') }}">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Menu hebdomadaire
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
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
                            <span>{{ $message }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <section id="basic-datatable">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Menu du jour</h4>
                                <button type="button" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#inlineForm"><span><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-plus me-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>Constituer un menu</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Formulaire d'ajout de menu</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('menu.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicSelect">Choisir un jour</label>
                                            <select class="form-select" name="dayId" id="basicSelect">

                                                @foreach ($days as $day)
                                                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basicSelect">Sélection de plats</label> <br>
                                            <select class="selectpicker" name="dishId[]" multiple
                                                data-live-search="false">
                                                @foreach (Auth::user()->custom->dishes as $dish)
                                                    <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="footer ">
                                            <button type="submit" class="btn btn-primary"
                                                data-bs-dismiss="modal">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <section id="basic-datatable">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card p-5">
                                            <div class="d-flex">
                                                @forelse (Auth::user()->custom->menus as $menu)
                                                    <div style="width: 20%; height: fit-content;"
                                                        class="border rounded bg-white text-center mx-2">
                                                        <div class="bg-light border-bottom d-flex justify-content-around align-items-center"
                                                            style="">
                                                            <h4 style="margin-top: 10px;">{{ $menu->day->name }}</h4>

                                                            <div>
                                                                <a href="{{ route('restaurant.deleteMenu',$menu->id) }}"
                                                                    class="dropdown-item d-flex align-items-center text-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill text-red" viewBox="0 0 16 16">
                                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                      </svg>
                                                                    <span class="mx-1">Vider</span>
                                                                </a>

                                                                <button type="button"
                                                                    class="dropdown-item d-flex align-items-center"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit_menu_{{ $menu->day->name }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-edit-2 me-50">
                                                                        <path
                                                                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                                            class="text-info"></path>
                                                                    </svg>
                                                                    <span class="text-info">Editer</span>
                                                                </button>

                                                                <div class="modal fade text-start"
                                                                    id="edit_menu_{{ $menu->day->name }}" tabindex="-1"
                                                                    aria-labelledby="myModalLabel33" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title"
                                                                                    id="myModalLabel33">
                                                                                    Editer le menu du
                                                                                    {{ $menu->day->name }}</h4>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('menu.update', $menu->id) }}"
                                                                                method="post" class="menu_update_form">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="modal-body">
                                                                                    <div class="mb-1">
                                                                                        <h3>Liste des plats actuels du menu
                                                                                        </h3>
                                                                                        <ul>
                                                                                            @foreach ($menu->custom as $dish)
                                                                                                <li>{{ $dish->name }}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="mb-1">
                                                                                        <label
                                                                                            class="form-label">Sélection
                                                                                            de
                                                                                            plats</label> <br>
                                                                                        <select name="dishesId[]" multiple
                                                                                            class="form-control">
                                                                                            @foreach (Auth::user()->custom->dishes as $dish)
                                                                                                <option
                                                                                                    value="{{ $dish->id }}"
                                                                                                    @if (in_array($dish, $menu->custom)) selected @endif>
                                                                                                    {{                                                                                                     $dish->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="footer">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary"
                                                                                            data-bs-dismiss="modal">Modifer</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @forelse ($menu->custom as $dish)
                                                            <div class="border-bottom py-1">
                                                                {{ $dish->name }}
                                                            </div>
                                                        @empty
                                                            <p>Aucun plat disponible !</p>
                                                        @endforelse
                                                    </div>
                                                @empty
                                                    <p>Aucun menu !</p>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </table>
                    </div>
            </div>
        </div>
        </section>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection
