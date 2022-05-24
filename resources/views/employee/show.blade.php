@extends('employee.layouts.main')
@section('title')
    Restaurants
@endsection
@section('content')
    <x-parts.container type="container-fluid">
        <x-parts.main>
            <div class="container mt-3 mx-auto">
                <h2 class="dishes_title mb-2">Restaurants {{ $restaurant->user->firstname }} </h2>
                <div class="row mt-3">

                    {{-- Restaurants --}}

                    <div class="col-3  my-1">
                        <div class="card">
                            <div class="restaurant___img">
                                @if (stristr($restaurant->user->profile, 'avatar.png') || $restaurant->user->profile === null)
                                    <img src="{{ asset('storage/avatars/restaurant.png') }}"
                                        alt="{{ $restaurant->user->firstname }}" class="border rounded-top">
                                @else
                                    <img src="{{ asset('storage/avatars/' . $restaurant->user->profile) }}" alt="laperle"
                                        class="border rounded-top">
                                @endif
                            </div>
                            <div class="restaurant_info border-top rounded-bottom" style="background: #fdfdfd;">
                                <div class="p-1 restaurant_desc">
                                    <p class="small text-justify">
                                        {{ $restaurant->description }}
                                    </p>
                                </div>
                                <div class="p-1 mt-1 ">
                                    <h5>
                                       <span Class='dishes_title'> Slogan :</span> {{$restaurant->slogan}}
                                    </h5>
                                </div>
                                <div class="p-1 ">
                                    <h6>
                                       <span class='dishes_title'>Situé:</span> {{$restaurant->localization}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9  my-1">
                        <div class="card">
                            <div class="card-header">
                                <h3 class='dishes_title'>
                                    Jour/Horaire de disponibilité
                                </h3>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    @foreach ($obj as $key => $data1)
                                                        @foreach ($data1 as $keys => $data1s)
                                                            <th scope="col">{{ $key }}</th>
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($obj as $key => $data1)
                                                        @foreach ($data1 as $keys => $data1s)
                                                            <td>{{ $keys }} : {{ $data1s }}</td>
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </blockquote>
                            </div>
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
