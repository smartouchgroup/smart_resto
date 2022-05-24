@extends('admin.layouts.main')
@section('content')
@include('admin.components.header')
@include('admin.components.horizontalBar')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/bordered-layout.css">
<link rel="stylesheet" type="text/css" href="dashboard/app-assets/css/themes/semi-dark-layout.css">
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
                                <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}">Liste</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('restaurants.show', $restaurant->user->uuid) }}">{{$restaurant->user->firstname}}</a>
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
    <div class="row g-2">
        <div class="col-md-6">
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
                                                @foreach (json_decode($restaurant->schedules, true) as $schedule)
                                                <td>
                                                    {{ $schedule['open'] }}
                                                </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td class="text-bold bg-light">Heure de Ferméture</td>
                                                @foreach (json_decode($restaurant->schedules, true) as $schedule)
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Catégories du restaurant</h3>
                </div>
                <div style="width: 96%;" class="mx-auto">
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
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="categories__list-tab" data-bs-toggle="tab"
                                data-bs-target="#categories__list" type="button" role="tab"
                                aria-controls="categories__list" aria-selected="true">Liste des catégories</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="categories__form-tab" data-bs-toggle="tab"
                                data-bs-target="#categories__form" type="button" role="tab"
                                aria-controls="categories__form" aria-selected="false">Fomulaire d'ajout de
                                catégorie</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="table-responsive tab-pane fade show active" id="categories__list" role="tabpanel"
                            aria-labelledby="categories__list-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nom de la catégorie</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($restaurant->categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td class="d-flex">
                                            <button class="dropdown-item d-flex align-items-center edit__category__btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-categoryData='{"id": {{$category->id}}, "name": "{{$category->name}}"}'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2 me-50">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                        class="text-info"></path>
                                                </svg>
                                                <span>Editer</span>
                                            </button>
                                            <button type="submit" class="dropdown-item delete__category__btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteWarning"
                                                data-categoryData='{"route": "{{route('restaurant.deleteCategory',
                                                $category->id)}}", "name": "{{$category->name}}"}'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="#EA5455" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash me-50">
                                                    <polyline points="3 6 5 6 21 6" class="text-danger"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                                <span class="text-danger">Supprimer</span>
                                            </button>
                                        </td>
                                        @empty
                                        <div class="alert alert-warning" role="alert">
                                            <div class="alert-body">
                                                Aucune catégorie de plat disponible pour le restaurant {{
                                                $restaurant->user->firstname }}
                                            </div>
                                        </div>

                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <form id="categories__form" class="form form-horizontal tab-pane fade show" role="tabpanel"
                            aria-labelledby="categories__form-tab" action="{{ route('categoriesMeals.store') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="">
                                            <input type="hidden" name="restaurantId" value="{{ $restaurant->id }}"
                                                required>
                                            <input type="text" id="first-name" class="form-control" name="name"
                                                @if(old('name')) value="{{ old('name') }} @endif"
                                                placeholder="Entrez la catégorie de plat" />
                                        </div>
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
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-1">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Dishes list --}}

            <div class="card">
                <div class="card-header d-flex justify-content-between align-center">
                    <h3>Plats du restaurant</h3>
                    @if (count($restaurant->categories) > 0)
                    <button class="btn btn-primary waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#addDish">Ajouter un plat</button>
                    @endif
                </div>
                <div style="width: 96%;" class="mx-auto">
                    @if ($message = Session::get('dishSuccess'))
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
                    <span>Il y'a eu une erreur lors de l'opération !</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($restaurant->dishes as $dish)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/dishes'.'/'.$dish->picture1) }}" class="d-block w-100"
                                        alt="{{ $dish->name }}">
                                </td>
                                <td>{{ $dish->name }}</td>
                                <td>{{ $dish->category->name }}</td>
                                <td class="d-flex">
                                    <button class="dropdown-item d-flex align-items-center my-2 edit__dish__btn"
                                        data-bs-toggle="modal" data-bs-target="#editDishModal"
                                        data-route="{{ route('restaurant.showDish', $dish->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-edit-2 me-50">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                class="text-info"></path>
                                        </svg>
                                        <span>Editer</span>
                                    </button>
                                    <button type="submit" class="dropdown-item my-2 delete__dish__btn"
                                        data-bs-toggle="modal" data-bs-target="#deleteDishWarning"
                                        data-dishData='{"route": "{{route('restaurant.deleteDish', $dish->id)}}",
                                        "name": "{{$dish->name}}"}'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="#EA5455" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-trash me-50">
                                            <polyline points="3 6 5 6 21 6" class="text-danger"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                        </svg>
                                        <span class="text-danger">Supprimer</span>
                                    </button>
                                </td>
                                @empty
                                <div class="alert alert-warning" role="alert">
                                    <div class="alert-body">
                                        Aucun plat disponible pour le restaurant {{
                                        $restaurant->user->firstname }}
                                    </div>
                                </div>

                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="modal fade m-auto" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modifier la catégorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit__category__form" class="form form-horizontal"
                            action="{{ route('restaurant.editCategory') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1 row">
                                        <div class="">
                                            <input type="hidden" id="categoryId" name="categoryId" required>
                                            <input type="text" class="form-control" id="category" name="category"
                                                @if(old('category')) value="{{ old('category') }} @endif"
                                                placeholder="Nouveau nom de la catégorie" required />
                                        </div>
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
        <div class="modal fade modal-danger text-start" id="deleteWarning" tabindex="-1"
            aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel140">Suppression de la catégorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="h3 text-danger">ATTENTION ! </span> Vous êtes sur le point de supprimer la
                        catégorie <span id="modalCategoryName"></span> du restaurant {{ $restaurant->user->firstname }} et tous les plats liés à celle-ci.
                        Cette action est irréversible. Voudrez-vous vraiment procéder à la suppression ?
                    </div>
                    <div class="modal-footer">
                        <form method="get" id="delete__category__form">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect waves-float waves-light"
                                data-bs-dismiss="modal">Oui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-danger text-start" id="deleteDishWarning" tabindex="-1"
            aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel140">Suppression du plat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="h3 text-danger">ATTENTION ! </span> Vous êtes sur le point de supprimer un plat
                        <span id="modalDishName"></span> du restaurant {{ $restaurant->user->firstname }}. Cette action
                        est irréversible. Voudrez-vous vraiment procéder à la suppression ?
                    </div>
                    <div class="modal-footer">
                        <form method="get" id="delete__dish__form">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger waves-effect waves-float waves-light"
                                data-bs-dismiss="modal">Oui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-start" id="editDishModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Editer le plat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('restaurant.updateDish') }}" id="edit__dish__form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="dishName">Nom du plat: </label>
                            <div class="mb-1">
                                <input type="text" id="dishName" name="dishName" placeholder="Entrez un pour le plat"
                                    class="form-control" required>
                                @error('dishName')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <label for="categoryName">Catéorie du plat: </label>
                            <div class="mb-1">
                                <select name="category" id="categoryName" class="form-control" required>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryName')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <textarea name="description" id="description" rows="5" class="form-control"
                                    required></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image1">Image 1</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture1"
                                        placeholder="Choississez une photo de profile" required />
                                </div>
                                <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                    <small class="text-warning">Ce premier champs d'image est obligatoire!</small><br>
                                @error('picture1')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image2">Image 2</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture2"
                                        placeholder="Choississez une photo" />
                                </div>
                                <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                @error('picture2')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image3">Image 3</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture3"
                                        placeholder="Choississez une photo " />
                                </div>
                                <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                @error('picture3')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" name="restaurantId" value="{{ $restaurant->user->uuid }}" required>
                            <input type="hidden" name="dishId" id="dishId" required>
                            <div class="w-50 mb-1" id="dishModalImgBloc" style="display: flex; justify-content:  space-between;">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Envoyer
                                la modification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade text-start" id="addDish" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Ajouter le plat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('restaurant.addDish') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="dishName">Nom du plat: </label>
                            <div class="mb-1">
                                <input type="text" name="name" placeholder="Entrez un nom pour le plat"
                                    class="form-control" @if (old('name'))
                                        value="{{ old('name') }}"
                                    @endif required>
                                @error('name')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <label for="category">Catéorie du plat: </label>
                            <div class="mb-1">
                                <select name="category" id="category" class="form-control" required>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category'))
                                        selected
                                    @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <textarea name="description" rows="5" class="form-control"
                                    required>@if (old('description')){{old('description')}}@endif</textarea>
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image1">Image 1</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture1"
                                        placeholder="Choississez une photo de profile" required />
                                    </div>
                                    <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                    <small class="text-warning">Ce premier champs d'image est obligatoire!</small><br>
                                @error('picture1')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image2">Image 2</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture2"
                                        placeholder="Choississez une photo" />
                                </div>
                                <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                @error('picture2')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label" for="image3">Image 3</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="image"></i></span>
                                    <input type="file" id="profile" class="form-control" name="picture3"
                                        placeholder="Choississez une photo " />
                                </div>
                                <small>Format d'image accepté: png, jpg, jpeg</small><br>
                                @error('picture3')
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-info me-50">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    <small>{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" name="restaurantId" value="{{ $restaurant->user->uuid }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Ajouter le plat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin.restaurant.js') }}"></script>
    @endsection