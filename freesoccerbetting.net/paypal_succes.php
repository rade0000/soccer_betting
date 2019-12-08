<?php
require_once 'core/init.php';
$amount = $_GET['amt'];
$transaction_id = $_GET['tx'];
$user_id = $_SESSION['id'];
if (!empty($amount) AND !empty($transaction_id) AND !empty($user_id)) {
	Admin::Orders($user_id,$transaction_id,$amount);
}else{
	die('Something wrong!');
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title><?=Admin::SiteName()?></title>
    <meta name="description" content="<?=Admin::SiteDesc()?>">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <header>
        <a href="<?=Config::get('site_url')?>"><img src="<?=Admin::Logo()?>" alt="<?=Admin::SiteName()?>"  width="102"></a>
        <p class='logo_text_p' ><?=Admin::SeoText()?></p>
        
      <div id='login'>

<fieldset>
      <?php
Login::GetLogIn();
$Gplus_visibility = Admin::GplusVisibility();
if ($Gplus_visibility == 0) {
  $G_hiden_style = "display: none;";
}else{
  $G_hiden_style = "";
}


$Prize_visibility = Admin::PrizeVisibility();
if ($Prize_visibility == 0) {
  $P_hiden_style = "display: none;";
}else{
  $P_hiden_style = "";
}
                  
           
                  
  // THIS BELOW IS FOR G+ login
require_once __DIR__.'/gplus-lib/vendor/autoload.php';
//change this CLIENT_ID to your CLIENT_ID
const CLIENT_ID = '95999878258-7fsq9vidlrrdte72n35ola2751v0p45f.apps.googleusercontent.com';
//Change this CLIENT_SECRET to your CLIENT_SECRET
const CLIENT_SECRET = 'E9ZnRZt6SqAC1ByQMsFxutfR';
//Change this URL to your url
const REDIRECT_URI = 'http://ticket1x2.com';

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');

$plus = new Google_Service_Plus($client);

if (isset($_REQUEST['logout'])) {
   session_unset();
}

/* 
 * B. AUTHORIZATION AND ACCESS TOKEN
 *
 * If the request is a return url from the google server then
 *  1. authenticate code
 *  2. get the access token and store in session
 *  3. redirect to same url to eleminate the url varaibles sent by google
 */
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/* 
 * C. RETRIVE DATA
 * 
 * If access token if available in session 
 * load it to the client object and access the required profile data
 */
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $me = $plus->people->get('me');

  // Get User data
  $id = $me['id'];
  $name =  $me['displayName'];
  $email =  $me['emails'][0]['value'];
  $profile_image_url = $me['image']['url'];
  $cover_image_url = $me['cover']['coverPhoto']['url'];
  $profile_url = $me['url'];
  Login::RegisterGG($email,$name);
}else {
  // get the login url   
  $authUrl = $client->createAuthUrl();
}

    /*
     * If login url is there then display login button
     * else print the retieved data
    */
   
    if (isset($authUrl)) {
        echo "<a class='login' style='". $G_hiden_style ."' href='" . $authUrl . "'><img src='images/g.png' /></a>";
    } else {

    }
    // END OF G+ LOGIN

 if (!empty($_SESSION['id'])) {
    ?>
    
<p>Buy 1000 virtual money for 1$</p>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="business" value="<?=$_SESSION['email_paypal']?>">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="item_name" value="Virtual Money">
<input type="hidden" name="amount" value="1.00">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="<?=Config::get('site_url')?>paypal_succes.php">
<input type="hidden" name="cancel_return" value="<?=Config::get('site_url')?>paypal_cancel.php">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</div>
  
</fieldset>
<?php
}
      
        if (!empty($_SESSION['id'])) {
          
          ?>

     <center>     
<button id="show-edit">Edit Profil</button>
<div class="div-edit" style="display: none;"><?=Profil::EditProfil()?></div>
 <button id="show-bonus" style="<?=$P_hiden_style?>">1x2 Prize</button>
 <div class="div-bonus" style="display: none;"><?=Admin::Prize()?></div>
 <?php
        }
        
         ?>
 </center>
      </header>
      
      <section>

        <h1>Let&rsquo; Play soccer betting online</h1>
        <div id="top_10">
        <center>
        <button id="show">TOP 10 Players</button>
        <div class="div-top" style="display: none;"><?=Admin::TopTen()?></div>
        <?php
        if (!empty($_SESSION['id'])) {
          
          ?>
         
          <button id="show-winer">Your Top 10 Winer tickets</button>
          <div class="div-winer" style="display: none;"><?=Admin::WinerTickets()?></div>
          
          
          
          <?php
        }
        
         ?>
        </center>
<?=Admin::Ad()?>
        </div>
        
<br>

        <h1>Your payments awaiting modaration</h1>
       <h3>Please be patient!</h3>
        <br>
        <br>
  
      <?=Game::WinersShowTickets()?>

    </div>
   
  
      
    <footer>
    <?=Admin::Analytics()?>
      <p>© Copyright 2016 Ticket1x2.com</p>
      
      
    </footer>
    
<script>
$(document).ready(function() {
    $('#show').click(function() {
            $('.div-top').slideToggle("fast");
    });
});
$(document).ready(function() {
    $('#show-winer').click(function() {
            $('.div-winer').slideToggle("fast");
    });
});
$(document).ready(function() {
    $('#show-bonus').click(function() {
      $('.div-bonus').slideToggle("fast");
    });
});
$(document).ready(function() {
    $('#show-edit').click(function() {
      $('.div-edit').slideToggle("fast");
    });
});
var imgSrcs = ["images/pic1.png", "images/pic2.png", "images/pic3.png"];
setInterval(function() {
    $("body").css("background", "url(" + imgSrcs[imgSrcs.push(imgSrcs.shift())-1] + ") fixed");
}, 6000);
if ($(window).width() < 312) {
   $(".club1").hide();
   $(".club2").hide();
   $(".ticket_no").hide();
   $(".mobile").css({
        "font-size": "10px"
    });
   $(".logo_text_p").css({
        "font-size": "10px"
    });
   $(".logo_text").css({
        "font-size": "15px"
    });
}


$(":radio").click(function()
{
  var previousValue = $(this).attr('previousValue');
  

  if (previousValue == 'checked')
  {
   $(this).prop('checked', false);
  }
  else
  {
    $(this).prop('checked', true);
  }
});

var val = -1;
$(':radio').on("click", function(){
    if($(this).val()==val) 
    {$(this).prop('checked', false);
    val = -1;
    }
    else val = $(this).val();
});
</script>
    
  </body>
</html>
