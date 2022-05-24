@extends('employee.layouts.main')
@section('title')
    Mes informations
@endsection
@section('content')
    <x-parts.container type="container-fluid">
        <x-parts.main>
            <div class="container mt-3 mx-auto">
                <h2 class="dishes_title mb-2">Mes informations</h2>
                <div class="row mt-2">
                    <div class="col-12 col-lg-6">
                        <div
                            class="w-100 bg-white rounded-top d-flex justify-content-between align-items-center account_user_container">
                            <div class="account_user rounded-circle">
                                @if (Auth::user()->profile != null)
                                <img src="{{ asset('storage/user_profile/' . Auth::user()->profile) }}"
                                    alt="{{ Auth::user()->firstname }}">
                                @else
                              <img src="{{ asset('assets/employee/employee_avatar.png') }}" alt="user">
                            @endif
                            </div>
                            <div>
                                <h1 class="family_popone">{{ Auth::user()->lastname . ' ' . Auth::user()->firstname }}
                                </h1>
                            </div>
                        </div>

                        <div class="w-100 bg-white rounded-bottom mt-1">
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Nom :</h5>
                                <h5 class="family_popone">{{ Auth::user()->firstname }}</h5>
                            </div>
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Prénom :</h5>
                                <h5 class="family_popone">{{ Auth::user()->lastname }}</h5>
                            </div>
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Numéro de téléphone :</h5>
                                <h5 class="family_popone">{{ Auth::user()->phone }}</h5>
                            </div>
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Addresse email :</h5>
                                <h5 class="family_popone">{{ Auth::user()->email }}</h5>
                            </div>
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Structure :</h5>
                                <h5 class="family_popone">{{ Auth::user()->custom->organization->user->firstname }}</h5>
                            </div>
                            <div class="p-1 d-flex justify-content-between align-items-center">
                                <h5>Groupe :</h5>
                                <h5 class="family_popone">{{ Auth::user()->custom->group->name }}</h5>
                            </div>
                        </div>

                        <div class="my-1 w-100 bg-white rounded p-1">
                            @if ($message = Session::get('successPassword'))
                                <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-info me-50">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h2 class="family_popone">Changer mon mot de passe</h2>
                            <form action="{{ route('account.changePassword') }}" method="POST" class="mt-1">
                                @csrf
                                <div class="mt-1">
                                    <label for="email">Nouveau Mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Entrez votre mot de passe" required>
                                    </div>
                                    @error('password')
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
                                <div class="mt-1">
                                    <label for="email">Confirmez votre nouveau mot de passe</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control" id="password"
                                            placeholder="Entrez votre mot de passe" required>
                                    </div>
                                    @error('confirm_password')
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
                                <div class="form-group mt-2">
                                    <button type="submit" class="outline-none border-0 rounded">Valider les
                                        modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="w-100 bg-white rounded-top p-1">
                            @if ($message = Session::get('successData'))
                                <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-info me-50">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h2 class="family_popone">Modifier mes informations</h2>
                            <form action="{{ route('account.changeData') }}" method="POST" class="mt-1">
                                @csrf
                                <label for="lastname">Nom</label>
                                <div class="input-group">
                                    <input type="text" name="lastname" class="form-control" id="lastname"
                                        placeholder="Entrez votre nom" value="{{ Auth::user()->firstname }}" required>
                                    <button type="submit" class="input-group-text">
                                        <i data-feather="edit-2"></i>
                                    </button>
                                </div>

                                <div class="mt-1">
                                    <label for="firstname">Prénom</label>
                                    <div class="input-group">
                                        <input type="text" name="firstname" class="form-control" id="firstname"
                                            placeholder="Entrez votre prénom" value="{{ Auth::user()->lastname }}"
                                            required>
                                        <button type="submit" class="input-group-text">
                                            <i data-feather="edit-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <label for="phone">Numéro de téléphone</label>
                                    <div class="input-group">
                                        <input type="tel" name="phone" class="form-control" id="phone"
                                            placeholder="Entrez votre numéro de téléphone"
                                            value="{{ Auth::user()->phone }}" required>
                                        <button type="submit" class="input-group-text">
                                            <i data-feather="edit-2"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group mt-1">
                            <button type="submit" class="outline-none border-0 rounded">Valider les modifications</button>
                        </div>
                        </form>
                        <form action="{{ route('account.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-1">
                                <label for="phone">Changer de profil</label>
                                <div class="input-group">
                                    <input type="file" accept="image/*" name="profile" required class="form-control"
                                        id="profile">
                                    <button type="submit" class="input-group-text">
                                        <i data-feather="edit-2"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group mt-1">
                                <button type="submit" class="outline-none border-0 rounded">Changer de profil</button>
                            </div>
                        </form>
                        <div class="mt-1 w-100 bg-white rounded-bottom p-1">
                            @if ($message = Session::get('successEmail'))
                                <div class="alert alert-success mt-1 alert-dismissible" role="alert">
                                    <div class="alert-body d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-info me-50">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="16" x2="12" y2="12"></line>
                                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                        </svg>
                                        <span>{{ $message }}</span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h2 class="family_popone">Changer mon adresse email</h2>
                            <form action="{{ route('account.changeEmail') }}" method="POST" class="mt-1">
                                @csrf
                                <div class="mt-1">
                                    <label for="email">Adresse email</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Entrez votre adresse email" value="{{ Auth::user()->email }}"
                                            required>
                                    </div>
                                    @error('email')
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
                                <div class="mt-1">
                                    <label for="email">Confirmez adresse email</label>
                                    <div class="input-group">
                                        <input type="email" name="confirm_email" class="form-control" id="confirm_email"
                                            placeholder="Entrez votre adresse email" value="{{ Auth::user()->email }}"
                                            required>
                                    </div>
                                    @error('confirm_email')
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
                                <div class="form-group mt-2">
                                    <button type="submit" class="outline-none border-0 rounded">Valider les
                                        modifications</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button id="smooth_scroll_btn" class="d-none">
                <i data-feather="chevron-up"></i>
            </button>
        </x-parts.main>
    </x-parts.container>

@endsection
