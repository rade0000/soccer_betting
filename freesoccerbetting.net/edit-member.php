<?php
require_once 'core/init.php';
if (isset($_SESSION['admin_logged'])) {
           $time_now = Date("Y-m-d");
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
    <head>
        <title><?=Admin::SiteName()?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=Admin::SiteDesc()?>">
        <meta name="author" content="Majstor">
         <meta property="og:title" content="<?=Admin::SiteName()?>" />
        <meta property="og:type" content="<?=Admin::SiteName()?>" />
        <meta property="og:url" content="<?=Config::get('site_url')?>" />
        <meta property="og:image" content="<?=Config::get('site_url')?>/img/unnamed.png" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <!-- NavBar-->
        <nav class="navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=Config::get('site_url')?>"><?=Admin::SiteName()?></a>
                </div>
                <div class="row">
                <div class="col-lg-12 nav-tabs-container">
                    <ul class="nav nav-tabs">
                        <li><a  class="btn btn-info btn-list-dropdown" href="/admin.php">Admin</a></li>
                        <li><a  class="btn btn-info btn-list-dropdown" href="/admin-users.php">Users</a></li>
                        <li><a class="btn btn-info btn-list-dropdown" href="/options.php">Options</a></li>
                        <li><a class="btn btn-info btn-list-dropdown" href="/orders.php">Orders</a></li>
                    </ul>
                    <hr class="h-line">
                    
                </div>
            </div>
            
            </div>
        </nav>
        <!-- Betting table -->
        <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 stake-container">
                             <center><h3 style="color:#ffb84d;">Edit User</h3></center>
                                    
                          <?php
        if (isset($_SESSION['admin_logged'])) {
          
        
          if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Profil::AdminEditProfil($id);
            Game::WinersShowTicketsAdmin($id);
          }
        }
        ?>
                                    
                               
                 </div>
                </div>


            <!-- Footer -->

        </div>
        <footer id="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center copy-color">&copy; Copyright 2016 Ticket1x2.com</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

    </body>
</html>
<?php
}