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
    <title>Code identification</title>
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
                    @if($message = Session::get('errors'))
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
                    <h2 class="text-center fw-bold gray_color">
                        Entrez votre code identifiant
                    </h2>

                    <div class="">
                        <form action="{{ route('checkCode') }}" method="post">
                            @csrf
                            <div class="container">
                                <div class="mb-5 row">
                                    <div class="col-2 col-xs-3">
                                        <input type="number" name="firstn" class="form-control mt-4" id='ist' maxlength="1"
                                            onkeyup="clickEvent(this,'sec')" required autocomplete="false">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="secondn" class="form-control mt-4" id="sec" maxlength="1"
                                            onkeyup="clickEvent(this,'third')" required autocomplete="false">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="thirdn" class="form-control mt-4" id="third" maxlength="1"
                                            onkeyup="clickEvent(this,'fourth')" required autocomplete="false">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="fourthn" class="form-control mt-4" id="fourth" maxlength="1"
                                            onkeyup="clickEvent(this,'fifth')" required autocomplete="false">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="fifthn" class="form-control mt-4" id="fifth" maxlength="1"
                                            onkeyup="clickEvent(this,'six')" required autocomplete="false">
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="sixthn" class="form-control mt-4" id="six" maxlength="1" required
                                            autocomplete="false">
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn bg-primar ">Valider</button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center accent  gray_color fw-bold smt_group">
                            copyright - 2022 | Smart Touch Group
                        </p>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    function clickEvent(first,last){
			if(first.value.length){
				document.getElementById(last).focus();
			}
		}
</script>
<style>
    input {
        text-align: center;
    }

    .accent {
        margin-top: 210px;
    }
</style>
<script src="{{ asset('dashboard/app-assets/vendors/js/bootstrap/bootstrap.min.js') }}"></script>
</html>
