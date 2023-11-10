<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">INDEX</div>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Tableau De bord
                    </a>
                    <div class="sb-sidenav-menu-heading">LISTE</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Collaborateur <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ url('/admin/ListeEmploye') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Liste des Collaborateurs
                            </a>
                            <a class="nav-link" href="layout-static.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                                Collaborateurs en Congé
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        SIIGFP
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                aria-controls="pagesCollapseAuth">
                                Demandes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                                        En attente
                                    </a>
                                    <a class="nav-link" href="password.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                                        Historique
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#pagesCollapseError" aria-expanded="false"
                                aria-controls="pagesCollapseError">
                                Branches
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-code-branch"></i></div>
                                        + Branche
                                    </a>
                                    <a class="nav-link" href="404.html">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                        Affectation
                                    </a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">AUTRES</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                        Calendrier
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                        Estimation
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <img class="imgprofile" src="data:image/png;base64,{{ $userData->imgprofile }}"
                    alt="Image de profil de l'utilisateur">
                {{ $userData->nom }} {{ $userData->prenom }}
            </div>

        </nav>
    </div>