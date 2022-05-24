
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
    <title>Reinitialisation de mot de passe</title>
</head>
<body class="fond">
    <main class="login-form " style="margin-top:15%">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reinitialisation du mot de passe</div>
                        <div class="card-body">
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
                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row ">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Adresse Email valide</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" placeholder='Entrez votre adresse valide' name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row my-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Nouveau Mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control"  placeholder='Entrez votre nouveau mot de passe' name="password" required autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmer le mot de passe</label>
                                    <div class="col-md-6">
                                        <input type="password" placeholder='confirmer  votre nouveau mot de passe' class="form-control" name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-5 mt-4 ">
                                    <button type="submit" class="btn bg-primar text-white">
                                        Reinitialiser mot passe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </main>
</body>
</html>
