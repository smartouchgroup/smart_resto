@extends('employee.layouts.main')
@section('title') Mes tickets @endsection
@section('content')
<x-parts.container type="container-fluid">
    <x-parts.main>
        <div class="container mt-3 mx-auto">
            <h2 class="dishes_title mb-2">Faire un dépot </h2>
            <div class="row mt-2">
                <div class="col-12 col-xl-6">
                    <div class="part mt-2">
                        <div class="py-2 border-bottom d-flex align-items-center">
                            <h1 class="family_popone">Total de mes tickets: {{ $getNumberTickets }}</h1>
                        </div>
                        <h4 class="family_popone">Formulaire d'achat de tickets</h4>
                        <div class="warning my-2 py-1 rounded">
                            <i data-feather="alert-circle"></i>
                            <div class="text-center">
                                <span>Assurez-vous d'avoir du credit dans votre portefeuille avant de procéder à l'achat!
                                    Le nombre total de ticket à acheter ne peut exeder {{ Auth::user()->custom->organization->ticketNumber }} tickets
                                </span>
                            </div>
                        </div>
                        @if($message = Session::get('success'))
                        <div style="width: 98%;" class="mx-auto">
                            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    <span>{{$message}}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        @if($message = Session::get('error'))
                        <div style="width: 98%;" class="mx-auto">
                            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    <span>{{$message}}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        @if($message = Session::get('warning'))
                        <div style="width: 98%;" class="mx-auto">
                            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                                <div class="alert-body d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                    <span>{{$message}}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        @endif
                        <div class="row justify-content-center mt-2">
                            <form action="{{ route('acccount.buy_ticket') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="target">Effectuer l'achat pour :</label>
                                    <select name="employeeId" id="target" class="form-control form-select" required>
                                        <option value="{{ auth()->user()->custom->id }}" selected>Moi</option>
                                        {{-- <option value="">Quelqu'un d'autre</option> --}}
                                    </select>
                                </div>
                                <div class="form-group mt-1">
                                    <label for="tickets_number">Le nombre tickets souhaité</label>
                                    <input type="number" name="ticketNumber" id="tickets_number" class="form-control"
                                        placeholder="Entrez le nombre de ticket" required>
                                </div>
                                <div class="form-group mt-1">
                                    <button type="submit" class="outline-none border-0 rounded">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="part mt-2">
                        <h4 class="family_popone">Historiques d'achat de tickets </h4>
                        <div class="row justify-content-center mt-2">
                            {{-- Deposits --}}

                            @foreach ($numberTickets as $numberTicket)

                            <div class="col-12 mt-1">
                                <div class="rounded bg-white deposit_historic">
                                    <div class="dh_img">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;"
                                            xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M168.266,216.538c-5.272-2.027-11.2,0.605-13.227,5.887c-2.027,5.273,0.604,11.201,5.877,13.228
		c1.218,0.46,2.456,0.686,3.675,0.686c4.115,0,7.995-2.499,9.562-6.573C176.18,224.493,173.549,218.576,168.266,216.538z" />
                                                <path d="M178.197,190.74c-5.283-2.028-11.201,0.604-13.227,5.887c-2.038,5.272,0.594,11.2,5.877,13.227
		c1.208,0.461,2.447,0.686,3.675,0.686c4.115,0,7.985-2.499,9.552-6.573C186.1,198.694,183.47,192.766,178.197,190.74z" />
                                                <path d="M231.007,194.601l-15.767-6.064c-5.274-2.029-11.201,0.603-13.231,5.881c-2.03,5.278,0.604,11.201,5.881,13.231
		l15.767,6.064c1.209,0.465,2.451,0.685,3.673,0.685c4.113,0,7.993-2.497,9.558-6.566
		C238.918,202.554,236.284,196.631,231.007,194.601z" />
                                                <path d="M290.435,181.262c-5.871-2.258-10.511-6.668-13.065-12.414c-2.554-5.748-2.717-12.145-0.46-18.016
		c0.975-2.535,0.903-5.352-0.199-7.833c-0.91-2.045-2.463-3.713-4.398-4.785c3.363-1.853,7.223-2.91,11.326-2.91
		c5.654,0,10.238-4.584,10.238-10.238v-67.57c0-5.654-4.584-10.238-10.238-10.238c-12.984,0-23.547-10.563-23.547-23.547
		c0-5.654-4.584-10.238-10.238-10.238H47.146c-5.654,0-10.238,4.584-10.238,10.238c0,12.984-10.563,23.547-23.547,23.547
		c-5.654,0-10.238,4.584-10.238,10.238v67.57c0,3.737,2.009,6.996,4.999,8.784l-7.436,19.334c-2.031,5.277,0.603,11.201,5.88,13.23
		c12.117,4.661,18.185,18.312,13.524,30.43c-2.03,5.278,0.604,11.201,5.881,13.23l189.197,72.768
		c1.209,0.465,2.451,0.686,3.673,0.686c4.113,0,7.992-2.497,9.557-6.566c3.475-9.034,12.31-15.104,21.985-15.104
		c2.881,0,5.723,0.532,8.446,1.579c2.534,0.975,5.352,0.903,7.833-0.2c2.482-1.103,4.423-3.145,5.397-5.68l24.256-63.066
		C298.345,189.215,295.712,183.291,290.435,181.262z M23.599,66.531c16.068-3.841,28.742-16.516,32.583-32.583h184.637
		c3.841,16.068,16.516,28.742,32.583,32.583v49.497c-16.068,3.841-28.742,16.515-32.583,32.583H56.182
		c-3.841-16.068-16.515-28.742-32.583-32.583V66.531z M256.194,241.769c-1.922-0.257-3.861-0.386-5.812-0.386
		c-14.596,0-28.168,7.388-36.276,19.114l-172.352-66.29c2.182-16.376-5.097-32.755-18.714-42.107l4.599-11.958
		c5.629,4.307,9.269,11.088,9.269,18.707c0,5.654,4.584,10.238,10.238,10.238h128.613c-0.337,0.543-0.632,1.121-0.869,1.74
		c-2.037,5.272,0.605,11.2,5.877,13.227c1.208,0.461,2.458,0.686,3.675,0.686c4.116,0,7.996-2.499,9.552-6.573
		c1.203-3.113,0.765-6.448-0.872-9.08h56.733c2.135,0,4.116-0.655,5.757-1.773c0.628,3.351,1.628,6.655,3.047,9.849
		c3.358,7.553,8.642,13.87,15.298,18.423L256.194,241.769z" />
                                                <path d="M182.282,60.852c5.661,0,10.238-4.586,10.238-10.238c0-5.651-4.577-10.238-10.238-10.238
		c-5.652,0-10.238,4.587-10.238,10.238C172.044,56.266,176.63,60.852,182.282,60.852z" />
                                                <path d="M182.282,88.494c5.661,0,10.238-4.586,10.238-10.238c0-5.662-4.577-10.238-10.238-10.238
		c-5.652,0-10.238,4.576-10.238,10.238C172.044,83.908,176.63,88.494,182.282,88.494z" />
                                                <path d="M182.282,143.779c5.661,0,10.238-4.586,10.238-10.238c0-5.651-4.577-10.238-10.238-10.238
		c-5.652,0-10.238,4.587-10.238,10.238C172.044,139.193,176.63,143.779,182.282,143.779z" />
                                                <path d="M182.282,116.136c5.661,0,10.238-4.586,10.238-10.238c0-5.651-4.577-10.238-10.238-10.238
		c-5.652,0-10.238,4.587-10.238,10.238C172.044,111.55,176.63,116.136,182.282,116.136z" />
                                                <path d="M216.07,101.518h16.892c5.654,0,10.238-4.584,10.238-10.238s-4.584-10.238-10.238-10.238H216.07
		c-5.654,0-10.238,4.584-10.238,10.238S210.416,101.518,216.07,101.518z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dh_text">
                                        <div>
                                            <h5 class="family_popone">Achat de {{$numberTicket->ticketNumber}} tickets</h5>
                                        </div>
                                        <div>
                                            <span class="small">Achat effectué le {{  date("d-m-Y", strtotime($numberTicket->created_at))}} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
