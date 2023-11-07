<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>EventPro</title>
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

    <!-- topics -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="section-title">Gérez les activités de votre clinique/hôpital</h2>
                </div>
                <!-- topic-item -->
                <div class="col-lg-4 col-sm-6 mb-4">
                    <a href="single.html" class="px-4 py-5 bg-white shadow text-center d-block match-height">
                        <i class="ti-heart icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">Prendre rendez-vous</h3>
                        <p class="mb-0">Planifiez vos rendez-vous médicaux en ligne pour plus de commodité et de
                            flexibilité.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 mb-4">
                    <a href="single.html" class="px-4 py-5 bg-white shadow text-center d-block match-height">
                        <i class="ti-user icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">Nos médecins</h3>
                        <p class="mb-0">Découvrez notre équipe de médecins expérimentés et qualifiés.</p>
                    </a>
                </div>

                <div class="col-lg-4 col-sm-6 mb-4">
                    <a href="communication.html" class="px-4 py-5 bg-white shadow text-center d-block match-height">
                        <i class="ti-comments icon text-primary d-block mb-4"></i>
                        <h3 class="mb-3 mt-0">Communication</h3>
                        <p class="mb-0">Restez informé(e) avec nos canaux de communication dédiés à la clinique/hôpital.</p>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <!-- /topics -->

    <!-- call to action -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section px-3 bg-white shadow text-center">
                        <h2 class="mb-4">Vous avez besoin de soins médicaux urgents?</h2>
                        <p class="mb-4">Contactez notre équipe médicale dès maintenant pour une assistance immédiate.</p>
                        <a href="contact.html" class="btn btn-primary">Contactez-nous</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /call to action -->


    <!-- footer -->
    <footer class="section pb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-md-left text-center">
                    <p class="mb-md-0 mb-4">Copyright © 2020 Designed and Developed by
                        <a href="https://themefisher.com/">themefisher</a>
                    </p>
                </div>
                <div class="col-md-4 text-md-right text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
                                    class="ti-facebook"></i></a></li>
                        <li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
                                    class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item"><a class="text-color d-inline-block p-2" href="#"><i
                                    class="ti-github"></i></a>
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
