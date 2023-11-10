<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tableau de bord des bénéfices par mois</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
    <style>
    /* Ajoutez ici vos styles spécifiques à la page */
    #chartBeneficesContainer {
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
                    <h2>Tableau de bord des bénéfices par mois</h2>
                    <form action="{{ url('/beneficeparmois') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="annee" class="form-select">
                                    <option value="">Toutes les années</option>
                                    @foreach ($annees as $annee)
                                    <option value="{{ $annee }}" {{ $anneeFiltre == $annee ? 'selected' : '' }}>
                                        {{ $annee }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                            </div>
                        </div>
                    </form>
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Mois</th>
                                <th>Année</th>
                                <th>Dépenses</th>
                                <th>Recettes</th>
                                <th>Bénéfices</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($annees as $annee)
                            @for ($mois = 1; $mois <= 12; $mois++) @php $key=$annee . '-' . $mois;
                                $depense=isset($depensesData[$key]) ? $depensesData[$key] : 0;
                                $recette=isset($recettesData[$key]) ? $recettesData[$key] : 0;
                                $benefice=$beneficesData[$key]; @endphp @if ($depense !=0 || $recette !=0) <!-- Vérifie
                                si dépense ou recette est différente de zéro -->
                                <tr>
                                    <td>{{ FormatMois::formatMois($mois) }}</td>
                                    <td>{{ $annee }}</td>
                                    <td>{{ FormatNumber::formatter($depense) }}</td>
                                    <td>{{ FormatNumber::formatter($recette) }}</td>
                                    <td>
                                        <strong class="{{ $benefice >= 0 ? 'text-success' : 'text-danger' }}">
                                            {{ FormatNumber::formatter($benefice) }}
                                        </strong>
                                    </td>
                                </tr>
                                @endif
                                @endfor
                                @endforeach

                        </tbody>
                    </table>

                    <div id="chartBeneficesContainer">
                        <canvas id="chartBenefices" width="100%" height="300"></canvas>
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
    // Récupérer les données des bénéfices par mois
    var benefices = @json($beneficesData);

    // Extraire les mois et les bénéfices
    var mois = [];
    var montants = [];
    for (var key in benefices) {
        if (benefices.hasOwnProperty(key)) {
            var benefice = benefices[key];
            mois.push(key);
            montants.push(benefice);
        }
    }

    // Créer le graphique avec Chart.js
    var ctx = document.getElementById('chartBenefices').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: mois,
            datasets: [{
                label: 'Bénéfices',
                data: montants,
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