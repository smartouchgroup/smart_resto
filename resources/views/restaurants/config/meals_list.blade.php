@extends('restaurants.layouts.main')
@section('content')
@include('restaurants.components.header')
@include('restaurants.components.horizontalBar')
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
                                <li class="breadcrumb-item active">Liste
                                </li>
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
                    <span>Impossible d'ajouter un nouveau plat veuillez réessayer</span>
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
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Liste des plats disponibles</h4>
                            <button class="dt-button create-new btn btn-primary" tabindex="0"
                                aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                data-bs-target="#modals-slide-in"><span><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-plus me-50 font-small-4">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>Ajouter un plat</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <section id="basic-datatable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <table class="datatables-basic table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Image 1</th>
                                                            <th class="text-center">Image 2</th>
                                                            <th class="text-center">Image 3</th>
                                                            <th class="text-center">Nom de plat</th>
                                                            <th class="text-center">categorie du plat</th>
                                                            <th class="text-center">Description</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach(Auth::user()->custom->dishes as $dish)
                                                        <tr>
                                                            <td>
                                                                @if ($dish->picture1 == null)
                                                                <img src="{{ asset('assets/plats/default_dish.png') }}"
                                                                    height="50px" alt="">
                                                                @else
                                                                <img src="{{ asset('storage/dishes'.'/'.$dish->picture1) }}"
                                                                    class="d-block w-100" alt="{{ $dish->name }}"
                                                                    height="75" width="75">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($dish->picture2 == null)
                                                                <img src="{{ asset('assets/plats/default_dish.png') }}"
                                                                    height="50px" alt="">
                                                                @else
                                                                <img src="{{ asset('storage/dishes'.'/'.$dish->picture2) }}"
                                                                    class="d-block w-100" alt="{{ $dish->name }}"
                                                                    height="75" width="75">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($dish->picture3 == null)
                                                                <img src="{{ asset('assets/plats/default_dish.png') }}"
                                                                    height="50px" alt="">
                                                                @else
                                                                <img src="{{ asset('storage/dishes'.'/'.$dish->picture3) }}"
                                                                    class="d-block w-100" alt="{{ $dish->name }}"
                                                                    height="75" width="75">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $dish->name }}
                                                            </td>

                                                            <td>
                                                                {{ $dish->category->name }}
                                                            </td>

                                                            <td>
                                                                {{ $dish->description }}
                                                            </td>
                                                            <td class="d-flex mt-1">
                                                                <a href="{{ route('dishes.edit',$dish->id) }}">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item d-flex align-items-center">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="14" height="14" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-edit-2 me-50">
                                                                            <path
                                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                                                class="text-info"></path>
                                                                        </svg>
                                                                        <span class="mb-3">Editer</span>
                                                                </a>
                                                                <button type="button"
                                                                    class="dropdown-item delete__dish__btn"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                    data-route="{{ route('dishes.destroy', $dish->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="#EA5455" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash me-50">
                                                                        <polyline points="3 6 5 6 21 6"
                                                                            class="text-danger"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg>
                                                                    <span class="text-danger">Supprimer</span>
                                                                </button>
                                                                <!-- Button trigger modal -->
                                                                <!-- Modal -->
                                                                <div class="modal fade modal-danger text-start"
                                                                    id="deleteModal" tabindex="-1"
                                                                    aria-labelledby="myModalLabel120"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="myModalLabel120">Attention !!!
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Vous êtes sur le point de supprimer ce
                                                                                plat!
                                                                                Cette action est
                                                                                irréversible!!!Etes-vous vraiment sûr ?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form action="" method="get"
                                                                                    id="delete__dish__form">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger"
                                                                                        data-bs-dismiss="modal">Supprimer</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{ $dishes->links() }}
                                        </div>
                                    </div>
                                    <div class="modal modal-slide-in fade show" id="modals-slide-in" aria-modal="true">
                                        <div class="modal-dialog sidebar-sm">
                                            <form action="{{ route('dishes.store') }}" method="post"
                                                enctype="multipart/form-data" class="add-new-record modal-content pt-0">
                                                @csrf
                                                <div class="modal-header mb-1">
                                                    <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout de
                                                        plats</h5>
                                                </div>
                                                <div class="modal-body flex-grow-1">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="firstname">Nom du plat</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text"><i
                                                                    data-feather="user"></i></span>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Entrez le nom du plat" required />
                                                            @error('name')
                                                            <div class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
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
                                                        <!-- Basic Select -->
                                                        <div class="mb-1">
                                                            <label class="form-label" for="basicSelect">catégorie de
                                                                plat</label>
                                                            <select class="form-select" name="categoryId"
                                                                id="basicSelect">
                                                                @foreach (Auth::user()->custom->categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name
                                                                    }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label" for="image1">Image 1</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i
                                                                        data-feather="image"></i></span>
                                                                <input type="file" id="profile" class="form-control"
                                                                    name="picture1"
                                                                    placeholder="Choississez une photo de profile"
                                                                    required />
                                                            </div>
                                                            @error('picture1')
                                                            <div class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
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
                                                        <div class="mb-1">
                                                            <label class="form-label" for="image2">Image 2</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i
                                                                        data-feather="image"></i></span>
                                                                <input type="file" id="profile" class="form-control"
                                                                    name="picture2"
                                                                    placeholder="Choississez une photo" />
                                                            </div>
                                                            @error('picture2')
                                                            <div class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
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
                                                        <div class="mb-1">
                                                            <label class="form-label" for="image3">Image 3</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i
                                                                        data-feather="image"></i></span>
                                                                <input type="file" id="profile" class="form-control"
                                                                    name="picture3"
                                                                    placeholder="Choississez une photo " />
                                                            </div>
                                                            @error('picture3')
                                                            <div class="text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
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
                                                        <div class="mb-1">
                                                            <label class="form-label" for="description">Description
                                                            </label>
                                                            <textarea name="description" class="form-control"
                                                                id="description" rows="3"
                                                                placeholder="Description du plat" required></textarea>
                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-primary data-submit me-1">Ajouter</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                    </div>
                                            </form>
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
</div>
</div>
<script>
    const form = document.querySelector('#delete__dish__form')
    const delete__dish__btns = Array.from(document.querySelectorAll('.delete__dish__btn'))

    delete__dish__btns.forEach(delete__dish__btn => {
        const route = delete__dish__btn.dataset.route;
        delete__dish__btn.addEventListener('click', _ => form.setAttribute('action', route))
    });
</script>
@endsection