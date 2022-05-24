@extends('admin.layouts.main')
@section('content')
<!-- BEGIN: Header-->

@include('admin.components.header')
<!-- BEGIN: Main Menu-->
@include('admin.components.horizontalBar')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row match-height">
                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="card card-congratulation-medal">
                            <div class="card-body">
                                <h5>Congratulations 🎉 John!</h5>
                                <p class="card-text font-small-3">You have won gold medal</p>
                                <h3 class="mb-75 mt-2 pt-50">
                                    <a href="#">$48.9k</a>
                                </h3>
                                <button type="button" class="btn btn-primary">View Sales</button>
                                <img src="{{asset('dashboard/app-assets/images/illustration/badge.svg')}}"
                                    class="congratulation-medal" alt="Medal Pic" />
                            </div>
                        </div>
                    </div>
                    <!--/ Medal Card -->

                    <!-- Statistics Card -->
                    <div class="col-xl-8 col-md-6 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Statistiques</h4>
                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="briefcase" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{count($organizations)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Structures</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-info me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="square" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$groupsNumber}}</h4>
                                                <p class="card-text font-small-3 mb-0">Groupes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="users" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$employeesNumber}}</h4>
                                                <p class="card-text font-small-3 mb-0">Employées</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i data-feather="coffee" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{count($restaurants)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Restaurants</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
                </div>

                <div class="row match-height">
                    <!-- Company Table Card -->
                    <div class="col-lg-6 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Structures</th>
                                                <th>Nombre d'employéés</th>
                                                <th>Nombre de groupes</th>
                                                <th>Nombre de restaurants</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($organizations as $organization)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                @if (stristr($organization->user->profile,
                                                                'avatar.png'))
                                                                <img src="{{ asset('assets/organization/organization.png') }}"
                                                                    alt="{{ $organization->user->firstname }}"
                                                                    width="40" height="40">
                                                                @else
                                                                <img src="{{ asset('storage/avatars/' . $organization->user->profile) }}"
                                                                    alt="{{ $organization->user->firstname }}" width="40px" height="40px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bolder">{{ $organization->user->firstname }}
                                                            </div>
                                                            <div class="font-small-2 text-muted">
                                                                {{$organization->user->email}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span>{{count($organization->employees)}}</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    {{count($organization->groups)}}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="fw-bolder me-1">{{count($organization->restaurants)}}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <p class="mx-auto small">Aucune Structure disponible</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->

                    <!-- Developer Meetup Card -->
                    <div class="col-lg-6 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Restaurant</th>
                                                <th>Nombre de catégories</th>
                                                <th>Nombre de plats</th>
                                                <th>Disponibilité</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($restaurants as $restaurant)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar rounded">
                                                            <div class="avatar-content">
                                                                @if (stristr($restaurant->user->profile, 'avatar.png'))
                                                                <img src="{{ asset('storage/avatars/restaurant_avatar.png') }}"
                                                                    height="40" width="40"
                                                                    alt="{{ $restaurant->user->firstname }}">
                                                                @else
                                                                <img src="{{ asset('storage/avatars/' . $restaurant->user->profile) }}"
                                                                    height="40" width="40"
                                                                    alt="{{ $restaurant->user->firstname }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bolder">{{$restaurant->user->firstname}}
                                                            </div>
                                                            <div class="font-small-2 text-muted">
                                                                {{$restaurant->user->email}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center">
                                                        <span>{{count($restaurant->categories)}}</span>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-bolder mb-25">{{count($restaurant->dishes)}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div style="width: 20px; height: 20px;"
                                                            class="{{ $restaurant->availability ? 'bg-success' : 'bg-danger' }} rounded-circle mx-auto">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<script src="{{asset('dashboard/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<!-- BEGIN: Footer-->
@include('admin.components.footer')
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
@endsection
