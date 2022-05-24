@extends('employee.layouts.main')
@section('title') Mes commandes @endsection
@section('content')

@section('addititonal_style')
    <style>
        header form {
            margin-top: 15px !important;
        }

    </style>
@endsection

<x-parts.container type="container-fluid">
    <x-parts.main>
        <div class="container mt-3 mx-auto">
            <h2 class="dishes_title mb-2">Mes commandes</h2>
            @if ($message = Session::get('success'))
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
            <div class="row mt-4">
                <div class="col-12 col-xl-6">
                    <div class="part mt-2">
                        <h4 class="family_popone">Commandes actuelles</h4>
                      <div class="row justify-content-center mt-2">
                        @if (Auth::user())
                            @forelse ($getCommands as $getCommand)
                                <div class="col-4">
                                    <div class="card">
                                        <img src="{{ asset('storage/dishes/' . $getCommand->dishes->picture1) }}"
                                            class="dish_img rounded-top">
                                        <div class="dish_info">
                                            <p class="dish_name">{{ $getCommand->dishes->name }}</p>
                                            <p class="small category">
                                                <span>Catégorie: </span>
                                                <span
                                                    class="text-italic">{{ $getCommand->dishes->category->name }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-warning" role="alert">
                                    <i data-feather="alert-circle"></i>
                                  Aucune commande en cours de validation !!!
                                </div>
                            @endforelse
                        @endif
                    </div>
                    {{ $getCommands->links() }}
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="part mt-2">
                        <h4 class="family_popone">Historiques des commandes</h4>
                        {{-- Commands --}}
                        @if (Auth::user())
                            @forelse ($getCommandValidate as $Validate)
                                <div class="rounded bg-white my-1 command_historic">
                                    <div class="command_img">
                                        <img src="{{ asset('storage/dishes/' . $Validate->dishes->picture1) }}">
                                    </div>
                                    <div class="command_text">
                                        <div>
                                            <h5 class="family_popone">{{ $Validate->dishes->name }}</h5>
                                        </div>
                                        <div>
                                            <span class="small text-success">Votre commande a été validée</span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-warning mt-2" role="alert">
                                    <i data-feather="alert-circle"></i>
                                  Aucune commande en cours de validation !!!
                                </div>
                            @endforelse
                        @endif
                    </div>
                    {{ $getCommandValidate->links() }}
                    </div>
                </div>
            </div>
        </div>
        <button id="smooth_scroll_btn" class="d-none">
            <i data-feather="chevron-up"></i>
        </button>
    </x-parts.main>
</x-parts.container>
