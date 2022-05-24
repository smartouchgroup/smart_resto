<div class="col-6 col-md-4 col-lg-3 col-xl-2 my-1">
    <div class="card  p-0 mx-auto rounded">
        <div class="dish_img_container">
            @if (stristr('avatar.png', $dish->restaurant->user->profile))
                <img src="{{ asset('storage/avatars/' . 'restaurant_avatar.png') }}" class="restaurant_img"
                    alt="{{ $dish->restaurant->user->firstname }}"
                    title="Restaurant {{ $dish->restaurant->user->firstname }}">
            @else
                <img src="{{ asset('storage/avatars/' . $dish->restaurant->user->profile) }}" class="restaurant_img"
                    alt="{{ $dish->restaurant->user->firstname }}"
                    title="Restaurant {{ $dish->restaurant->user->firstname }}">
            @endif
            <img src="{{ asset('storage/dishes' . '/' . $dish->picture1) }}" alt="{{ $dish->name }}"
                class="dish_img rounded-top">
        </div>
        <div class="dish_info">
            <p class="dish_name">{{ $dish->name }}</p>
            <p class="small category">
                <span>Catégorie: </span>
                <span class="text-italic">{{ $dish->category->name }}</span>
            </p>
        </div>

        <form action="{{ route('command.store') }}" method="post" id="confirm__dish__form" style="">
            @csrf
            <input type="hidden" name="employeeId" value="{{ Auth::user()->custom->id }}">
            <input type="hidden" name="dishId" value="{{ $dish->id }}">
            <input type="hidden" name="restaurantId" value="{{ $dish->restaurant->user->id }}">
            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
            <button type="submit">Commander</button>
        </form>

        {{-- <button type="button" class="btn dropdown-item confirm__dish__btn" data-bs-toggle="modal"
            data-bs-target="#confirmModal" data-route="{{ route('command.store') }}">
            <span class="btn btn-warning">Commander</span>
        </button> --}}
    </div>
    {{-- <div class="modal fade modal-danger text-start" id="confirmModal" tabindex="-1" aria-labelledby="myModalLabel120"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel120">Attention !!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Vous êtes sur le point de commander cet plat
                    Etes-vous vraiment sûr ?
                </div>
                <div class="modal-footer">
                    <form action="" method="post" id="confirm__dish__form">
                        @csrf
                        <input type="hidden" name="employeeId" value="{{ Auth::user()->custom->id }}">
                        <input type="hidden" name="dishId" value="{{ $dish->id }}">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
{{-- <script>
    const form = document.querySelector('#confirm__dish__form')
    const confirm__dish__btns = Array.from(document.querySelectorAll('.confirm__dish__btn'))

    confirm__dish__btns.forEach(confirm__dish__btn => {
        const route = confirm__dish__btn.dataset.route;
        confirm__dish__btn.addEventListener('click', _ => form.setAttribute('action', route))
    });
</script> --}}

