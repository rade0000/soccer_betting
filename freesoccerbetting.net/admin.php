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
                    <center><h3 style="color:#ffb84d;">Add Matches UTC is 0</h3></center>
        
                        <form action="admin.php" method="POST"> 
                              <input type="text" class="form-control" name="team1" placeholder="Team 1"><br>
                              <input type="text" class="form-control" name="team2" placeholder="Team 2"><br>
                              <input type="datetime-local" class="form-control" name="beginning" value="<?=$time_now?>T20:45:00" /><br>
                              <input type="number" class="form-control" name="tip1" step="any" placeholder="tip 1"><br>
                              <input type="text" class="form-control" name="tip_x" placeholder="tip X"><br>
                              <input type="number" class="form-control" name="tip2" step="any" placeholder="tip 2"><br>
                          <input type="submit" class="form-control" name="submit" value="Add">
                        </form>
                        <?=Admin::AddGames()?><br>
                </div>
                </div>
                 <div class="row">
                <div class="col-md-12 table-container">
                             <center><h3 style="color:#ffb84d;">Game finished?! Go to edit and submit goals home/away</h3></center>      
                          <?=Admin::AdminGames()?>       
                 </div>
                </div>
                 <div class="row">
                 <div class="col-md-12 table-container">
            <center>
            <h3 style="color:#ffb84d;">Users who get a prize! Go to edit and submit 1 if you pay him</h3>
            </center>
<?php
            if (isset($_SESSION['admin_logged'])) {
           Admin::AdminPrizeWiners();
           echo "<h4 style='color:orange; text-align:center;'>Users who have winning ticket but still not take the money</h4>";
           Admin::NotPaidWiners(20);
                                        
}
?>
                </div>
                </div>

                </div><!-- /.row -->
                
            </div>
            <footer id="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-center">© Copyright 2017 <?=Admin::SiteName()?></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script src="js/slider.js" type="text/javascript"></script>
    </body>
</html>
<?php
}else{
echo "<p style='color:red;'>YOU ARE NOT ADMINISTRATOR</p>";
}
?>