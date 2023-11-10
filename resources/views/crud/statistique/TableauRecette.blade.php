<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tableau de bord des recettes par mois</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
    <style>
    /* Ajoutez ici vos styles spécifiques à la page */
    #chartRecettesContainer {
        width: 100%;
        max-width: 800px;
        margin: 20px auto;
    }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('template.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template.Header')
                <div class="container-fluid">
                    <h2>Tableau de bord des recettes par mois</h2>

                    <form action="{{ url('/recetteparmois') }}" method="GET">
                        <div class="form-group">
                            <label for="annee">Filtrer par année :</label>
                            <select name="annee" id="annee" class="form-control">
                                <option value="">Toutes les années</option>
                                @foreach ($annees as $annee)
                                <option value="{{ $annee }}" @if ($anneeFiltre==$annee) selected @endif>{{ $annee }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </form>

                    <table class="table text-nowrap mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Mois</th>
                                <th>Année</th>
                                <th>Recette totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $recette)
                            @php
                            $mois = $recette['mois'];
                            $annee = $recette['annee'];
                            $recetteTotale = $recette['recette_totale'];
                            @endphp
                            <tr>
                                <td>{{ FormatMois::formatMois($mois) }}</td>
                                <td>{{ $annee }}</td>
                                <td>{{ FormatNumber::formatter($recetteTotale) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>Total des Recette : <strong
                                        style="color: green;">{{ FormatNumber::formatter( $recettesTotales) }}</strong>
                                    </h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="chartRecettesContainer">
                        <canvas id="chartRecettes" width="100%" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
    </div>
    <script>
    // Récupérer les données des recettes par mois
    var recettes = @json($data);

    // Extraire les mois et les recettes totales
    var mois = [];
    var recettesTotales = [];
    for (var key in recettes) {
        if (recettes.hasOwnProperty(key)) {
            var recette = recettes[key];
            mois.push(recette.mois + '/' + recette.annee);
            recettesTotales.push(recette.recette_totale);
        }
    }

    // Créer le graphique avec Chart.js
    var ctx = document.getElementById('chartRecettes').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: mois,
            datasets: [{
                label: 'Recette totale',
                data: recettesTotales,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return value + '€';
                        }
                    }
                }
            }
        }
    });
    </script>
</body>

</html>