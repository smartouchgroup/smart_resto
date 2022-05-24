@extends('employee.layouts.main')
@section('title') Accueil @endsection
@section('content')
    <x-parts.container type="container-fluid">
        <x-parts.main>
            <div class="dishes_container mt-3 mx-auto">
                <h2 class="dishes_title mb-2">Les plats du jour !</h2>
                <div class="row">
                    @foreach ($dishes as $dish)
                    <x-parts.card :dish='$dish'/>
                    @endforeach
                </div>
                <div>
                    @if (request()->input('search'))
                      <h5>
                          {{ $dishes->count()  }} resultat(s) pour la recherche du plat {{request()->input('search')}}
                      </h5>
                    @endif
                </div>
                <button id="smooth_scroll_btn" class="d-none">
                    <i data-feather="chevron-up"></i>
                </button>
            </div>
            {{ $dishes->links() }}
        </x-parts.main>
    </x-parts.container>
@endsection
