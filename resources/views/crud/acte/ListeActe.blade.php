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
                    <form action="{{ url('/rechercheacte') }}" method="post">
                        {{ csrf_field() }}
                        <input type="text" name="motcle">
                        <input type="submit" value="rechercher">
                    </form>
                    <br>

                    <a class="btn btn-primary" href="{{ url('/AjoutActe') }}"
                        style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Ajouter un Acte</a>
                    <br>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nom</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Budjet Annuel</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Code</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Actions</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listeActe as $acte)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $acte->idacte }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $acte->acte }}
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ FormatNumber::formatter($acte->budget_annuel) }} Ar
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $acte->code }}
                                    </td>
                                    <td class="border-bottom-0">
                                        <a class="btn btn-primary"
                                            href="{{ url('/UpdateActe') }}/{{ $acte->idacte }}"
                                            style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Modifier</a>
                                        <a class="btn btn-primary"
                                            href="{{ url('/Delete_ACTE') }}/{{ $acte->idacte }}"
                                            style="background: var(--bs-gray);border-style: none;margin-top: 5px;">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage == 1 ? '#' : url('/paginationacte') }}/{{ $currentPage - 1 }}"
                                    aria-label="Précédent">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                            </li>
                            @foreach($listeNumeroPage as $numeroPage)
                            <li class="page-item {{ $numeroPage == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ url('/paginationacte') }}/{{ $numeroPage }}">{{ $numeroPage }}</a>
                            </li>
                            @endforeach
                            <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage == $lastPage ? '#' : url('/paginationacte') }}/{{ $currentPage + 1 }}"
                                    aria-label="Suivant">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('suppression'))
            <div class="alert alert-success">
                {{ session('suppression') }}
            </div>
            @endif
            @if(session('modification'))
            <div class="alert alert-info">
                {{ session('modification') }}
            </div>
            @endif
            <br>
        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
</body>

</html>
