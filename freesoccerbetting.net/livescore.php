<?php


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title></title>
        <link rel="shortcut icon" type="img/x-icon" href="images/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

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
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href=""><img src="" alt="">
                        </a>
                    </div>
                    <div id="navbar3" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
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
                    <h1 class="text-center">Bet virtually on real matches with real odds using a virtual currency and <span class="color-orange">win prize!</span></h1>
                </div>
            </div>
        </div>
        <div class="container" id="container-bg">
        
            <h2>Let’ Play soccer betting online</h2>
        
            <div class="row">
                <div class="col-lg-12 nav-tabs-container">
                    <ul class="nav nav-tabs">
                        <li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-players">TOP 10 Players &nbsp; <span class="caret"></span></a></li>
                        <li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-tickets">Your TOP 10 Winer Tickets &nbsp; <span class="caret"></span></a></li>
                        <li><a class="btn btn-info btn-list-dropdown" data-toggle="collapse" data-parent="#accordion" data-target="#table-prizes">1x2 Prize &nbsp; <span class="caret"></span></a></li>
                        <li><a class="btn btn-info btn-list-dropdown"  href="users.php">Users &nbsp; <span class="caret"></span></a></li>
                    </ul>
                    <hr class="h-line">
                    <div id="accordion">
                        <div class="panel">
                            <div id="table-players" class="collapse table-top-ten">
                                <table class="table table-bordered table-striped table-hover" id="table-list">
                                <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Money</th>
                                            <th>Name</th>
                                            <th>Played</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                            <th>Game</th>
                                            <th>Stake</th>
                                            <th>You Win</th>
                                            <th>Ticket No.</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel">
                            <div id="table-prizes" class="collapse table-top-ten">
                                <table class="table table-bordered table-striped table-hover" id="table-list">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Money</th>
                                            <th>Get Bonus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
                <br>
           <table class="table table-bordered table-striped table-hover" id="table-bet">
            
<script>
function ajaxFunction(){
    var xhr;
    try{
        xhr = new XMLHttpRequest();
    }catch(e){
        try{
            xhr = new ActiveXObject('Msxm12.XMLHTTP');
        }catch(e){
            try{
                xhr = new ActiveXObject('Microsoft.XMLHTTP');
            }catch(e){
                alert('vas pretrazivac je sranje');
                return false;
            }
        }
    }
    return xhr;
}
    function osvezi(){
        var xhr = ajaxFunction();
        xhr.open('GET', 'live.php', true);
        xhr.send(null);
        xhr.onreadystatechange = function(){
            if (xhr.readyState === 4) {
                var rezultati = xhr.responseText;
                document.getElementById('table-bet').innerHTML = rezultati;
            }
        }
    }
   osvezi();
    setInterval(osvezi, 10000);
</script>
                            

                
                
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
