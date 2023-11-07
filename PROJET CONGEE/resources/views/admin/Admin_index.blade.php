<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets3/css/login.css') }}">
    <title>Se connecter</title>
</head>

<body>
    <div style="height: 100vh;" class="container-fluid d-flex justify-content-center align-items-center login-view">
        <div class="row col-md-6">
            {{-- <div class="col-md-6">
                <h1>Se connecter</h1>
                <h3>Bienvenu sur notre page de connexion</h3>
            </div> --}}
            <div class="col-md-6 border rounded p-3 shadow login-form mx-auto">
                <form action="{{ url('/log_admin') }}" method="post" class="mb-2">
                    @csrf
                    <div class="row justify-content-center mb-2 mt-3">
                        <h2>Login</h2>
                    </div>
                    <div class="form-group form-comp">
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="mail" value="hardi" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group form-comp">
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="password" name="mdp" value="hardi" id="password" class="form-control"
                            placeholder="Mot de passe">
                    </div>
                    <div class="form-group form-comp">
                        <button class="btn btn-primary w-100 " type="submit">Connexion</button>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets3/js/jquery-slim-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets3/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
