<?php
require_once 'core/init.php';
require_once 'Gplus.php';
if (empty($_SESSION['ip'])) {
    $_SESSION['ip'] = Admin::GetIp();

}
if (empty($_SESSION['city'])) {
   $_SESSION['City']= Admin::GetCity($_SESSION['ip']);
}
$translate = Profil::Translate($_SESSION['City']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=Admin::SiteDesc()?>">
        <meta name="author" content="">
        <title><?=Admin::SiteName()?> Leagues</title>
        <link rel="shortcut icon" type="img/x-icon" href="images/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
        <link rel="shortcut icon" type="image/png" href="<?=Config::get('site_url')?>/img/favicon.png"/>
        <!-- Custom CSS -->
        <link href="css/one-page-wonder.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <ul class="cb-slideshow">
            <li><span>Image 01</span></li>
            <li><span>Image 02</span></li>
        </ul>

        <!-- Navigation -->
        <div class="example3">
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
                    <a class="navbar-brand" href="<?=Config::get('site_url')?>"><img src="img/small_logo.png" alt="<?=Admin::SiteName()?>"></a>                    
                </div>
                <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="menuItem"><a href="users.php"><b><?=$translate['users']?> <i class="fa fa-users" aria-hidden="true"></i></b></a></li>
                        <?php 
                        if (empty($_SESSION['name'])) {
                            
                        echo '<li class="menuItem"><a href="login.php"><b>'.$translate['login'].' <i class="fa fa-sign-in" aria-hidden="true"></i></b></a></li>
                        <li class="menuItem"><a href="register.php"><b>'.$translate['signup'].' <i class="fa fa-user-plus" aria-hidden="true"></i></b></a></li>';
                        }else{
                            echo '<li class="menuItem"><a href="edit-profil.php"><b>'.$translate['edit_profil'].' <i class="fa fa-pencil-square-o" aria-hidden="true"></i></b></a></li>
                        <li class="menuItem"><a href="logout.php"><b>'.$translate['logout'].' <i class="fa fa-sign-out" aria-hidden="true"></i></b></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

            
        <!-- NavBar-->
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
        
            <div class="row">
                <div class="col-lg-12 nav-tabs-container">
                    <ul class="nav nav-tabs">
                        <li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-players"><?=$translate['top_10']?> &nbsp; <span class="caret"></span></a></li>
                        <?php
                        if (isset($_SESSION['id'])) {
    echo '<li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-tickets">'.$translate['winer_tickets'].' &nbsp; <span class="caret"></span></a></li>';
                       echo '<li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-prizes">'.$translate['1x2_prize'].' &nbsp; <span class="caret"></span></a></li>';

                        }
                        ?>
                        <li><a class="btn btn-info btn-list-dropdown"  href="users.php"><?=$translate['users']?> &nbsp; <span class="caret"></span></a></li>
                        <li><a class="btn btn-info btn-list-dropdown"  href="leagues.php"><?=$translate['leagues']?> &nbsp; <span class="caret"></span></a></li>
                    </ul>
                    <hr class="h-line">
                    <div id="accordion">
                        <div class="panel">
                            <div id="table-players" class="collapse table-top-ten">
                                <table class="table table-bordered table-striped table-hover" id="table-list">
                                <thead>
                                        <tr>
                                            <th><?=$translate['position']?></th>
                                            <th><?=$translate['money']?></th>
                                            <th><?=$translate['user']?></th>
                                            <th>Rank</th>
                                            <th><?=$translate['played']?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?=Admin::TopTen()?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="table-tickets" class="collapse table-top-ten">
                                <table class="table table-bordered table-striped table-hover" id="table-list">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th><?=$translate['played']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['you_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['time']?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?=Admin::WinerTickets()?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="table-prizes" class="collapse table-top-ten">
                                <table class="table table-bordered table-striped table-hover" id="table-list">
                                    <thead>
                                        <tr>
                                            <th><?=$translate['name']?></th>
                                            <th><?=$translate['money']?></th>
                                            <th><?=$translate['get_prize']?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?=Admin::Prize()?>
                                         <?=Admin::Rank()?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
                <br>
            <div class="row">
                <div class="col-md-12 table-container">
                <?=Admin::GetLeagues()?>
                
                </div>
            </div>
            <p class="text-center copy-color"><?=$translate['info_bottom']?></p>
            <!-- Footer -->

        </div>
        <footer id="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center copy-color">&copy; Copyright 2017 <?=Admin::SiteName()?> <a target="_blank" href="https://play.google.com/store/apps/details?id=com.wFreeSoccerBettingGame_4254336">
<img src="img/android.png"  border="0" alt="Android ticket1x2"></a></p>
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
<?php include_once("analyticstracking.php") ?>
    </body>
</html>
