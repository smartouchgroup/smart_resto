@extends('employee.layouts.main')
@section('title') Restaurants @endsection
@section('content')
<x-parts.container type="container-fluid">
    <x-parts.main>
        <div class="container mt-3 mx-auto">
            <h2 class="dishes_title mb-2">Restaurants</h2>
            <div class="row mt-3">

                {{-- Restaurants --}}

                @forelse ($restaurants as $restaurant)
                <div class="col-6 col-xl-3 my-1">
                    <div class="card">
                        <div class="restaurant___img">
                            @if (stristr($restaurant->user->profile, 'avatar.png') || $restaurant->user->profile ===
                            null)
                            <img src="{{ asset('storage/avatars/restaurant.png') }}"
                                alt="{{ $restaurant->user->firstname }}" class="border rounded-top">
                            @else
                            <img src="{{ asset('storage/avatars/' . $restaurant->user->profile) }}" alt="laperle"
                                class="border rounded-top">
                            @endif
                        </div>
                        <div class="restaurant_info border-top rounded-bottom" style="background: #fdfdfd;">
                            <h3 style="text-indent: 15px;" class="family_popone mt-1">{{ $restaurant->user->firstname }}
                            </h3>
                            <div class="p-1 restaurant_desc">
                                <p class="small">
                                    {{ $restaurant->description }}
                                </p>
                            </div>
                        </div>
                        <form action="{{ route('account.show',$restaurant->id) }}" class="mt-1">
                            <button type="submit">Détails</button>
                        </form>
                    </div>
                </div>
                @empty
                <p>Aucun restaurant disponible pour votre Structure.</p>
                @endforelse
            </div>
        </div>
        <button id="smooth_scroll_btn" class="d-none">
            <i data-feather="chevron-up"></i>
        </button>
    </x-parts.main>
</x-parts.container>
@endsection
