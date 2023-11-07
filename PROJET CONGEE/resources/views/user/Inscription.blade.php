<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>MIKOLO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- theme meta -->
  <meta name="theme-name" content="dot" />

	<!-- ** CSS assets/plugins Needed for the Project ** -->

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
		<!-- themefy-icon -->
		<link rel="stylesheet" href="<?php echo asset('assets/plugins/themify-icons/themify-icons.css'); ?>">
		<!--Favicon-->
		<link rel="icon" href="<?php echo asset('assets/images/favicon.png" type="image/x-icon'); ?>">
		<!-- fonts -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<!-- Main Stylesheet -->
		<link href="<?php echo asset('assets/assets/style.css'); ?>" rel="stylesheet" media="screen" />
	</head>


</head>

<body>
	<!-- header -->
  @include('template2.Header')
	<!-- /header -->
<br>
<br>
	  <!-- contact -->
      <section class="section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h2 class="section-title text-primary">Mettre un Point de Vente dans notre magasin</h2>
              <form action="{{ url('/traitinscfront') }}" method="post">
                @csrf
                <input type="hidden" id="name" name="idmagasin" value="1">
                <input type="text" id="name" name="nom" placeholder="Nom du Point de Vente" class="form-control mb-4 shadow rounded-0">
                <input type="text" id="subject" name="adresse" placeholder="Adresse du Point de Vente"
                  class="form-control mb-4 shadow rounded-0">
				<input type="text" id="subject" name="mail" placeholder="Votre email"
                  class="form-control mb-4 shadow rounded-0">
                <input type="password" id="subject" name="mdp" placeholder="Mot de passe"
                  class="form-control mb-4 shadow rounded-0">
                <button type="submit" value="send" class="btn btn-primary">S'inscrire</button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- /contact -->
    
	<footer class="section pb-4">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8 text-md-left text-center">
					<p class="mb-md-0 mb-4">Copyright © 2020 Designed and Developed by <a
							href="https://themefisher.com/">themefisher</a></p>
				</div>
				<div class="col-md-4 text-md-right text-center">
					<ul class="list-inline">
						<li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
									class="ti-facebook"></i></a></li>
						<li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
									class="ti-twitter-alt"></i></a></li>
						<li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i class="ti-github"></i></a>
						</li>
						<li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
									class="ti-linkedin"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- /footer -->

	<!-- ** JS assets/plugins Needed for the Project ** -->
	<!-- jquiry -->
<!-- ** JS assets/plugins Needed for the Project ** -->
	<!-- jquiry -->
	<script src="<?php echo asset('assets/plugins/jquery/jquery-1.12.4.js'); ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
	<!-- match-height JS -->
	<script src="<?php echo asset('assets/plugins/match-height/jquery.matchHeight-min.js'); ?>"></script>
	<!-- Main Script -->
	<script src="<?php echo asset('assets/assets/script.js'); ?>"></script>
</body>

</html>
