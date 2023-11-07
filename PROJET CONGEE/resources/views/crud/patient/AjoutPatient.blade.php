<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AJOUT PATIENT</title>
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
                    <form action="{{ url('/Ajout_PATIENT') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du patient:</label>
                            <input type="text" name="nom" class="form-control" id="nom" aria-describedby="nomHelp">

                        </div>

                        <div class="mb-3">
                            <label for="datenaissance" class="form-label">Date de naissance:</label>
                            <input type="date" name="datenaissance" class="form-control" id="datenaissance">

                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre:</label>
                            <select name="genre" class="form-control" id="genre">
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="remboursement" class="form-label">Remboursement:</label>
                            <select name="remboursement" class="form-control" id="remboursement">
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
</div>


                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>

                </div>

            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
</body>

</html>