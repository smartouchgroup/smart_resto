<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('dashboard/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{ asset('dashboard/app-assets/vendors/js/feather-icons/feather-icons.min.js') }}"></script>
    <title>@yield('title')</title>
    @yield('addititonal_style')
</head>

<body>
    <div id="loader">
        <div id="loader_img">
            <img src="{{ asset('logo.png') }}" alt="Smart Resto">
        </div>
        <div class="d-flex justify-content-center mt-1 text-loader">
            <div class="spinner-border" role="status">
            </div>
        </div>
    </div>
    @yield('content')
    <script src="{{ asset('dashboard/app-assets/vendors/js/bootstrap/bootstrap.min.js') }}"></script>

    <script>
        feather.replace()
    </script>

    <script>
        window.addEventListener('load', function() {
            document.querySelector('#loader').classList.add('loader_slide_up')
            setTimeout(() => {
                document.querySelector('#loader').classList.add('d-none')
            }, 1000);
        })
    </script>

    @yield('additional_script')
</body>

</html>