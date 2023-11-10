<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Modification d'un Typedepense</title>
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
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
                    <form action="{{ url('/Update_TYPEDEPENSE') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idtypedepense" value="{{ $typedepense->idtypedepense }}">
                        <div class="mb-3">
                            <label for="typedepense" class="form-label">Type de dépense:</label>
                            <input type="text" name="typedepense" value="{{ $typedepense->typedepense }}" class="form-control" id="typedepense" aria-describedby="typedepenseHelp">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" name="code" value="{{ $typedepense->code }}" class="form-control" id="code" aria-describedby="codeHelp">
                        </div>
                        <div class="mb-3">
                            <label for="budget_annuel" class="form-label">Budget annuel:</label>
                            <input type="text" name="budget_annuel" value="{{ $typedepense->budget_annuel }}" class="form-control" id="budget_annuel" aria-describedby="budget_annuelHelp">
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
    </div>
</body>
</html>
