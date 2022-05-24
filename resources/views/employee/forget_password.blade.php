<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/employee/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Mot de passe oublié</title>
</head>

<body class="fond">
    <div class="container space_top">
        <div class="carde rounded">
            <div class="row">
                <div class="col-6 d-none d-xl-block sup">
                    <img src="{{ asset('assets/employee/left side.png') }}" width="100%" height="100%" alt="">
                </div>
                <div class="col-10 col-xl-6 mx-auto d-flex flex-column justify-content-center">
                    <div class="logo text-center my-5 ">
                        <img src="{{ asset('assets/employee/logo.png') }}" width="100px" alt="">
                    </div>
                    <h2 class="text-center fw-bold gray_color">
                        Mot de passe oublié !!!
                    </h2>
                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                    </div>
                    @endif
                    <div class="">
                        <form action="{{ route('forget.password.post') }}" method="post" class="">
                            @csrf
                          <div class="container">
                            @error('errors')
                            <div class="alert alert-danger mt-1 alert-dismissible" role="alert">
                          <div class="alert-body d-flex align-items-center">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                <span> {{$message}}</span>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @enderror
                            <div class="mb-4 ">
                                <label for="exampleInputEmail1" class="form-label gray_color fw-bold centre">Adresse Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Entrer votre adresse email valide">
                                     @if($errors->has('email'))
                                     <div class="text-danger">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-50"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                                          <small>{{$errors->first('email') }}</small>
                                     </div>
                                     @endif
                            </div>
                             <div class="text-center mt-4">
                                <button type="submit" class="btn bg-primar ">Valider </button>
                             </div>
                          </div>
                            </form>
                            <p class="text-center  gray_color fw-bold smt_group">
                                copyright - 2022 | Smart Touch Group
                            </p>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
