<?php
if (isset($_POST['submit_login']) AND isset($_POST['name'])) {
			$name = strip_tags($_POST['name']);

			$password = md5($_POST['password']);
			
		$result = self::$db->prepare("SELECT * FROM users WHERE user= :uname AND pass= :pass");
		
		$result->bindParam(':uname',$name);
		$result->bindParam(':pass',$password);
		$result->execute();
			$user = $result->fetch(PDO::FETCH_ASSOC);
				
			if ($user['status'] == 2) {
				
					$_SESSION['admin_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['user_money'] = $user['user_money'];
					$_SESSION['email_paypal'] = $user['email_paypal'];
				header('Location:' . $_SERVER['HTTP_REFERER']);
				
				}elseif($user['status'] == 1){
					$_SESSION['user_logged'] = true;
					$_SESSION['name'] = $user['user'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['id'] = $user['id_users'];
					$_SESSION['user_money'] = $user['user_money'];
				header('Location:' . $_SERVER['HTTP_REFERER']);
				
				}else{
					header("Location:" . Config::get('site_url') . "register.php");
					
				}
			}else{
				echo "not isset";
			}