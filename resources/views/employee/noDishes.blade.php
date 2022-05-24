@extends('employee.layouts.main')
@section('title')
    Accueil
@endsection
@section('content')
    <x-parts.container type="container-fluid">
        <x-parts.main>
            <div class="dishes_container mt-3 mx-auto">
                <h2 class="dishes_title mb-2">Les plats du jour !</h2>
                @if ($message = Session::get('warning'))
                    <div style="width: 98%;" class="mx-auto">
                        <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-4 mx-auto">
                        <img src="{{ asset('images/noDishes.png') }}" width='400px' height="400px">
                        <h3>
                            Aucun plat disponible à ce jours !!!
                        </h3>
                    </div>

                </div>
                <button id="smooth_scroll_btn" class="d-none">
                    <i data-feather="chevron-up"></i>
                </button>
            </div>

        </x-parts.main>
    </x-parts.container>
@endsection
