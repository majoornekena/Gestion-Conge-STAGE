<?php
use App\FormatDate;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Liste collaborateur</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ asset('/css/alert.css') }}" rel="stylesheet" media="screen" />
    <link href="{{ asset('/css/imgprofile.css') }}" rel="stylesheet" media="screen" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    @include('components.admin_components.Navigation')
    <div id="layoutSidenav">
        @include('components.admin_components.SideBar', ['userData' => $userData])
    </div>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Liste Collaborateur</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Liste des collaborateurs : Découvrez les employés actuellement
                        affectés aux branches. Vous trouverez ici leurs noms, images de profil et dates d'affectation.
                    </li>
                </ol>
                <div class="row">

                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Collaborateur DataTable
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Collaborateur</th>
                                    <th>Branche</th>
                                    <th>Date d'affectation</th>
                                    <th>Actions</th> <!-- Ajout de la colonne Actions -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Collaborateur</th>
                                    <th>Branche</th>
                                    <th>Date d'affectation</th>
                                    <th>Actions</th> <!-- Ajout de la colonne Actions -->
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($listeEmploye as $employe)
                                <tr>
                                    <td>
                                        <div class="float-start">
                                            <img src="data:image/png;base64,{{ $employe->imgprofile }}"
                                                alt="Image Profile" width="25px" height="25px"
                                                style="border-radius: 50%; object-fit: cover;">

                                            <strong>{{ $employe->nom }} {{ $employe->prenom }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $employe->branche }}</td>
                                    <td>{{ FormatDate::format($employe->dateaffectation) }}</td>

                                    <!-- <td>{{ $employe->dateaffectation }}</td> -->
                                    <td>
                                        <!-- Liens pour voir et supprimer les informations -->
                                        <a href="{{ url('/UpdateActe') }}/{{ $employe->idemploye }}">
                                            <i class="fas fa-eye"></i> <!-- Icône pour voir -->
                                        </a>
                                        <a href="#" style="margin: 0 10px;"
                                            onclick="showConfirmation('{{ $employe->nom }} {{ $employe->prenom }}', '{{ $employe->branche }}', '{{ $employe->imgprofile }}', '{{ url('/admin/DeleteEmploye') }}/{{ $employe->idemploye }}'); return false;">
                                            <i class="fas fa-trash-alt"></i> <!-- Icône pour supprimer -->
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
        @include('components.admin_components.Footer')
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('js/confirmationDeleteEmploye.js') }}"></script>


</body>

</html>