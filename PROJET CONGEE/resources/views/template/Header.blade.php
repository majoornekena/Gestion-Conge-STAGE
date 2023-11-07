<nav class="navbar navbar-dark navbar-expand bg-primary shadow mb-4 topbar static-top">
    <div class="container-fluid">
        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
            <i class="fas fa-bars" style="color: white;"></i>
        </button>
        <span style="color: rgb(255,255,255);font-weight: bold;font-size: 20px;">EVENEMENTIEL</span>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown d-sm-none no-arrow">
                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <i class="fas fa-search" style="color: white;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="me-auto navbar-search w-100">
                        <div class="input-group">
                            <input class="bg-light form-control border-0 small" type="text" placeholder="Recherche pour ...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary py-0" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
        </ul>
        <a class="btn btn-secondary" href="{{ url('/logout') }}" style="background: rgb(255,255,255);color: var(--bs-dark);border-style: none;">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</nav>
