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
if (isset($_GET['league'])) {
    $liga = str_replace('-', ' ', $_GET['league']);
}else{
    $lige = '';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
    <head>
        <title><?=Admin::SiteName()?> <?=$liga?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=Admin::SiteDesc()?> <?=$liga?>">
        <meta name="author" content="Majstor">
         <meta property="og:title" content="<?=Admin::SiteName()?> <?=$liga?>" />
        <meta property="og:type" content="<?=Admin::SiteName()?> <?=$liga?>" />
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
        <div id="whatis" class="content-section-b" style="border-top: 0">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12 text-center wrap-title">
                        <h2><?=$translate['header_text']?></h2>
                        <p class="lead"><?=$translate['below_Header']?></p>                    
                    </div>

                </div>

                <div class="row" id="tables-container">
                <?php
                if (isset($_SESSION['name'])) {
                    Login::LoggedIn();
                }else{
                    echo '<h3>'.$translate['info_bottom'].'</h3>';
                }
                ?>
                    
                    <div class="col-md12 show-clock"></div>
                    <div class="col-md-8 table-container-left">          
                        
                            <?php
                if (isset($_GET['league'])) {
                    $league = $_GET['league'];
                }
                Admin::GetStandings($league);
                ?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <?=$translate['leagues']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                     <?=Admin::GetLeagues()?>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                           <?=$translate['top_10']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <table class="table table-bordered table-striped table-hover" id="table-top10">
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
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                           <?=$translate['winer_tickets']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <table class="table table-bordered table-striped table-hover" id="table-top10-ticket">
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
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <?=$translate['1x2_prize']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                   <table class="table table-bordered table-striped table-hover" id="table-1x2-prize">
                                        <thead>
                                            <tr>
                                                <th><?=$translate['name']?></th>
                                                <th><?=$translate['money']?></th>
                                                <th><?=$translate['1x2_prize']?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?=Admin::Prize()?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped table-hover" id="table-activity">
                                <thead>
                                    <tr>
                                        <th><?=$translate['activity']?></th>
                                    </tr>
                                </thead>
                                <tbody>                                 
                                    <?=Game::ShowOngoings()?>
                                </tbody></table>
                        </div>

                    </div>

                </div><!-- /.row -->
                <p class="text-center copy-text"><?=$translate['info_bottom']?><br></p>
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
