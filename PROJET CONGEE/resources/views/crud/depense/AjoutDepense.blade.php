<?php use App\FormatNumber; use App\FormatDate; ?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Ajout d'une dépense</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/themify-icons/themify-icons.css'); ?>">
    <!--Favicon-->
    <link rel="icon" href="<?php echo asset('assets/images/favicon.png" type="image/x-icon'); ?>">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link href="<?php echo asset('assets/assets/style.css'); ?>" rel="stylesheet" media="screen" />
</head>

<body id="page-top">
    <!-- header -->
    @include('template2.Header')
    <!-- /header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ url('/Ajout_DEPENSE') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="code" class="form-label">Type de dépense:</label>
                        <input type="text" name="code" id="code" class="form-control">


                    </div>
                    <div class="mb-3">
                        <label for="jour" class="form-label">Jour:</label>
                        <select name="jour" id="jour" class="form-control">
                            <?php for ($i = 1; $i <= 31; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mois" class="form-label">Mois:</label><br>
                        <input type="checkbox" name="mois[]" value="1"> Janvier<br>
                        <input type="checkbox" name="mois[]" value="2"> Février<br>
                        <input type="checkbox" name="mois[]" value="3"> Mars<br>
                        <input type="checkbox" name="mois[]" value="4"> Avril<br>
                        <input type="checkbox" name="mois[]" value="5"> Mai<br>
                        <input type="checkbox" name="mois[]" value="6"> Juin<br>
                        <input type="checkbox" name="mois[]" value="7"> Juillet<br>
                        <input type="checkbox" name="mois[]" value="8"> Août<br>
                        <input type="checkbox" name="mois[]" value="9"> Septembre<br>
                        <input type="checkbox" name="mois[]" value="10"> Octobre<br>
                        <input type="checkbox" name="mois[]" value="11"> Novembre<br>
                        <input type="checkbox" name="mois[]" value="12"> Décembre<br>
                    </div>
                    <div class="mb-3">
                        <label for="annee" class="form-label">Année:</label>
                        <input type="number" name="annee" class="form-control" id="annee">
                    </div>
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant:</label>
                        <input type="text" step="0.01" name="montant" class="form-control" id="montant">
                    </div>
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité:</label>
                        <input type="number" step="0.01" name="quantite" class="form-control" id="quantite">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <br><br><br><br>
                <form action="{{ url('/ImporterDepenses') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="fichier_csv" class="form-label">Importer depuis un fichier CSV:</label>
                        <input type="file" name="fichier_csv" id="fichier_csv">
                        <button type="submit" class="btn btn-primary">Importer</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ** JS assets/plugins Needed for the Project ** -->
    <!-- jquiry -->
    <script src="<?php echo asset('assets/plugins/jquery/jquery-1.12.4.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
    <!-- match-height JS -->
    <script src="<?php echo asset('assets/plugins/match-height/jquery.matchHeight-min.js'); ?>"></script>
    <!-- Main Script -->
    <script src="<?php echo asset('assets/assets/script.js'); ?>"></script>
</body>

</html>