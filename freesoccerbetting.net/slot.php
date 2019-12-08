<?php
require_once 'core/init.php';
require_once 'Gplus.php';
if (empty($_SESSION['ip'])) {
    $_SESSION['ip'] = Admin::GetIp();
}
if (empty($_SESSION['city'])) {
   $_SESSION['City']= Admin::GetCity($_SESSION['ip']);
   $translate = Profil::Translate($_SESSION['City']);
}



?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=Admin::SiteDesc()?>">
        <title><?=Admin::SiteName()?></title>
        <link rel="shortcut icon" type="img/x-icon" href="images/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/one-page-wonder.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider-css.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
    <body>
        <ul class="cb-slideshow">
            <li><span>Image 01</span></li>
            <li><span>Image 02</span></li>
        </ul>
        
        <!-- Navigation -->
        <div class="example3">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?=Config::get('site_url')?>"><img src="<?=Admin::Logo()?>" alt="<?=Admin::SiteName()?>">
                        </a>
                    </div>
                    <div id="navbar3" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <?=Login::GetLogIn()?>

                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!--/.container-fluid -->
            </nav>
        </div>

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-title">
                <h1 class="text-center"><?=$translate['header_text']?></h1>
                </div>
            </div>
        </div>
        <div class="container" id="container-bg">
            
             
                <br>
            <div class="row">

                 <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 stake-container">

                    <?php
                 if (isset($_SESSION['id'])) {
                     $user_id = $_SESSION['id'];
                               Game::Slot($user_id);
                               
                }else{
                echo "<p style='color:red;'>Please log in to play soccer slot online free</p>";
                }?>


                </div>

               
            </div>

           
          
            <!-- Footer -->

        </div>
        <footer id="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <p class="text-center copy-color">&copy; Copyright 2017 Ticket1x2.com <a target="_blank" href="https://play.google.com/store/apps/details?id=com.wFreeSoccerBettingGame_4254336">
<img src="img/android.png"  border="0" alt="Android ticket1x2"></a>

                    </div>
                </div>
            </div>
        </footer>
<script src="js/slider.js" type="text/javascript"></script>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });

            
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60598018-1', 'auto');
  ga('send', 'pageview');

$('#GMT').on('change', function () {
     var selectVal = $("#GMT option:selected").val();
});

        </script>

    </body>
</html>
