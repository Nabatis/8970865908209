<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PustakaDigital</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card bg-light text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4 ">Reset Password</p>

                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $errror)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif


                                    <form class="mx-1 mx-md-4">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="formpw flex-fill mb-0">
                                                <input type="password" id="password" class="form-control"
                                                    placeholder="Password" />
                                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="formpw flex-fill mb-0">
                                                <input type="password" id="password1" class="form-control"
                                                    placeholder="Confirm Password" />
                                                <i class="bi bi-eye-slash" id="togglePassword1"></i>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-start mx-0 mb-3 mb-lg-3">
                                            <button type="button" class="btn btn-primary btn-lg px-5">Confirm</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
