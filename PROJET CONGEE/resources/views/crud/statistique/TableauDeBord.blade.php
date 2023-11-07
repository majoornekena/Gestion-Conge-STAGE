<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('template.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template.Header')
                <div class="container-fluid">

                    <br>
                    <form action="{{ url('/TableauDeBord') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="annee">Année :</label>
                                    <select class="form-control" name="annee" id="annee">
                                        <option value="">Toutes</option>
                                        <?php
    for ($annee = 2019; $annee <= 2023; $annee++) {
        echo '<option value="' . $annee . '">' . $annee . '</option>';
    }
    ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mois">Mois :</label>
                                    <select class="form-control" name="mois" id="mois">
                                        <option value="">Tous</option>
                                        <option value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br><br>
                    <div class="table-responsive">
                        <h4>Recettes</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Acte</th>
                                    <th>Année</th>
                                    <th>Mois</th>
                                    <th>Total Recette</th>
                                    <th>Budget Annuel</th>
                                    <th>Budget Mensuel</th>
                                    <th>Pourcentage Réalisation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recettes as $recette)
                                <tr>
                                    <td>{{ $recette->acte }}</td>
                                    <td>{{ $recette->annee }}</td>
                                    <td>{{ FormatMois::formatMois($recette->mois) }}</td>
                                    <td>{{ FormatNumber::formatter($recette->total_recette) }}</td>
                                    <td>{{ FormatNumber::formatter($recette->budget_annuel) }}</td>
                                    <td>{{ FormatNumber::formatter($recette->budget_mensuel) }}</td>
                                    <td>{{ FormatNumber::formatter($recette->pourcentage_realisation) }} %</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br><br><br>
                    <div class="table-responsive">
                        <h4>Dépenses</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Type de Dépense</th>
                                    <th>Année</th>
                                    <th>Mois</th>
                                    <th>Total Dépense</th>
                                    <th>Budget Annuel</th>
                                    <th>Budget Mensuel</th>
                                    <th>Pourcentage Réalisation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($depenses as $depense)
                                <tr>
                                    <td>{{ $depense->typedepense }}</td>
                                    <td>{{ $depense->annee }}</td>
                                    <td>{{ FormatMois::formatMois($depense->mois) }}</td>
                                    <td>{{ FormatNumber::formatter($depense->total_depense) }}</td>
                                    <td>{{ FormatNumber::formatter($depense->budget_annuel) }}</td>
                                    <td>{{ FormatNumber::formatter($depense->budget_mensuel) }}</td>
                                    <td>{{ FormatNumber::formatter($depense->pourcentage_realisation) }} %</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br><br><br>
                    <div class="table-responsive">
                        <h4>Bénéfices</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Année</th>
                                    <th>Mois</th>
                                    <th>Total Recettes</th>
                                    <th>Total Dépenses</th>
                                    <th>Total Benefice</th>
                                    <th>Budget Mois</th>
                                    <th>% Mois</th>
                                    <th>Total Réalisation Recettes</th>
                                    <th>Total Réalisation Dépenses</th>
                                    <!-- <th>Total Budget Annuel Recettes</th>
                                    <th>Total Budget Annuel Dépenses</th> -->
                                    <th>Total Budget Mensuel Recettes</th>
                                    <th>Total Budget Mensuel Dépenses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($benefices as $benefice)
                                <tr>
                                    <td>{{ $benefice->annee }}</td>
                                    <td>{{ FormatMois::formatMois($benefice->mois) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->total_recettes) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->total_depenses) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->benefice) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->budget_du_mois) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->pourcentage_mois) }} %</td>

                                    <td>{{ FormatNumber::formatter($benefice->total_realisation_recettes) }} %</td>
                                    <td>{{ FormatNumber::formatter($benefice->total_realisation_depenses) }} %</td>
                                    <!-- <td>{{ $benefice->total_budget_annuel_recettes }}</td>
                                    <td>{{ $benefice->total_budget_annuel_depenses }}</td> -->
                                    <td>{{ FormatNumber::formatter($benefice->total_budget_mensuel_recettes) }}</td>
                                    <td>{{ FormatNumber::formatter($benefice->total_budget_mensuel_depenses) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
</body>

</html>