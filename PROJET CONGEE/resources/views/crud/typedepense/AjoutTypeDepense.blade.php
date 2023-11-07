<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>AJOUT TYPEDÉPENSE</title>
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
    <script>
        function generateCode() {
            var typedepense = document.getElementById('typedepense').value;
            var code = typedepense.substr(0, 3).toUpperCase();
            document.getElementById('code').value = code;
        }
    </script>
</head>
<body id="page-top">
    <div id="wrapper">
        @include('template.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template.Header')
                <div class="container-fluid">
                    <form action="{{ url('/Ajout_TYPEDEPENSE') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="typedepense" class="form-label">Type de dépense:</label>
                            <input type="text" name="typedepense" class="form-control" id="typedepense" aria-describedby="typedepenseHelp" oninput="generateCode()">
                        </div>
                        <div class="mb-3">
                            <label for="budget_annuel" class="form-label">Budget annuel:</label>
                            <input type="number" step="0.01" name="budget_annuel" class="form-control" id="budget_annuel" aria-describedby="budget_annuelHelp">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" name="code" class="form-control" id="code" aria-describedby="codeHelp" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
    </div>
</body>
</html>
