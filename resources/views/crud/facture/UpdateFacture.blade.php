
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
                <div class="col-12 text-center">
                    <h2 class="section-title">Modifier une facture</h2>
                </div>
                <!-- topic-item -->
                <div class="col-lg-12">
                    <form action="{{ url('/Update_FACTURE') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idfacture" value="{{ $facture->idfacture }}">
                        <div class="mb-3">
                            <label for="idpatient" class="form-label">Patient:</label>
                            <select name="idpatient" id="idpatient" class="form-control">
                                @foreach($patients as $patient)
                                <option value="{{ $patient->idpatient }}" {{ $patient->idpatient == $facture->idpatient ? 'selected' : '' }}>{{ $patient->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="datefacture" class="form-label">Date de la facture:</label>
                            <input type="date" name="datefacture" class="form-control" id="datefacture" value="{{ $facture->datefacture }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
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
