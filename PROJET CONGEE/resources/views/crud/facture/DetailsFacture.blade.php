<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
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
                    <h2 class="section-title">Détails de la facture</h2>
                </div>
                <!-- topic-item -->
                <div class="col-lg-12">
                    <!-- Display common facture information -->
                    <h4>Facture ID: {{ $facture->idfacture }}</h4>
                    <h4>Patient: {{ $facture->patient_nom }}</h4>
                    <p>Sexe: {{ $facture->patient_genre }}</p>

                    <p>DateNaissance: {{ FormatDate::format($facture->patient_datenaissance) }}</p>
                    <p>Date Facture: {{ FormatDate::format($facture->datefacture) }}</p>

                    <!-- Display details for the facture -->
                    <!-- Display details for the facture -->
                    <table>
                        <thead>
                            <tr>
                                <th>ID Acte Patient</th>
                                <th>ID Acte</th>
                                <th>Acte</th>
                                <th>Quantité</th>
                                <th>Tarif</th>
                                <th>Tarif Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailsFacture as $detail)
                            <tr>
                                <td>{{ $detail->idactepatient }}</td>
                                <td>{{ $detail->idacte }}</td>
                                <td>{{ $detail->acte }}</td>
                                <td>{{ $detail->quantite }}</td>
                                <td>{{ FormatNumber::formatter($detail->tarif) }}</td>
                                <td>{{ FormatNumber::formatter($detail->tarif_total) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td><td></td><td></td><td></td><td></td>
                                <td>{{ FormatNumber::formatter($tarifTotal) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ url('/exportPDF', $facture->idfacture) }}" target="_blank">Exporter en PDF</a>


                </div>
            </div>
        </div>
    </section>
    <!-- /topics -->

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