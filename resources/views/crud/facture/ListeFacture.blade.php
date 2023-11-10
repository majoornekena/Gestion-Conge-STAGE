<?php
use App\FormatNumber;
use App\FormatDate;
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Dot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="dot" />

    <!-- ** CSS assets/plugins Needed for the Project ** -->

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

<body>
    <!-- header -->
    @include('template2.Header')
    <!-- /header -->

    <!-- topics -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-16 text-center">
                    <h2 class="section-title">La liste des factures</h2>
                </div>
                <!-- topic-item -->
                <div class="col-lg-16">
                    <!-- Formulaire de recherche -->
                    <form action="{{ url('/rechercheFacture') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="motcle" class="form-label">Mot clé:</label>
                            <input type="text" name="motcle" class="form-control" id="motcle">
                        </div>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                    <br>
                    <a class="btn btn-primary" href="{{ url('/AjoutFacture') }}">Ajouter une facture</a>
                    <br><br><br><br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <h6 class="fw-semibold mb-0">ID</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Patient</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Genre</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Date Naissance</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Date Facture</h6>
                                    </th><th>
                                        <h6 class="fw-semibold mb-0">Etat Remboursement</h6>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listeFacture as $facture)
                                <tr>
                                    <td>{{ $facture->idfacture }}</td>
                                    <td>{{ $facture->patient_nom }}</td>
                                    <td>{{ $facture->patient_genre }}</td>
                                    <td>{{ FormatDate::format($facture->patient_datenaissance) }}</td>
                                    <td>{{ FormatDate::format($facture->datefacture) }}</td>
                                    <td>{{ $facture->etatremboursement }}</td>

                                    <td>
                                        <a 
                                            href="{{ url('/UpdateFacture') }}/{{ $facture->idfacture }}">Modifier</a>
                                    </td>
                                    <td>
                                        <a
                                            href="{{ url('/Delete_FACTURE') }}/{{ $facture->idfacture }}">Supprimer</a>
                                    </td>
                                    <td>
                                        <a 
                                            href="{{ url('/AjoutDetailFacture') }}/{{ $facture->idfacture }}">AjoutDetails</a>
                                    </td><td>
                                        <a 
                                            href="{{ url('/DetailsFacture') }}/{{ $facture->idfacture }}">DetailsFacture</a>
                                    </td><td>
                                        <a 
                                            href="{{ url('/Rembourser_FACTURE') }}/{{ $facture->idfacture }}">Rembourser</a>
                                    </td><td>
                                        <a 
                                            href="{{ url('/Annuler_REMBOURSEMENT') }}/{{ $facture->idfacture }}">AnnulerREMB</a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /topics -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('suppression'))
    <div class="alert alert-success">
        {{ session('suppression') }}
    </div>
    @endif
    @if(session('modification'))
    <div class="alert alert-info">
        {{ session('modification') }}
    </div>
    @endif @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <!-- footer -->

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
