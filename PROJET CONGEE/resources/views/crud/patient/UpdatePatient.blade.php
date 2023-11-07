<?php
use App\FormatNumber;
use App\FormatDate;
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
                    <form action="{{ url('/Update_PATIENT') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idpatient" value="{{ $patient->idpatient }}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom du patient:</label>
                            <input type="text" name="nom" value="{{ $patient->nom }}" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Date de naissance:</label>
                            <input type="date" name="datenaissance" value="{{ $patient->datenaissance }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre:</label>
                            <select name="genre" class="form-control" id="genre">
                                <option value="M" {{ $patient->genre == 'M' ? 'selected' : '' }}>M</option>
                                <option value="F" {{ $patient->genre == 'F' ? 'selected' : '' }}>F</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remboursement" class="form-label">Remboursement:</label>
                            <select name="remboursement" class="form-control" id="genre">
                                <option value="true" {{ $patient->remboursement == 'true' ? 'selected' : '' }}>True</option>
                                <option value="false" {{ $patient->remboursement == 'false' ? 'selected' : '' }}>False</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
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


</html>
