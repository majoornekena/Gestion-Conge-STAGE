<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inscription</title>
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
                                    <h3 class="text-center font-weight-light my-4">Inscription</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputNom" name="nom" placeholder="Nom"
                                                required />
                                            <label for="inputNom">Nom</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPrenom" name="prenom"
                                                placeholder="Prénom" required />
                                            <label for="inputPrenom">Prénom</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputDateNaissance" name="datenaissance"
                                                type="date" required />
                                            <label for="inputDateNaissance">Date de Naissance</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="inputSexe" name="sexe" required>
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                            </select>
                                            <label for="inputSexe">Sexe</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputResidence" name="residence"
                                                placeholder="Résidence" required />
                                            <label for="inputResidence">Résidence</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPhone" name="phone"
                                                placeholder="Numéro de téléphone" required />
                                            <label for="inputPhone">Numéro de téléphone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputImage" name="imgprofile" type="file"
                                                accept="image/*" />
                                            <label for="inputImage">Image de profil</label>
                                        </div>
                                        <!-- Les champs existants restent inchangés -->
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="mail"
                                                placeholder="name@example.com" required />
                                            <label for="inputEmail">Adresse e-mail</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="mdp"
                                                placeholder="Mot de passe" required />
                                            <label for="inputPassword">Mot de passe</label>
                                        </div>
                                        @if(session('erreur'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('erreur') }}
                                        </div>
                                        @endif <br><br>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="{{ url('/resetPassword') }}">Mot de passe oublié
                                                ?</a>
                                            <button class="btn btn-primary" type="submit">Inscription</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ url('/login') }}">Vous avez déjà un compte ?
                                            Connectez-vous !</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>