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
Login::LogInTrue();
if (!isset($_SESSION['admin_logged']) OR !isset($_SESSION['user_logged'])) {
	
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
        <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
        <link rel="shortcut icon" type="image/png" href="<?=Config::get('site_url')?>/img/favicon.png"/>
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
        <!-- Betting table -->
                    <div class="col-md-12 text-center wrap-title">
                        <h2><?=$translate['header_text']?></h2>
                        <p class="lead"><?=$translate['below_Header']?></p>                    
                    </div>
                
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2" id="login-container">
                    <div class="social-buttons">
                        <a href="<?=Admin::Gplus()?>" class="btn btn-gp"><i class="fa fa-google-plus" aria-hidden="true"> Google</i></a>
                    </div>
                    <p class="social-button-divider">Or</p>
                    <form class="form" role="form" method="post" action="<?=Config::get('site_url')?>/login.php" id="login-nav">
                        <div class="form-group">
                            <label class="sr-only" for="InputName">Name</label>
                            <input type="text" class="form-control" name="name" id="InputName" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="InputPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit_login" class="btn btn-primary btn-block btn-singnin"><?=$translate['login']?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer id="footer" class="footer-sticky">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center">© Copyright 2017 Ticket1x2.com</p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
<?php
}else{
	header('Location:' . Config::get('site_url'));
}
?>