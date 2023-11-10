<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tableau de bord des dépenses par mois</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
    <style>
    /* Ajoutez ici vos styles spécifiques à la page */
    #chartDepensesContainer {
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
                    <h2>Tableau de bord des dépenses par mois</h2>

                    <form action="{{ url('/depenseparmois') }}" method="GET">
                        <div class="form-group">
                            <label for="annee">Filtrer par année :</label>
                            <select class="form-control" id="annee" name="annee">
                                <option value="">Toutes les années</option>
                                @foreach ($annees as $annee)
                                <option value="{{ $annee }}" {{ $annee == $anneeFiltre ? 'selected' : '' }}>{{ $annee }}
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
                                <th>Montant total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $depense)
                            @php
                            $mois = $depense['mois'];
                            $annee = $depense['annee'];
                            $montantTotal = $depense['montant_total'];
                            @endphp
                            <tr>
                                <td>{{ FormatMois::formatMois($mois) }}</td>
                                <td>{{ $annee }}</td>
                                <td>{{ FormatNumber::formatter($montantTotal) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Coût total des dépenses : <strong
                                        style="color: red;">{{ FormatNumber::formatter($depensesTotales) }}</strong></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="chartDepensesContainer">
                        <canvas id="chartDepenses" width="100%" height="300"></canvas>
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
        <script>
        // Récupérer les données des dépenses par mois
        var depenses = @json($data);

        // Extraire les mois et les montants des dépenses
        var mois = [];
        var montants = [];
        for (var key in depenses) {
            if (depenses.hasOwnProperty(key)) {
                var depense = depenses[key];
                mois.push(depense.mois + '/' + depense.annee);
                montants.push(depense.montant_total);
            }
        }

        // Créer le graphique avec Chart.js
        var ctx = document.getElementById('chartDepenses').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Montant total',
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

    </div>
</body>

</html>