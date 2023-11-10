<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" media="screen" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Réinitialiser le mot de passe</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/Reset_PASSWORD') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="mail"
                                                placeholder="name@example.com" required />
                                            <label for="inputEmail">Adresse e-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="mdp"
                                                placeholder="Nouveau mot de passe" required />
                                            <label for="inputPassword">Nouveau mot de passe</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputConfirmPassword" type="password"
                                                name="mdp_confirm" placeholder="Confirmer le nouveau mot de passe"
                                                required />
                                            <label for="inputConfirmPassword">Confirmer le nouveau mot de passe</label>
                                        </div>
                                        <span id="errorText" class="text-danger"></span>
                                        @if(session('erreur'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('erreur') }}
                                        </div>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="{{ url('/login') }}">Retour à la page de
                                                connexion</a>
                                            <button class="btn btn-primary" type="submit" >Réinitialiser le mot
                                                de passe</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
    document.getElementById('inputPassword').addEventListener('input', function() {
        checkPasswords();
    });

    document.getElementById('inputConfirmPassword').addEventListener('input', function() {
        checkPasswords();
    });

    function checkPasswords() {
        var password = document.getElementById('inputPassword').value;
        var confirmPassword = document.getElementById('inputConfirmPassword').value;
        var errorText = document.getElementById('errorText');
        var submitButton = document.querySelector('button[type="submit"]');

        if (password === confirmPassword) {
            errorText.textContent = '';
            submitButton.disabled = false;
        } else {
            errorText.textContent = 'Les mots de passe ne correspondent pas';
            submitButton.disabled = true;
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>