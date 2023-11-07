<?php
use App\FormatNumber;
use App\FormatDate;
?>
<!DOCTYPE html>
<html>

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
                <div class="col-12 text-center">
                    <h2 class="section-title">La liste des dépenses</h2>
                </div>
                <!-- topic-item -->
                <div class="col-lg-12">
                    <!-- Formulaire de recherche -->
                    <form action="{{ url('/rechercheDepense') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="motcle" class="form-label">Mot clé:</label>
                            <input type="text" name="motcle" class="form-control" id="motcle">
                        </div>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                    <br>
                    <a class="btn btn-primary" href="{{ url('/AjoutDepense') }}">Ajouter une dépense</a>
                    <br><br><br><br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <h6 class="fw-semibold mb-0">ID</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Type de dépense</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Date</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Quantité</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Montant U</h6>
                                    </th>
                                    <th>
                                        <h6 class="fw-semibold mb-0">Montant Total</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listeDepense as $depense)
                                <tr>
                                    <td>{{ $depense->iddepense }}</td>
                                    <td>{{ $depense->typedepense }}</td>
                                    <td>{{ FormatDate::format($depense->datedepense) }}</td>
                                    <td>{{ $depense->quantite }}</td>
                                    <td>{{ FormatNumber::formatter($depense->montant) }}</td>
                                    <td><strong>{{ FormatNumber::formatter($depense->montant_total) }}</strong></td>
                                    <td>
                                        <a href="{{ url('/UpdateDepense') }}/{{ $depense->iddepense }}">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/Delete_DEPENSE') }}/{{ $depense->iddepense }}">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>{{ FormatNumber::formatter($montantTotalToutesDepenses) }}</strong></td>

                                    <td></td>
                                    <td></td>
                                </tr>

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
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('modification'))
    <div class="alert alert-info">
        {{ session('modification') }}
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