<?php
class Profil{
	private static $db;
	public static function init(){
		self::$db = Connect::getInstance();
    }
	public static function EditProfil(){
	if (!empty($_SESSION['id'])) {
		$ids = $_SESSION['id'];
	
	$userss = self::$db->query("SELECT * FROM users WHERE id_users = '{$ids}'");
		
		while ($row = $userss->fetch(PDO::FETCH_ASSOC)) { 
				$user = $row['user'];
				$email = $row['email'];
				$pay_pal_email = $row['email_paypal'];
				$status = $row['status'];
				$password = $row['pass'];
				$img = $row['img'];
			  }
			  
			  echo '<div class="col-md-12">';
                                               echo '<form class="form" role="form" method="post" action="/edit-profil.php" id="edit-nav" enctype="multipart/form-data" >';
                                                    echo '<div class="form-group">';
                                                        echo '<label class="sr-only" for="InputName">Name</label>';
                                                        echo '<input type="text" name="name" class="form-control" id="InputName" value="'.$user.'" placeholder="Name">';
                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                        echo '<label class="sr-only" for="InputEmail">Email</label>';
                                                        echo '<input type="text" name="email" class="form-control" id="InputEmail" value="'.$email.'" placeholder="Email">';
                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                        echo '<label class="sr-only" for="InputEmail1">Email Paypal</label>';
                                                        echo '<input type="text" name="pay_pal_email" class="form-control" id="InputEmail1" value="'.$pay_pal_email.'" placeholder="Email Paypal">';
                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                     echo '<label class="sr-only" for="InputEmail">Add image</label>';
                                                    echo '<input type="file" name="img" />';

                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                        echo '<label class="sr-only" for="InputPassword">New Password</label>';
                                                        echo '<input type="text" name="password" class="form-control" id="InputPassword" placeholder="New Password">';
                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                        echo '<label class="sr-only" for="InputPassword2">Repeat New Password</label>';
                                                        echo '<input type="text" name="password2" class="form-control" id="InputPassword2" placeholder="Repeat New Password">';
                                                    echo '</div>';
                                                    echo '<div class="form-group">';
                                                        echo '<button type="submit" name="submitse" class="btn btn-primary btn-block btn-singnin">Update</button>';
                                                    echo '</div>';
                                                echo '</form>';
                                            echo '</div>';

			
		if (isset($_POST['submitse'])) {
						$name_update = $_POST['name'];
						$email_update = $_POST['email'];
						$pay_pal_update = $_POST['pay_pal_email'];
						if ($_POST['password'] == $_POST['password2'] AND !empty($_POST['password']) AND !empty($_POST['password2'])) {
							$password_update = md5($_POST['password']);
						}else{
							$password_update = $password;
						}
										if (!isset($_FILES['img'])) {
													$target_dir = "user-images/";
									
													$target_img = $target_dir . basename($_FILES["img"]["name"]);
													$img_ext = pathinfo($target_img, PATHINFO_EXTENSION);
													if ($img_ext == "jpg" OR $img_ext == "png") {
														move_uploaded_file($_FILES["img"]["tmp_name"], $target_img);
														$img_name= addslashes($_FILES['img']['name']);
							$updatess_img = self::$db->query("UPDATE users SET user = '{$name_update}', email = '{$email_update}', email_paypal = '{$pay_pal_update}', pass = '{$password_update}', img = '{$img_name}'  WHERE id_users = '{$ids}'");
							
							if (!$updatess_img == NULL) {
								
							}else{
								echo "not ok";
								}
												}else{
												echo "File is not a image";
												}

									
										}
			
		$updatess = self::$db->query("UPDATE users SET user = '{$name_update}', email = '{$email_update}', email_paypal = '{$pay_pal_update}', pass = '{$password_update}'  WHERE id_users = '{$ids}'");
			
			if (!$updatess == NULL) {
				echo "Profil Successfully Edited";
			}else{
				echo "not ok";
				}
			}   
		}
}
public static function AdminEditProfil($id){
	
	$usert = self::$db->query("SELECT * FROM users WHERE id_users = '{$id}'");
		
		while ($row = $usert->fetch(PDO::FETCH_ASSOC)) { 
				$user = $row['user'];
				$email = $row['email'];
				$pay_pal_email = $row['email_paypal'];
				$status = $row['status'];
				$money = $row['user_money'];

			  }
			  
			  ?>
						




	<form action="" method="POST" enctype="multipart/form-data" /> 
		<span style="color:orange;"><b>Name</b></span><br/>
		<input type="text" class="form-control" size="50px" name="name" value="<?=$user?>" /><br/>
		<span style="color:orange;"><b>Email</b></span><br/>
		​<input type="text" class="form-control" size="50px" name="email" value="<?=$email?>" /><br/>
		<span style="color:orange;"><b>Email Paypal</b></span><br/>
		​<input type="text" class="form-control" size="50px" name="pay_pal_email" value="<?=$pay_pal_email?>" /><br/>
		<span style="color:orange;"><b>Money</b></span><br/>
		<input type="number" class="form-control" size="50px" name="money" value="<?=$money?>" /><br/>
		<span style="color:orange;"><b>Status 1: User 2: Admin</b></span><br/>
		<input type="number" class="form-control" size="50px" name="status" value="<?=$status?>" /><br/>
		<br/>
		<input type="submit" name="submits" value="Update">
	</form>
   <?php
		if (isset($_POST['submits'])) {
			if ($_SESSION['rank'] > 5 AND $_SESSION['status'] == 2) {
				
			
						$name_update = $_POST['name'];
						$email_update = $_POST['email'];
						$pay_pal_update = $_POST['pay_pal_email'];
						$money_update = $_POST['money'];
						$status_update = $_POST['status'];
		$updatess = self::$db->query("UPDATE users SET user = '{$name_update}', email = '{$email_update}', email_paypal = '{$pay_pal_update}', user_money = '{$money_update}', status = {$status_update}  WHERE id_users = '{$id}'");
			
			if (!$updatess == NULL) {
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				
			}else{
				echo "not ok";
				}
			}else{
				echo "<p style='color:orange;'>You dont have permision to change users!</p>";
			}
		}  
		
}
public static function AdminSearchMember($limit,$criteria) {
	$per_page=$limit;
		
			$query = self::$db->query("SELECT * FROM users WHERE user LIKE '%{$criteria}%' OR email LIKE '%{$criteria}%' LIMIT $limit");
			
		?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Money</th>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete Member</th>
                                </tr>
                            </thead>
                            <tbody>
		<?php
		
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
								$rank = $row['rank'];
								if ($rank === NULL) {
                	 $rank = '<img width="22" src="img/silver.png" alt="silver">';
                }elseif ($rank == 1) {
                	$rank = '<img width="22" src="img/star.png" alt="star">';
                	
                }elseif ($rank == 2) {
                	$rank = '<img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star">';
                }elseif ($rank == 3) {
                	$rank = '<img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star">';
                }elseif ($rank == 4) {
                	$rank = '<img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star">';
                }elseif ($rank >= 5) {
                	$rank = '<img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star">';
                }
								?>
								<tr>
	 <td><?=$row['id_users']?></td>
	 <td style="color: #cccccc;"><?=$row['status']?></td>
	 <td><?=$row['user_money']?></td>
	 <td style="color: #cccccc;"><?=$rank?></td>
	 <td><?=$row['user']?></td>
	 <td><?=$row['email']?></td>
	 <td><a href="edit-member.php?id=<?=$row['id_users']?>"> Edit</a></td>
	 <td><a href="remove-member.php?id<?=$row['id_users']?>"> Delete</a></td>
			</tr>
								<?php
				

				}
									   
			  echo "</tbody></table>";		
			
			
								
}
public static function Translate($state){
	if ($state == 'Europe/Belgrade' OR $state == 'Europe/Sarajevo' OR $state == 'Europe/Zagreb'){
		$header_text = 'Kladite se na prave utakmice sa pravim kvotama i <span class="color-orange">osvojite nagradu</span>';
		$below_Header = 'Besplatna Online Kladionica';
		$top_10 = 'TOP 10 igrača';
		$users = 'Članovi';
		$winer_tickets = 'Vaših najboljih 10 tiketa';
		$activity = 'Poslednje Aktivnosti';
		$prize = '1x2 Nagrada';
		$position = 'Pozicija';
		$money = 'Novac';
		$clan = 'Član';
		$played = 'Odigrao';
		$game = 'Tiket - Utakmice';
		$stake = 'Ulog';
		$you_win = 'Osvojili ste';
		$ticket_no = 'Br. Tiketa';
		$time = 'Vreme';
		$name = 'Ime';
		$Get_Prize = 'Nagrada';
		$stake = 'Ulog';
		$dont_have_money = 'Nemate više novca';
		$dont_have_that_money = 'Nemate toliko novca!';
		$late = 'Utakmice su već počele!';
		$must_pick = 'Morate odigrati bar jednu utakmicu';
		$insert_stake = 'Ulog ne može biti prazan!';
		$registered = "Morate biti <a style='color:orange;' href='register.php'>registrovani</a> ili ulogovani da bi ste mogli odigrati tiket!";
		$ticket_success = 'Uspešno ste uplatili tiket';
		$submit = 'Potvrdi';
		$today = 'Danas';
		$hello = 'Zdravo';
		$you_have = 'Vi imate: ';
		$virtual_m = 'virtuelnog novca';
		$info_virtual_m = 'Svaki dan besplatno dobijate +50 ukoliko imate manje od 250 na računu';
		$edit_profil = 'Izmeni Profil';
		$logout = 'Odjavi se';
		$password = 'Lozinka:';
		$reapet_password = 'Ponovite Lozinku:';
		$at_least = '*Da bi ste se registrovali morate imati minimalno 18 godina!';
		$five = 'pet brojevima';
		$signup = 'Registruj se!';
		$alredy_have = 'Da li imate nalog?';
		$search_criteria = 'Unesite kriterijum pretrage!';
		$search = 'Pretraga';
		$first_page = 'Prva Strana';
		$last_page = 'Zadnja Strana';
		$your_tickets = 'Vaš Profil';
		$odds = 'Kvota';
		$login_to_see = 'Morate se registrovati ili ulogovati da bi ste bili u mogućnosti da vidite profil';
		$action = 'Akcija';
		$take_money = 'Isplati';
		$possibile_win = 'Mogući dobitak';
		$your_comment = 'Vaš komentar...';
		$last10 = 'Zadnji isplaćeni tiketi';
		$not_yours = 'Tiket nije vaš!';
		$before_throw = 'Pre bacanja proverite utakmice!';
		$join = 'Registruj se';
		$login = 'Uloguj se';
		$email_name = 'Email ili Ime';
		$new_here = 'Niste registrovani?';
		$you_need = 'Nedostaje vam';
		$to_win = 'da osvojite';
		$and_high_rank = '$ i viši rang';
		$high_rank = 'Viši rang se dobija osvajanjem nagrade!';
		$send = 'Pošalji';
		$info_bottom = 'Ovo nije prava online kladionica</b> i ne možete da se kladite u pravi novac ovo je samo (igra) to jest simulacija prave online kladionice! Svaki dan dobijate +50 virtuelnih poena za klađenje ukoliko imate manje od 250 poena na vašem nalogu. <br>Najbolji dobijaju novcanu nagradu i viši rang!!!';
		$stake_money = 'Ukupna uplata';
		$all_time_win_money = 'Ukupna isplata';
		$to_buy = 'da kupite';
		$leagues = 'Lige';
		return $array = array('header_text' => $header_text, 'below_Header' => $below_Header, 'top_10' => $top_10, 'users' => $users, 'winer_tickets' => $winer_tickets, 'activity' => $activity, '1x2_prize' => $prize, 'position' => $position, 'money' => $money, 'user' => $clan, 'played' => $played, 'game' => $game, 'stake' => $stake, 'you_win' => $you_win, 'ticket_no' => $ticket_no, 'time' => $time, 'name' => $name, 'get_prize' => $Get_Prize, 'stake' => $stake, 'dont_have_money' => $dont_have_money, 'dont_have_that_money' => $dont_have_that_money, 'late' => $late, 'must_pick' => $must_pick, 'insert_stake' => $insert_stake, 'registered' => $registered, 'ticket_success' => $ticket_success, 'submit' => $submit, 'today' => $today, 'hello' => $hello, 'you_have' => $you_have, 'virtual_m' => $virtual_m, 'info_virtual_m' => $info_virtual_m, 'edit_profil' => $edit_profil, 'logout' => $logout, 'password' => $password, 'reapet_password' => $reapet_password, 'at_least' => $at_least, 'five' => $five, 'signup' => $signup, 'alredy_have' => $alredy_have, 'search_criteria' => $search_criteria, 'search' => $search, 'first_page' => $first_page, 'last_page' => $last_page, 'your_tickets' => $your_tickets, 'login_to_see' => $login_to_see, 'odds' => $odds, 'action' => $action, 'take_money' => $take_money, 'possibile_win' => $possibile_win, 'your_comment' => $your_comment, 'last10' => $last10, 'not_yours' => $not_yours, 'before_throw' => $before_throw, 'join' => $join, 'login' => $login, 'email_name' => $email_name, 'new_here' => $new_here, 'you_need' => $you_need, 'to_win' => $to_win, 'and_high_rank' => $and_high_rank, 'high_rank' => $high_rank, 'send' => $send, 'info_bottom' => $info_bottom, 'all_time_win_money' => $all_time_win_money, 'stake_money' => $stake_money, 'to_buy' => $to_buy, 'leagues' => $leagues);

	}elseif ($state == 'America/Mexico_City' OR $state == 'America/Bogota' OR $state == 'Europe/Madrid' OR $state == 'America/Argentina/Cordoba' OR $state == 'America/Argentina/Buenos_Aires' OR $state == 'America/Lima' OR $state == 'America/Caracas' OR $state == 'America/Santiago' OR $state == 'America/Quito' OR $state == 'America/Guatemala_City' OR $state == 'America/Havana' OR $state == 'America/Sucre' OR $state == 'America/Santo_Domingo' OR $state == 'America/Tegucigalpa' OR $state == 'America/Asuncion' OR $state == 'America/San_Salvador' OR $state == 'America/Managua' OR $state == 'America/Costa_Rica' OR $state == 'America/Panama' OR $state == 'America/Montevideo') {
		$header_text = 'Apueste en los verdaderos  partidos  con cuotas y tendra  la  posibilidad <span class="color-orange"> de ganar premios</span>';
		$below_Header = 'Portal de apuestas gratis en línea';
		$top_10 = 'TOP 10 jugadores';
		$users = 'Miembros';
		$winer_tickets = 'Sus 10 mejores entradas';
		$activity = 'Última Actividad';
		$prize = '1x2 Premio';
		$position = 'Posición';
		$money = 'Dinero';
		$clan = 'Miembro';
		$played = 'Jugó';
		$game = 'Partidos';
		$stake = 'Invirtio';
		$you_win = 'Te has ganado';
		$ticket_no = 'núm. billete';
		$time = 'Tiempo';
		$name = 'Nombre';
		$Get_Prize = 'Premio';
		$stake = 'Invirtio';
		$dont_have_money = 'Usted no tiene más dinero';
		$dont_have_that_money = 'Usted no tiene suficiente dinero!';
		$late = 'Los juegos ya han comenzado!';
		$must_pick = 'Usted debe jugar al menos un partido';
		$insert_stake = 'La apuesta no puede estar vacía!';
		$registered = "Usted debe <a style='color:orange;' href='register.php'>registrarse </a> o iniciar sesión para  poder  jugar el billete.";
		$ticket_success = 'Usted ha pagado con éxito su billete';
		$submit = 'Confirmar';
		$today = 'Hoy';
		$hello = 'Hola';
		$you_have = 'Usted tiene: ';
		$virtual_m = 'Dinero  virtual';
		$info_virtual_m = 'Todos los días optendra +50 en caso de que tenga menos de 250 en la cuenta ';
		$edit_profil = 'Editar Perfil';
		$logout = 'Darse de baja';
		$password = 'Contraseña:';
		$reapet_password = 'Repetir Contraseña:';
		$at_least = '*Para registrarse debe tener un mínimo de 18 años de edad!';
		$five = 'escriban los numeros en cifras';
		$signup = 'Regístrese!';
		$alredy_have = '¿Tiene ud una cuenta?';
		$search_criteria = 'Introducir criterios de  la búsqueda!';
		$search = 'búsqueda';
		$first_page = 'Página principal';
		$last_page = 'Última Página';
		$your_tickets = 'Su perfil';
		$odds = 'cuota';
		$login_to_see = 'Usted debe registrarse o iniciar sesión para poder ver su perfil';
		$action = 'Acción';
		$take_money = 'Paga';
		$possibile_win = 'Posible ganancia';
		$your_comment = 'Su comentario...';
		$last10 = 'Último billete pagado';
		$not_yours = 'El billete no es suyo!';
		$before_throw = 'Antes de tirar compruebe el partido!';
		$join = 'Registrese';
		$login = 'iniciar sesión';
		$email_name = 'correo electrónico o nombre';
		$new_here = '¿No se ha registrado?';
		$you_need = 'Le hace falta';
		$to_win = 'para ganar';
		$and_high_rank = '$ Y el rango más alto';
		$high_rank = 'El rango más alto se obtiene al ganar premios!';
		$send = 'Envia';
		$info_bottom = 'Este no es un portal verdadero de apuestas, y no se puede apostar con dinero real. Esto es solamente un (juego) es una simulación de apuestas en línea. Cada dia usted obtendra +50 de puntos virtuales para apostar, siempre y cuando tenga menos de 250 puntos en su cuenta. Los mejores jugadores obtendran premio y un mejor rango.';
		$stake_money = 'All time Stake Money';
		$all_time_win_money = 'All time Win Money';
		$to_buy = 'To buy';
		$leagues = 'Leagues';
		return $array = array('header_text' => $header_text, 'below_Header' => $below_Header, 'top_10' => $top_10, 'users' => $users, 'winer_tickets' => $winer_tickets, 'activity' => $activity, '1x2_prize' => $prize, 'position' => $position, 'money' => $money, 'user' => $clan, 'played' => $played, 'game' => $game, 'stake' => $stake, 'you_win' => $you_win, 'ticket_no' => $ticket_no, 'time' => $time, 'name' => $name, 'get_prize' => $Get_Prize, 'stake' => $stake, 'dont_have_money' => $dont_have_money, 'dont_have_that_money' => $dont_have_that_money, 'late' => $late, 'must_pick' => $must_pick, 'insert_stake' => $insert_stake, 'registered' => $registered, 'ticket_success' => $ticket_success, 'submit' => $submit, 'today' => $today, 'hello' => $hello, 'you_have' => $you_have, 'virtual_m' => $virtual_m, 'info_virtual_m' => $info_virtual_m, 'edit_profil' => $edit_profil, 'logout' => $logout, 'password' => $password, 'reapet_password' => $reapet_password, 'at_least' => $at_least, 'five' => $five, 'signup' => $signup, 'alredy_have' => $alredy_have, 'search_criteria' => $search_criteria, 'search' => $search, 'first_page' => $first_page, 'last_page' => $last_page, 'your_tickets' => $your_tickets, 'login_to_see' => $login_to_see, 'odds' => $odds, 'action' => $action, 'take_money' => $take_money, 'possibile_win' => $possibile_win, 'your_comment' => $your_comment, 'last10' => $last10, 'not_yours' => $not_yours, 'before_throw' => $before_throw, 'join' => $join, 'login' => $login, 'email_name' => $email_name, 'new_here' => $new_here, 'you_need' => $you_need, 'to_win' => $to_win, 'and_high_rank' => $and_high_rank, 'high_rank' => $high_rank, 'send' => $send, 'info_bottom' => $info_bottom, 'all_time_win_money' => $all_time_win_money, 'stake_money' => $stake_money, 'to_buy' => $to_buy, 'leagues' => $leagues);
	}elseif ($state == 'Europe/Rome') {
$header_text = 'Scommetta su partite vere e proprie con le probabilità reali e vinca un premio';
$below_Header = 'Scomesse online gratis';
$top_10 = 'giocatori TOP 10';
$users = 'Membri';
$winer_tickets = 'I Vostri 10 biglietti migliori';
$activity = 'Ultime attivitá';
$prize = 'Premio1x2 ';
$position = 'Posizione';
$money = 'Soldi';
$clan = 'Membro';
$played = 'Giocato';
$game = 'Biglietto - Partite';
$stake = 'Paletto';
$you_win = 'Lei ha vinto';
$ticket_no = 'Num. del biglietto';
$time = 'Ora';
$name = 'Nome';
$Get_Prize = 'Premio';
$stake = 'Paletto';
$dont_have_money = 'Non ha piú soldi';
$dont_have_that_money = 'Non ha tanti soldi!';
$late = 'Le partite hanno giá cominciato!';
$must_pick = 'Deve giocare almeno una partita';
$insert_stake = 'Il paletto non puó essere vuoto!';
$registered = "Deve essere registrato o connesso, per poter giocare il biglietto!";
$ticket_success = 'Ha giocato il biglietto con successo';
$submit = 'Conferma';
$today = 'Oggi';
$hello = 'Buon giorno';
$you_have = 'Lei ha: ';
$virtual_m = 'soldi virtuali';
$info_virtual_m = 'Lei riceve +50 gratis ogni giorni, se ha meno di 250 sull’account';
$edit_profil = 'Cambia il Profilo';
$logout = 'log off';
$password = 'password:';
$reapet_password = 'Ripeta la password:';
$at_least = '*Per poter registrarsi, deve avere almeno 18 anni!';
$five = 'cinque numericamente';
$signup = 'Registra!';
$alredy_have = 'Lei ha un account?';
$search_criteria = 'Unesite kriterijum pretrage!';
$search = 'Ricerca';
$first_page = 'Prima pagina';
$last_page = 'Ultima pagina';
$your_tickets = 'Vostro profilo';
$odds = 'Quota';
$login_to_see = 'Deve registrarsi o accedere, per poter vedere il profilo';
$action = 'Azione';
$take_money = 'Paga';
$possibile_win = 'Vincita possibile';
$your_comment = 'Vostro commento...';
$last10 = 'L’ultimo biglietto pagato';
$not_yours = 'Il biglietto non é Vostro!';
$before_throw = 'Prima di buttare via, controlla le partite!';
$join = 'Registra';
$login = 'Accedi';
$email_name = 'Email o nome';
$new_here = 'Non é registrato?';
$you_need = 'Le manca';
$to_win = 'per vincere';
$and_high_rank = '€ ie il livello piú alto';
$high_rank = 'Il livello piú alto si riceve attraverso la vincita del premio!';
$send = 'Manda';
$info_bottom = 'Questo non è un vero e proprio gioco di scommesse online, quindi non è possibile scommettere su denaro reale, questo è solo un (gioco), ossia una simulazione di un vero e proprio gioco di scommesse online! Ogni giorno riceve +50 punti per scommesse virtuali se ha meno di 250 punti sul Vostro account. I migliori vincono il premio
biglietto 1X2, o il livello piú alto!!!';
$stake_money = 'Versamento totale finora';
$all_time_win_money = 'Pagamento totale finora';
$to_buy = 'per comprare';
$leagues = 'Campionati';
					return $array = array('header_text' => $header_text, 'below_Header' => $below_Header, 'top_10' => $top_10, 'users' => $users, 'winer_tickets' => $winer_tickets, 'activity' => $activity, '1x2_prize' => $prize, 'position' => $position, 'money' => $money, 'user' => $clan, 'played' => $played, 'game' => $game, 'stake' => $stake, 'you_win' => $you_win, 'ticket_no' => $ticket_no, 'time' => $time, 'name' => $name, 'get_prize' => $Get_Prize, 'stake' => $stake, 'dont_have_money' => $dont_have_money, 'dont_have_that_money' => $dont_have_that_money, 'late' => $late, 'must_pick' => $must_pick, 'insert_stake' => $insert_stake, 'registered' => $registered, 'ticket_success' => $ticket_success, 'submit' => $submit, 'today' => $today, 'hello' => $hello, 'you_have' => $you_have, 'virtual_m' => $virtual_m, 'info_virtual_m' => $info_virtual_m, 'edit_profil' => $edit_profil, 'logout' => $logout, 'password' => $password, 'reapet_password' => $reapet_password, 'at_least' => $at_least, 'five' => $five, 'signup' => $signup, 'alredy_have' => $alredy_have, 'search_criteria' => $search_criteria, 'search' => $search, 'first_page' => $first_page, 'last_page' => $last_page, 'your_tickets' => $your_tickets, 'login_to_see' => $login_to_see, 'odds' => $odds, 'action' => $action, 'take_money' => $take_money, 'possibile_win' => $possibile_win, 'your_comment' => $your_comment, 'last10' => $last10, 'not_yours' => $not_yours, 'before_throw' => $before_throw, 'join' => $join, 'login' => $login, 'email_name' => $email_name, 'new_here' => $new_here, 'you_need' => $you_need, 'to_win' => $to_win, 'and_high_rank' => $and_high_rank, 'high_rank' => $high_rank, 'send' => $send, 'info_bottom' => $info_bottom, 'all_time_win_money' => $all_time_win_money, 'stake_money' => $stake_money, 'to_buy' => $to_buy, 'leagues' => $leagues);
	}else{
		$header_text = 'BET VIRTUALLY ON REAL MATCHES WITH REAL ODDS USING A VIRTUAL CURRENCY <span class="color-orange">AND WIN PRIZE</span>';
		$below_Header = 'Let’s Play soccer betting game';
		$top_10 = 'TOP 10 Players';
		$users = 'Users';
		$winer_tickets = 'Your TOP 10 Winer Tickets';
		$activity = 'Last Activity';
		$prize = '1x2 Prize';
		$position = 'Position';
		$money = 'Money';
		$clan = 'User';
		$played = 'Played';
		$game = 'Ticket - Games';
		$stake = 'Stake';
		$you_win = 'You Win';
		$ticket_no = 'Ticket No.';
		$time = 'Time';
		$name = 'Name';
		$Get_Prize = 'Get Prize';
		$stake = 'Stake';
		$dont_have_money = 'You dont have money';
		$dont_have_that_money = 'You don have that much money!';
		$late = 'You are late!';
		$must_pick = 'Must pick at least one game';
		$insert_stake = 'Insert stake cant be empty!';
		$registered = "You must be <a style='color:orange;' href='register.php'>registered</a> and logged in to submit ticket!";
		$ticket_success ='Successfully Submited Ticket';
		$submit = 'Submit';
		$today = 'Today';
		$hello = 'Hello';
		$you_have = 'You have:';
		$virtual_m = 'virtualnog novca';
		$info_virtual_m = 'If you have less then 250 you will get every day free 50';
		$edit_profil = 'Edit Profile';
		$logout = 'Logout';
		$password = 'Password:';
		$reapet_password = 'Repeat Password:';
		$at_least = '*You need to have 18 years at least to join this site';
		$five = 'five';
		$signup = 'Sign up!';
		$alredy_have = 'Already have an account?';
		$search_criteria = 'Enter Search Criteria';
		$search = 'Search';
		$first_page = 'First page';
		$last_page = 'Last page';
		$your_tickets = 'Your Profile';
		$login_to_see = 'You must log in to see Tickets';
		$odds = 'Odds';
		$action = 'Action';
		$take_money = 'Take Money';
		$possibile_win = 'Possibile Win';
		$your_comment = 'Your Comment...';
		$last10 = 'Last 10 winers tickets';
		$not_yours = 'Its not your ticket!';
		$before_throw = 'Before throwing check match results!';
		$join = 'Join Us';
		$login = 'Log in';
		$email_name = 'Email or Name';
		$new_here = 'New here?';
		$you_need = 'You need';
		$to_win = 'to win real';
		$and_high_rank = '$ and higher rank';
		$high_rank = 'You can get a higher rank if you win a prize!';
		$send = 'Send';
		$info_bottom = 'This is not a real online betting site!!! Here you can not bet for a real money this is only a (game) simulation of a real online betting site! Every day you get +50 points for virtual betting if you have less than 250 points on your account.<br> Best player receive as prize and higher rank!!!';
		$stake_money = 'All time Stake Money';
		$all_time_win_money = 'All time Win Money';
		$to_buy = 'To buy';
		$leagues = 'Leagues';
		return $array = array('header_text' => $header_text, 'below_Header' => $below_Header, 'top_10' => $top_10, 'users' => $users, 'winer_tickets' => $winer_tickets, 'activity' => $activity, '1x2_prize' => $prize, 'position' => $position, 'money' => $money, 'user' => $clan, 'played' => $played, 'game' => $game, 'stake' => $stake, 'you_win' => $you_win, 'ticket_no' => $ticket_no, 'time' => $time, 'name' => $name, 'get_prize' => $Get_Prize, 'stake' => $stake, 'dont_have_money' => $dont_have_money, 'dont_have_that_money' => $dont_have_that_money, 'late' => $late, 'must_pick' => $must_pick, 'insert_stake' => $insert_stake, 'registered' => $registered, 'ticket_success' => $ticket_success, 'submit' => $submit, 'today' => $today, 'hello' => $hello, 'you_have' => $you_have, 'virtual_m' => $virtual_m, 'info_virtual_m' => $info_virtual_m, 'edit_profil' => $edit_profil, 'logout' => $logout, 'password' => $password, 'reapet_password' => $reapet_password, 'at_least' => $at_least, 'five' => $five, 'signup' => $signup, 'alredy_have' => $alredy_have, 'search_criteria' => $search_criteria, 'search' => $search, 'first_page' => $first_page, 'last_page' => $last_page, 'your_tickets' => $your_tickets, 'login_to_see' => $login_to_see, 'odds' => $odds, 'action' => $action, 'take_money' => $take_money, 'possibile_win' => $possibile_win, 'your_comment' => $your_comment, 'last10' => $last10, 'not_yours' => $not_yours, 'before_throw' => $before_throw, 'join' => $join, 'login' => $login, 'email_name' => $email_name, 'new_here' => $new_here, 'you_need' => $you_need, 'to_win' => $to_win, 'and_high_rank' => $and_high_rank, 'high_rank' => $high_rank, 'send' => $send, 'info_bottom' => $info_bottom, 'all_time_win_money' => $all_time_win_money, 'stake_money' => $stake_money, 'to_buy' => $to_buy, 'leagues' => $leagues);
	}
}
     
 Public static function TimeZone($state){
 	
	 	if ($state == 'America/Denver' OR $state == 'America/Salt_Lake_City' OR $state == 'America/Phoenix' OR $state == 'America/Hermosillo' OR $state == 'America/Calgary' OR $state == 'America/Edmonton' OR $state == 'America/Inuvik'){
			$vreme = '-420 '; 
			return $vreme;
		}elseif ($state == 'America/Whitehorse' OR $state == 'America/Vancouver' OR $state == 'America/Seattle' OR $state == 'America/San_Francisco' OR $state == 'America/Los_Angeles' OR $state == 'America/Las_Vegas') {
			$vreme = '-480 '; 
			return $vreme;
		}elseif ($state == 'America/Anchorage' OR $state == 'America/Fairbanks' OR $state == 'America/Juneau') {
			$vreme = '-540 '; 
			return $vreme;
		}elseif ($state == 'America/Baker_Lake' OR $state == 'America/Regina' OR $state == 'America/Winnipeg' OR $state == 'America/Minneapolis' OR $state == 'America/Chicago' OR $state == 'America/Kansas_City' OR $state == 'America/Oklahoma_City' OR $state == 'America/Dallas' OR $state == 'America/New_Orleans' OR $state == 'America/Houston' OR $state == 'America/Mexico_City' OR $state == 'America/Belmopan' OR $state == 'America/Guatemala_City' OR $state == 'America/San_Salvador' OR $state == 'America/Tegucigalpa' OR $state == 'America/Managua' OR $state == 'America/Costa_Rica' OR $state == 'America/Managua') {
			$vreme = '-360 '; 
			return $vreme;
		}elseif ($state == 'America/Pond_Inlet' OR $state == 'America/Coral Harbour' OR $state == 'America/Kuujjuaq' OR $state == 'America/Chibougamau' OR $state == 'America/Montreal' OR $state == 'America/Ottawa' OR $state == 'America/Toronto' OR $state == 'America/Detroit' OR $state == 'America/Indianapolis' OR $state == 'America/Washington_DC' OR $state == 'America/Philadelphia' OR $state == 'America/New_York' OR $state == 'America/Boston' OR $state == 'America/Atlanta' OR $state == 'America/Miami' OR $state == 'America/Nassau' OR $state == 'America/Havana' OR $state == 'America/Kingston' OR $state == 'America/Port-au-Prince' OR $state == 'America/Panama' OR $state == 'America/Bogota' OR $state == 'America/Quito' OR $state == 'America/Lima' OR $state == 'America/Rio_Branco') {
			$vreme = '-300 '; 
			return $vreme;
		}elseif ($state == 'America/Happy_Valley-Goose_Bay' OR $state == 'America/Halifax' OR $state == 'America/Puerto_Rico' OR $state == 'America/Basse-Terre' OR $state == 'America/Bridgetown' OR $state == 'America/Caracas' OR $state == 'America/Guyana' OR $state == 'America/Manaus' OR $state == 'America/La_Paz' OR $state == 'America/Sucre' OR $state == 'America/Santo_Domingo') {
			$vreme = '-240 '; 
			return $vreme;
		}elseif ($state == 'America/Santiago' OR $state == 'America/Argentina/Punta_Arenas' OR $state == 'America/Argentina/Cordoba' OR $state == 'America/Argentina/Buenos_Aires' OR $state == 'America/Montevideo' OR $state == 'America/Asuncion') {
			$vreme = '-180 '; 
			return $vreme;
		}elseif ($state == 'America/Brasilia' OR $state == 'America/Rio_de_Janeiro' OR $state == 'America/Sao_Paulo') {
			$vreme = '-120 '; 
			return $vreme;
		}elseif ($state == 'Europe/Torshavn' OR $state == 'Europe/Edinburgh' OR $state == 'Europe/Douglas' OR $state == 'Europe/Dublin' OR $state == 'Africa/Cardiff' OR $state == 'Europe/London' OR $state == 'Europe/Lisbon' OR $state == 'Africa/Casablanca' OR $state == 'Africa/El_Aaiun' OR $state == 'Africa/Dakar' OR $state == 'Africa/Timbuktu' OR $state == 'Africa/Bamako' OR $state == 'Africa/Ouagadougou' OR $state == 'Africa/Yamoussoukro' OR $state == 'Africa/Abidjan' OR $state == 'Africa/Accra' OR $state == 'Africa/Lome') {
			$vreme = '-0 '; 
			return $vreme;
		}elseif ($state == 'Europe/Rovaniemi' OR $state == 'Europe/Kemi' OR $state == 'Europe/Helsinki' OR $state == 'Europe/Tallinn' OR $state == 'Europe/Riga' OR $state == 'Europe/Vilnius' OR $state == 'Europe/Kyiv' OR $state == 'Europe/Dnipro' OR $state == 'Europe/Chișinău' OR $state == 'Europe/Bucharest' OR $state == 'Europe/Sofia' OR $state == 'Europe/Athens' OR $state == 'Europe/Nicosia' OR $state == 'Asia/Beirut' OR $state == 'Asia/Damascus' OR $state == 'Asia/Amman' OR $state == 'Asia/Jerusalem' OR $state == 'Africa/Cairo' OR $state == 'Africa/Kigali' OR $state == 'Africa/Bujumbura' OR $state == 'Africa/Lubumbashi' OR $state == 'Africa/Lusaka' OR $state == 'Africa/Harare' OR $state == 'Africa/Windhoek' OR $state == 'Africa/Cape_Town' OR $state == 'Africa/Gaborone' OR $state == 'Africa/Johannesburg' OR $state == 'Africa/Maseru' OR $state == 'Africa/Mbabane' OR $state == 'Africa/Maputo' OR $state == 'Africa/Lilongwe') {
			$vreme = '+120 '; 
			return $vreme;
		}elseif ($state == 'Europe/Moscow' OR $state == 'Europe/Minsk' OR $state == 'Europe/Istanbul' OR $state == 'Europe/Ankara' OR $state == 'Asia/Baghdad' OR $state == 'Asia/Kuwait_City' OR $state == 'Asia/Manama' OR $state == 'Asia/Doha' OR $state == 'Asia/Riyadh' OR $state == 'Asia/Sana' OR $state == 'Africa/Khartoum' OR $state == 'Africa/Asmara' OR $state == 'Africa/Addis_Ababa' OR $state == 'Africa/Djibouti' OR $state == 'Africa/Juba' OR $state == 'Africa/Kampala' OR $state == 'Africa/Dodoma' OR $state == 'Africa/Nairobi' OR $state == 'Africa/Dar_es_Salaam' OR $state == 'Africa/Moroni' OR $state == 'Africa/Antananarivo') {
			$vreme = '+180 '; 
			return $vreme;
		}elseif ($state == 'Asia/Oral' OR $state == 'Asia/Izhevsk' OR $state == 'Asia/Samara' OR $state == 'Asia/Tbilisi' OR $state == 'Asia/Yerevan' OR $state == 'Asia/Baku' OR $state == 'Asia/Belushya_Guba') {
			$vreme = '+240 '; 
			return $vreme;
		}elseif ($state == 'Asia/Male' OR $state == 'Asia/Karachi' OR $state == 'Asia/Islamabad' OR $state == 'Asia/Dushanbe' OR $state == 'Asia/Tashkent' OR $state == 'Asia/Yekaterinburg') {
			$vreme = '+300 '; 
			return $vreme;
		}elseif ($state == 'Asia/Novosibirsk' OR $state == 'Asia/Hovd' OR $state == 'Asia/Krasnoyarsk' OR $state == 'Asia/Norilsk' OR $state == 'Asia/Khatanga' OR $state == 'Asia/Jakarta' OR $state == 'Asia/Pontianak' OR $state == 'Asia/Phnom_Penh' OR $state == 'Asia/Bangkok' OR $state == 'Asia/Vientiane' OR $state == 'Asia/Hanoi') {
			$vreme = '+420 '; 
			return $vreme;
		}elseif ($state == 'Australia/Perth' OR $state == 'Asia/Denpasar' OR $state == 'Asia/Makassar' OR $state == 'Asia/Bandar_Seri_Begawan' OR $state == 'Asia/Manila' OR $state == 'Asia/Hong_Kong' OR $state == 'Asia/Taipei' OR $state == 'Asia/Shanghai' OR $state == 'Asia/Shanghai' OR $state == 'Asia/Beijing' OR $state == 'Asia/Beijing' OR $state == 'Asia/Chongqing' OR $state == 'Asia/Lhasa' OR $state == 'Asia/Ürümqi' OR $state == 'Asia/Ulaanbaatar' OR $state == 'Asia/Irkutsk') {
			$vreme = '+480 '; 
			return $vreme;
		}elseif ($state == 'Asia/Tokyo' OR $state == 'Asia/Chita' OR $state == 'Asia/Yakutsk' OR $state == 'Asia/Tiksi' OR $state == 'Asia/Seoul' OR $state == 'Asia/Manokwari') {
			$vreme = '+540 '; 
			return $vreme;
		}else{
				$vreme = '+0 ';
				return $vreme;
			
		}

}
    

}
Profil::init();
?>