<?php
require_once 'core/init.php';
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
        <link rel="shortcut icon" type="img/x-icon" href="images/favicon.png"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/one-page-wonder.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <ul class="cb-slideshow">
            <li><span>Image 01</span></li>
            <li><span>Image 02</span></li>
        </ul>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 main-title">
                    <h1 class="text-center">Bet virtually on real matches with real odds using a virtual currency and <span class="color-orange">win prize!</span></h1>
                </div>
            </div>
        </div>
        <div class="container" id="container-bg">
            <h2>Let’ Play soccer betting online</h2>
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
                 <div class="row">
<div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 stake-container">
<center><h3 style="color:#ffb84d;">Edit Game</h3></center><?=Admin::EditGame()?></div>
                </div>
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
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

    </body>
</html>