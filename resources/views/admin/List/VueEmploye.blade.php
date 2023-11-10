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
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet" media="screen" />
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
                <ol class="breadcrumb mb-4">
                </ol>
                <div class="container">
                    <div class="main-body">

                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="main-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                            </ol>
                        </nav>
                        <!-- /Breadcrumb -->

                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="data:image/png;base64,{{ $employee->imgprofile }}"
                                                alt="{{ $employee->nom }}" class="rounded-cover" width="150">
                                            <div class="mt-3">
                                                <h4>{{ $employee->nom }} {{ $employee->prenom }}</h4>
                                                <p class="text-secondary mb-1">{{ $additionalInfo->branche }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Affecté(e) le</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                {{ FormatDate::format($additionalInfo->dateaffectation) }} </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                {{ $employee->mail }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Téléphone</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                {{ $employee->phone }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Date de Naissance</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                            {{ FormatDate::format($employee->datenaissance) }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Sexe</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                {{ $employee->sexe }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Residence</h6>
                                            </div>
                                            <div class="col-sm-8 text-secondary">
                                                {{ $employee->residence }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a class="btn btn-danger " target="__blank"
                                                    href="{{ url('/delete-employee/'.$employee->id) }}">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Demandes de Congé
                                        </div>
                                        <div class="card-body">
                                            <table class="table" id="tablesimple">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Date de Début</th>
                                                        <th scope="col">Date de Fin</th>
                                                        <th scope="col">Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2023-11-15</td>
                                                        <td>2023-11-18</td>
                                                        <td><span class="badge bg-warning text-dark">En Attente</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2023-12-01</td>
                                                        <td>2023-12-05</td>
                                                        <td><span class="badge bg-success">Approuvée</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2023-12-20</td>
                                                        <td>2023-12-25</td>
                                                        <td><span class="badge bg-danger">Refusée</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                                <div class="row gutters-sm">
                                    <div class="col-sm-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Graphique de demande
                                            </div>
                                            <div class="card-body">

                                                <small>Web Design</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Website Markup</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 72%" aria-valuenow="72" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>One Page</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 89%" aria-valuenow="89" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Mobile Template</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Backend API</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Calendrier
                                            </div>
                                            <div class="card-body">
                                                <small>Web Design</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Website Markup</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 72%" aria-valuenow="72" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>One Page</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 89%" aria-valuenow="89" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Mobile Template</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <small>Backend API</small>
                                                <div class="progress mb-3" style="height: 5px">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: 66%" aria-valuenow="66" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        @include('components.admin_components.Footer')
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>

</html>