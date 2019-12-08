<?php
require_once 'core/init.php';
$translate = Profil::Translate($_SESSION['City']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Register</title>
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
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
        <div class="example3">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?=Config::get('site_url')?>"><img src="<?=Admin::Logo()?>" alt="<?=Admin::SiteName()?>">
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-title">
                    <h1 class="text-center"><?=$translate['header_text']?></h1>
                </div>
            </div>
        </div>
        <div class="container" id="container-bg">
              <h2><?=$translate['below_Header']?></h2>
            <div class="row">
            
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-xs-offset-3 col-xs-8 col-xs-offset-2 contact-form">
                    <form action="register.php" method="post">
                        <div class="form-group">
                            <label for="name"><?=$translate['name']?></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?=$translate['name']?>">
                        </div>
                        <div class="form-group">
                            <label for="password"><?=$translate['password']?></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="<?=$translate['password']?>">
                        </div>
                        <div class="form-group">
                            <label for="password2"><?=$translate['reapet_password']?></label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="<?=$translate['reapet_password']?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="18" value="18"> <span class="color-orange"><?=$translate['at_least']?></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="captcha">4 + 1 = </label>
                            <input type="number" class="form-control" id="captcha" name="sum" placeholder="<?=$translate['five']?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-default btn-block btn-signup"><?=$translate['signup']?></button>
                    </form>
                </div>
                <?=Login::Register()?>
            </div>
            <p class="text-center copy-color"><?=$translate['info_bottom']?></p>
            <!-- Footer -->
        </div>
        <footer id="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-center copy-color">&copy; Copyright 2016 <?=Admin::SiteName()?></p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <?php include_once("analyticstracking.php") ?>
    </body>
</html>
