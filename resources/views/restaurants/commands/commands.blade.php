@extends('restaurants.layouts.main')
@section('content')
    @include('restaurants.components.header')
    @include('restaurants.components.horizontalBar')
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
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/semi-dark-layout.css') }}">
    @include('admin.components.horizontalBar')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Commandes</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Liste des commandes en cours</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="nested_error_block"></div>
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
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Liste des commandes</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom(s)</th>
                                            <th>Structure/Agence</th>
                                            <th>Plat commandé</th>
                                            <th>Numero</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($commands as $command)
                                            <tr>
                                                <td>
                                                    {{ $command->employee->user->lastname }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->user->firstname }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->organization->user->firstname }} /
                                                    {{ $command->employee->group->name }}
                                                </td>
                                                <td>
                                                    {{ $command->dishes->name }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->user->phone }}
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('org.validateCommande', $command->id) }}">
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-more-vertical">
                                                                <circle cx="12" cy="12" r="1"></circle>
                                                                <circle cx="12" cy="5" r="1"></circle>
                                                                <circle cx="12" cy="19" r="1"></circle>
                                                            </svg>
                                                            <span>Valider</span>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('restaurant.deleteCommande',$command->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewBox="0 0 24 24" fill="none" stroke="#EA5455"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-trash me-50">
                                                                <polyline points="3 6 5 6 21 6" class="text-danger">
                                                                </polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                            </svg>
                                                            <span class="text-danger">Rejeter</span>
                                                        </button>
                                                    </a>
                                                </td>
                                                @empty
                                                <div class="alert alert-warning text-center" role="alert">
                                                    Aucune commande en cours
                                                  </div>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                            {{ $commands->links() }}
                        </div>
                    </div>
                </section>
                <br> <br> <br>
                <section id="basic-datatable">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Liste des commandes validée</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom(s)</th>
                                            <th>Structure/Agence</th>
                                            <th>Plat commandé</th>
                                            <th>Numero</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($commandsValidated as $command)
                                            <tr>
                                                <td>
                                                    {{ $command->employee->user->lastname }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->user->firstname }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->organization->user->firstname }} /
                                                    {{ $command->employee->group->name }}
                                                </td>
                                                <td>
                                                    {{ $command->dishes->name }}
                                                </td>
                                                <td>
                                                    {{ $command->employee->user->phone }}
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('restaurant.deleteValidateCommande',$command->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                viewBox="0 0 24 24" fill="none" stroke="#EA5455"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" class="feather feather-trash me-50">
                                                                <polyline points="3 6 5 6 21 6" class="text-danger">
                                                                </polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                            </svg>
                                                            <span class="text-danger">Supprimer</span>
                                                        </button>
                                                    </a>
                                                </td>
                                                @empty
                                                <div class="alert alert-warning text-center" role="alert">
                                                    Aucune commande validée
                                                  </div>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $commandsValidated->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/changeStatus.js') }}"></script>
@endsection
