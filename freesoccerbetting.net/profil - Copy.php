<?php
require_once 'core/init.php';
require_once 'Gplus.php';
if (isset($_GET['id'])) {
    $user_title = Admin::Reaciver($_GET['id']);
}
if (empty($_SESSION['city'])) {
   $_SESSION['City']= Admin::GetCity($_SESSION['ip']);
   $translate = Profil::Translate($_SESSION['City']);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=Admin::SiteDesc()?>">
        <meta name="author" content="">
        <title><?=Admin::SiteName()?> - <?=$user_title['name']?></title>
        <link rel="shortcut icon" type="img/x-icon" href="images/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/one-page-wonder.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider.css" rel="stylesheet" type="text/css"/>
        <link href="css/comment.css" rel="stylesheet" type="text/css"/>
        <link href="css/slider-css.css" rel="stylesheet" type="text/css"/>
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
            <h2><?=$user_title['name']?> profile</h2>
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
                        <li><a class="btn btn-info btn-list-dropdown"  href="leagues.php"><?=$translate['leagues']?><span class="caret"></span></a></li>
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
            <div class="row">
                <div class="col-md-12 table-container">
                    
                     <?php
        if (isset($_GET['id']) AND isset($_SESSION['id'])) {
            $reaciver = $_GET['id'];
            $sender = $_SESSION['id'];
          if ($_GET['id'] == $_SESSION['id']) {
            echo "<p>".$translate['your_tickets']."</p>";
            $id = $_SESSION['id'];
            $s = Admin::Sender($sender);
?>
<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th><?=$translate['money']?></th>
                                    <th><?=$translate['user']?></th>
                                    <th><?=$translate['stake_money']?></th>
                                    <th><?=$translate['all_time_win_money']?></th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <tr>
                                 <td><h5 data-toggle="tooltip" data-placement="bottom" title="<?=$translate['high_rank']?>" ><?=$s['rank']?></h5></td>
                                 <td style="color: #cccccc;"><?=$s['money']?></td>
                                 <td style="color: #cccccc;"><img style="width:44px;" class='img-circle' src="user-images/<?=$s['img']?>"> <?=$s['name']?></td>
                                 <td style="color: #cccccc;"><?=$s['enter_money']?></td>
                                 <td style="color: #cccccc;"><?=$s['win_money']?></td>
                                 <td style="color: #cccccc;"><?=$s['email']?></td>
                            </tr>
                            </tbody>
</table>
                <br>   <br>  
                
                        
                                
<?php
            Game::ShowTicketsTop($id);

          }else{
    $r = Admin::Reaciver($reaciver);
    $s = Admin::Sender($sender);
?>

                    
<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th><?=$translate['money']?></th>
                                    <th><?=$translate['user']?></th>
                                    <th><?=$translate['stake_money']?></th>
                                    <th><?=$translate['all_time_win_money']?></th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            <tr>
                                 <td><?=$r['rank']?></td>
                                 <td style="color: #cccccc;"><?=$r['money']?></td>
                                 <td style="color: #cccccc;"><img style="width:44px;" class='img-circle'  src="user-images/<?=$r['img']?>" ></td> <td style="color: #cccccc;"><?=$r['enter_money']?></td>
                                 <td style="color: #cccccc;"><?=$r['win_money']?></td>
                                 <td style="color: #cccccc;"><?=$r['email']?></td>
                            </tr>
                            </tbody>
</table>
                    <form action='/profil.php?id=<?=$reaciver?>' method='post'>
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 stake-container">
                            <div class="form-group">
                                <input type="number" name="money" min="1000" max="<?=$s['money']?>" class="form-control" id="InputStake" placeholder="<?=$translate['send']?> <?=$r['name']?> <?=$translate['virtual_m']?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="send_money" class="btn btn-info btn-block btn-list"><?=$translate['send']?></button>
                            </div>
                        </div>
                    </form>
<?php
if (isset($_POST['send_money'])) {
     if (isset($_POST['money']) AND !empty($reaciver) AND !empty($sender)) {
         $money = $_POST['money'];
    Admin::SendMoneyUser($sender,$reaciver,$money);
      }else{
        echo "Try Again";
      }
    
}
            
            echo '<br>';
            $id = $_GET['id'];
            Game::ShowTicketsTop($id);
          }
          
        }else{
         echo "<p>".$translate['login_to_see']."</p>"; 
        }
        
        ?>
                
            </div>

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
