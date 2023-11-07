<?php
use App\FormatNumber;
use App\FormatDate;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Liste des TypeDepense</title>
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
                    <form action="{{ url('/rechercheTypeDepense') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="text" name="motcle" class="form-control" placeholder="Rechercher">
                            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                        </div>
                    </form>
                    <a class="btn btn-primary" href="{{ url('/AjoutTypeDepense') }}">Ajouter un TypeDepense</a>
                    <br>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Code</th>
                                    <th>Budget annuel</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listeTypeDepense as $typedepense)
                                <tr>
                                    <td>{{ $typedepense->idtypedepense }}</td>
                                    <td>{{ $typedepense->typedepense }}</td>
                                    <td>{{ ($typedepense->code) }}</td>
                                    <td>{{ FormatNumber::formatter($typedepense->budget_annuel) }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('/UpdateTypeDepense', ['id' => $typedepense->idtypedepense]) }}">Modifier</a>
                                        <a class="btn btn-primary" href="{{ url('/Delete_TYPEDEPENSE', ['id' => $typedepense->idtypedepense]) }}">Supprimer</a>
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
                                    href="{{ $currentPage == 1 ? '#' : url('/paginationtypedepense') }}/{{ $currentPage - 1 }}"
                                    aria-label="Précédent">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                            </li>
                            @foreach($listeNumeroPage as $numeroPage)
                            <li class="page-item {{ $numeroPage == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ url('/paginationtypedepense') }}/{{ $numeroPage }}">{{ $numeroPage }}</a>
                            </li>
                            @endforeach
                            <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $currentPage == $lastPage ? '#' : url('/paginationtypedepense') }}/{{ $currentPage + 1 }}"
                                    aria-label="Suivant">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap
