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

<body>
	<!-- header -->
  @include('template2.Header')
	<!-- /header -->
<br>
<br>
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>
                <h3 class="text-center">LOGIN</h3>
                <form action="{{ url('/traitlogfront') }}" method="POST">
                  @csrf
					<div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="mail" class="form-control mb-4 shadow rounded-0" id="exampleInputEmail1" value="tojo" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="mdp" class="form-control mb-4 shadow rounded-0" id="exampleInputPassword1" value="tojo">
                  </div>
                  </div>
				  <input type="submit" value="Se Connecter"  class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">       
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
	<!-- footer -->
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
	<script src="<?php echo asset('assets/plugins/jquery/jquery-1.12.4.js'); ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
	<!-- match-height JS -->
	<script src="<?php echo asset('assets/plugins/match-height/jquery.matchHeight-min.js'); ?>"></script>
	<!-- Main Script -->
	<script src="<?php echo asset('assets/assets/script.js'); ?>"></script>
</body>

</html>
