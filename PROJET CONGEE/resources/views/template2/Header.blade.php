<header class="banner overlay bg-cover" data-background="assets/images/banner-alternative.jpg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand px-2" href="index.html">EventMaster</a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-center" id="navigation">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ListeDepense') }}">Liste Depense</a>
                    </li> <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ListeFacture') }}">Liste Facture</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link">Se déconnecter</a>
                    </li>
                   
                    
                    
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
.h3-container {
    border: 2px solid #ccc;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f8f9fa;
}

.h3-container>.left {
    text-align: left;
    flex: 1;
}
</style>