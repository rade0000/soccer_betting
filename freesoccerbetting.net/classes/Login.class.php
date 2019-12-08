<?php
class Login{
private static $db;
public static function LoggedIn(){

$translate = Profil::Translate($_SESSION['City']);
	if (isset($_SESSION['id'])) {

		$options = self::$db->query("SELECT * FROM options");
					while ($row = $options->fetch(PDO::FETCH_ASSOC)) {
						$paypal = $row['paypal_off'];
					}
		$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$_SESSION['id']}'");
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$k = number_format($row['user_money'],2);
					$img = $row['img'];
					$name = $row['user'];
				$rank = $row['rank'];
						if ($rank === NULL) {
		                	 $rank = '<img width="16" src="img/silver.png" alt="silver">';
		                	 
		                }elseif ($rank == 1) {
		                	$rank = '<img width="16" src="img/star.png" alt="star">';
		                	
		                }elseif ($rank == 2) {
		                	$rank = '<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		                	
		                }elseif ($rank == 3) {
		                	$rank = '<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		                	
		                }elseif ($rank == 4) {
		                	$rank = '<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		                }elseif ($rank >= 5) {
		                	$rank = '<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		                	
		                }
					}

echo '<div class="col-md-12">
                        <p class="user-info">'.$translate['hello'].' <img class="img-circle" width="22" src="user-images/'.$img.'"> <a href="profil.php?id='.$_SESSION['id'].'">'.$name.' '.$rank.'</a> '.$translate['you_have'].'  <span>'.$k.'</span> '.$translate['info_virtual_m'].'</p>
                    </div>';
                            if ($paypal == 1) {
                            	echo '<li>';
                            	
             echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
	           echo ' <input type="hidden" name="business" value="'.Admin::PayPalEmail().'">';
	           echo ' <input type="hidden" name="cmd" value="_xclick">';
	            echo '<input type="hidden" name="item_name" value="Virtual Money">';
	            echo '<input type="hidden" name="amount" value="'.Admin::PayPalPrice().'">';
	            echo '<input type="hidden" name="currency_code" value="USD">';
	            echo '<input type="hidden" name="return" value="'.Config::get('site_url').'paypal_succes.php">';
	            echo '<input type="hidden" name="cancel_return" value="'.Config::get('site_url').'paypal_cancel.php">';
	            echo '<input data-toggle="tooltip" data-placement="bottom" title="Buy '.Admin::VirtualAmount().' virtual money for '.Admin::PayPalPrice().'$" class="paypal-img" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">';
	            echo '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">';
          echo '</form>';
                            	

                           echo '</li>';
                            }

  						

	
	}

}

public static function LogInTrue(){

		if ((isset($_POST['submit_login'])) AND (isset($_POST['name']) OR isset($_POST['email']))) {
			$name = strip_tags($_POST['name']);

			$password = md5($_POST['password']);
			
		$result = self::$db->prepare("SELECT * FROM users WHERE email= :uname OR user= :uname AND pass= :pass");
		
		$result->bindParam(':uname',$name);
		$result->bindParam(':pass',$password);
		$result->execute();
			$user = $result->fetch(PDO::FETCH_ASSOC);
				
			if ($user['status'] == 2) {
				    
					$_SESSION['admin_logged'] = true;
					$_SESSION['rank'] = $user['rank'];
					$_SESSION['status'] = $user['status'];
					$_SESSION['name'] = $user['user'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['user_money'] = $user['user_money'];
					$_SESSION['email_paypal'] = $user['email_paypal'];
					$_SESSION['user_img'] = $user['img'];
				header('Location:' . Config::get('site_url'));
				
				}elseif($user['status'] == 1){
					$_SESSION['user_logged'] = true;
					$_SESSION['rank'] = $user['rank'];
					$_SESSION['status'] = $user['status'];
					$_SESSION['name'] = $user['user'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['user_money'] = $user['user_money'];
					$_SESSION['user_img'] = $user['img'];
				header('Location:' . Config::get('site_url'));
				
				}else{
					header("Location:" . Config::get('site_url') . "login.php");
					
				}
			}
}
public static function Register(){
	
if (isset($_POST['submit'])) {
  if (!empty($_POST['name']) AND !empty($_POST['password']) AND !empty($_POST['password2']) AND !empty($_POST['email']) AND !empty($_POST['sum']) AND !empty($_POST['18'])){
	$name = strip_tags($_POST['name']);
	
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
	$count = $_POST['sum'];

	$name= trim($name);

    $password = trim($password);
    $passwordemail = trim($password);
	$password2 = trim($password2);
	$email = trim($email);
	$count = trim($count);
   if(preg_match("/^[a-zA-Z0-9][a-zA-Z0-9._]*@[a-zA-Z0-9][a-zA-Z0-9._]*\.[a-zA-Z0-9]{2,4}$/", $email)){
	   if($password === $password2){
		   $password = md5($password);
		   $money = 50;
	 if (($count == '5') OR ($count == 'five')){
		     $register = self::$db->query("INSERT INTO users (user, pass, email, user_money) VALUES ('{$name}','{$password}','{$email}','{$money}')");
			 
			 if (!$register == null) {
				 
			 $regs = self::$db->query("SELECT * FROM users WHERE email= '{$email}' AND pass= '{$password}'");
				 $user = $regs->fetch(PDO::FETCH_ASSOC);
				
			if ($user['status'] == 1) {
					$_SESSION['user_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['email'] = $user['email'];
    		
    		header("Location:" . Config::get('site_url') . "index.php");
			}
					
			 }else{
				 echo "<p style='color:red;'> Try to register with a different name </p>";
			 }
	 }else{
				echo "<p style='color:red;'>Please respond accurately to the security question!!!</p>";
	}
  }else{
	  echo "<p style='color:red;'>Repeat password.</p>";
  }
   }else{
	  echo "<p style='color:red;'>Please enter a valid email.</p>";
  }
}else{
echo "<p style='color:red;'>You must fill all fields</p>";
}
}
	
}
public static function LoginG($name,$email){
	
         $result = self::$db->query("SELECT * FROM users WHERE user= '{$name}' AND email= '{$email}'");
         $user = $result->fetch(PDO::FETCH_ASSOC);
				
			if ($user['status'] == 2) {
					$_SESSION['admin_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['user_money'] = $user['user_money'];
				header("Location: " . Config::get('site_url'));
				
				}elseif($user['status'] == 1){
					$_SESSION['user_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['user_money'] = $user['user_money'];
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				
				}else{
					header("Location:" . Config::get('site_url') . "register.php");
					
				}
}
public static function RegisterGG($email,$name){
	if (isset($_SESSION['user_logged'])) {
		
	}else{
	$pass = '12345';
  $money = 50;
$insert_g_user = self::$db->query("INSERT INTO users (user, pass, email, user_money) VALUES ('{$name}', '{$pass}', '{$email}', '{$money}')");
if ($insert_g_user == NULL) {
   $regs = self::$db->query("SELECT * FROM users WHERE user= '{$name}' AND email= '{$email}'");
   $user = $regs->fetch(PDO::FETCH_ASSOC);
        
      if ($user['status'] == 1) {
          			$_SESSION['user_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['user_money'] = $user['user_money'];
				header("Location:" . Config::get('site_url') . "index.php");
      }else{
         echo "<p style='color:red;'> Nesto ne valja </p>";
       }
}else{
             return "<p style='color:red;'> Successfully Registered </p>";  
             header('Location: ' . $_SERVER['HTTP_REFERER']);  
	}
	
     }
}
public static function init(){
		self::$db = Connect::getInstance();
    }
}
Login::init();
?>