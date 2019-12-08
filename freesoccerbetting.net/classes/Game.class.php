<?php
class Game{
private static $db;
private static $url;
public static function init(){
		self::$db = Connect::getInstance();
		
}
public static function Games(){
	$games = self::$db->query("SELECT * FROM games ORDER BY beginning ASC");
	
	$br = 0;
	$a = 1.00;
	
	$ticket_games = "";
	$ticket_games2 = "";
	$time_games = array();
	
$translate = Profil::Translate($_SESSION['City']);


		
		$results = array();
	?>
						<form action='/' method='post'>
						<table class="table table-bordered table-striped table-hover" id="table-bet-index">
						
                         <thead>
                                <tr>
                                    <th><?=$translate['time']?></th>
                                    <th></th>
                                    <th><?=$translate['game']?></th>
                                    <th></th>
                                    <th></th>
                                    <th>1</th>
                                    <th>X</th>
                                    <th>2</th>
                                </tr>
                           
  						</thead>
                           <tbody onclick="open_panel()">
    <?php
    

		while ($row = $games->fetch(PDO::FETCH_ASSOC)){
			$results[] = $row['team1'];
			$results[] = $row['team2'];
		$br++;

		$date_and_time = date_create($row['beginning']);
		$date_and_time =  date_format($date_and_time,"Y/m/d H:i");
		$date = date_create($row['beginning']);
		$date =  date_format($date," d/m/Y");
		$time = date_create($row['beginning']);
		$time2 = date_create($row['beginning']);
		$time2 =  date_format($time2," H:i");
		$time =  date_format($time,"Y/m/d: H:i");

		$state = Profil::TimeZone($_SESSION['City']);
		$kraj = date_create($row['beginning']);
		$kraj->modify($state.'minutes');
		$time = date_format($kraj,"Y/m/d H:i");
		$timez = date_format($kraj,"Y/m/d H:i");
		$time2 = date_format($kraj,"H:i");

		$time_zone = $_SESSION['City'];
		date_default_timezone_set($time_zone);
		$saddate = Date(" d/m/Y");
		$sad = Date("Y/m/d H:i");
		$sadtime = Date(" H:i");

		 if ($sad > $time) {
		 	$color = "color:#8c8c8c; text-align:center;";
		 	$hiden_style = "class='is-disabled'";
		 	$hiden_style2 = "visibility: hidden;";
		 }else{
		 	$color = "text-align:center;";
		 	$hiden_style = "";
		 	$hiden_style2 = "";
		 }
		if ($date == $saddate) {
			$time = $translate['today'].": ".$time2;

		}
		 
	   if (in_array($row['team1'], $results) AND in_array($row['team2'], $results)){
	   			$tims1=$row['team1'];
	   			$tims1 = str_replace(' ', '-', $tims1);
		  $img_tim1 = "<img src='img-clubs/{$tims1}.png' alt='{$tims1}'>";
		  		$tims2=$row['team2'];
		  		$tims2 = str_replace(' ', '-', $tims2);
		  $img_tim2 = "<img src='img-clubs/{$tims2}.png' alt='{$tims2}'>";
		}else{
		  	$img_tim1 = '';
		  	$img_tim2 = '';
		  }
		if ($row['tip_win'] == 1) {
			$kec = "background-color: #25765C;";
		}else{
			$kec = "";
		}
		if ($row['tip_win'] == 'X') {
			$X = "background-color: #25765C;";
		}else{
			$X = "";
		}
		if ($row['tip_win'] == 2) {
			$dva = "background-color: #25765C;";
		}else{
			$dva = "";
		}

		?>
						
                        <tr>
                                    <td class="date-field" style="<?=$color?>"><?=$time?></td>
                                    <td><?=$img_tim1?></td>
                                    <td style="<?=$color?>"><?=$row['team1']?> - <?=$row['team2']?></td>
                                    <td><?=$img_tim2?></td>
                                    <td style="color:orange;"><?=$row['goals_home']?> - <?=$row['goals_away']?></td>
                                    <td style="<?=$kec?><?=$color?><?=$hiden_style?>" ><input type="radio" name="<?=$br?>" value="1: <?=$row['team1']?> - <?=$row['team2']?>*,<?=$row['tip1']?>"><?=$row['tip1']?></td>

                                    <td style="<?=$X?><?=$color?><?=$hiden_style?>" ><input type="radio" name="<?=$br?>" value="X: <?=$row['team1']?> - <?=$row['team2']?>*,<?=$row['tip_x']?>" ><?=$row['tip_x']?></td>

                                    <td style="<?=$dva?><?=$color?><?=$hiden_style?>" ><input type="radio" name="<?=$br?>" value="2: <?=$row['team1']?> - <?=$row['team2']?>*,<?=$row['tip2']?>"><?=$row['tip2']?></td>
                                </tr>

			
		
		<?php
				
				
			if (!isset($_POST[$br])) {
				$_POST[$br] = null;
			}else{
				
				$ticket_games .= str_replace('*,',': '," <br>".$_POST[$br]);

				$search_ticket2 = array(',','2:','1:','X:');
				$ticket_games2 .= str_replace($search_ticket2,'',$_POST[$br]);

				$b = $_POST[$br];
				$b = strstr($b, ',');
				$b = str_replace(',' , '', $b);
				
				$a *= $b;
       			
       			$time_games[] = $timez;
       			

			}
			
	
	}
	echo "</tbody>";
echo "</table>";


?><div class="row" id="slider" style="left:-264px;">
                                
                                <div class="col-md-12" id="header">
                                    <!--<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 stake-container">-->
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label for="InputStake"><?=$translate['stake']?>:</label>
                                        <input type="number" name="uplata" class="form-control" id="InputStake">
                                    </div>
                                    <div class="form-group winning-field">
                                        <label for="InputWinnings"><?=$translate['possibile_win']?>:</label>
                                        <input type="text" name="proizvod-kvota" class="form-control" id="InputWinnings" disabled placeholder="0.00">
                                    </div>
                                </div>
                                <div class="form-group">
                             <button type="submit" name="submit_ticket" class="btn btn-info btn-block btn-bet"><?=$translate['submit']?></button>
                                </div>

                            <!--</div>-->
                                </div>
                                <div id="sidebar" name="submit_ticket" onclick="open_panel()"><button type="submit" class="btn btn-primary btn-block btn-slider" id="klinac"><?=$translate['stake']?></button></div>
                            </div>
                            <!-- Sliding div ends here -->
</form>
<?php
if (isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user_id}'");
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$k = $row['user_money'];
					}

}
if (isset($k) AND $k > 1){

?>
 
	<?php
	$first_game_time = current($time_games);
	$last_game_time = end($time_games);
}elseif(empty($_SESSION['name']) AND empty($_SESSION['id'])) {
	echo "";
}else{
	echo "<center><p>".$translate['dont_have_money']."</p><center>";
}
if (isset($_SESSION['name']) AND !empty($_SESSION['id'])) {
	if (isset($_POST['submit_ticket'])) {
		if (!empty($_POST['uplata'])) {
			if (!empty($a) AND $a > 1) {
				if (!empty($first_game_time)) {
					
				}else{
					$first_game_time = Date("Y/m/d H:i");
				}
   				if (new DateTime($first_game_time) > new DateTime()) {
   				 if ($_POST['uplata'] <= $k) {
   				  	
			
				$uplata = $_POST['uplata'];
				$moguci_dobitak = $uplata * $a;
				$user_id = $_SESSION['id'];
						
		$insert_ticket = self::$db->query("INSERT INTO tickets (g_match, allocation, t_money, pos_win, id_user, time_a, first_game_start, last_game_start) VALUES ('{$ticket_games}', '{$a}', '{$uplata}', '{$moguci_dobitak}', '{$user_id}', '{$sad}', '{$first_game_time}', '{$last_game_time}')");
		$insert_tickets = self::$db->query("INSERT INTO winers (g_match_w, allocation_w, t_money_w, pos_win_w, id_user_w, time_w, first_game_start_w, last_game_start_w) VALUES ('{$ticket_games2}', '{$a}', '{$uplata}', '{$moguci_dobitak}', '{$user_id}', '{$sad}', '{$first_game_time}', '{$last_game_time}')");

				
						if ((!$insert_ticket == NULL) AND (!$insert_tickets == NULL)) {
						
							$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user_id}'");
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$k = $row['user_money'];
					$money_enter = $row['enter_money'];
					$user = $row['user'];

					}
		
							$minus = $k - $uplata;
							$plus_money_enter = $money_enter + $uplata;
							$update = self::$db->query("UPDATE users SET user_money = '{$minus}' WHERE id_users = '{$user_id}'");
							$update_money_win = self::$db->query("UPDATE users SET enter_money = '{$plus_money_enter}' WHERE id_users = '{$user_id}'");

						if (!$update == NULL){
							$ongoings_text = '<a style="color:orange;" href="profil.php?id='.$user_id.'">'.$user.'</a> successfully submited new ticket, stake '.number_format($uplata,2).' possibile win '.number_format($moguci_dobitak,2);
							$insert_ongoings= self::$db->query("INSERT INTO ongoings (ongoings_text) VALUES ('{$ongoings_text}')");
							return "<p style='color:green;clear:both;text-align:center'>".$translate['ticket_success']."</p>";
							
							return "<p style='color:green;clear:both;text-align:center'>".$translate['ticket_success']."</p>";
									unset($_POST['submit_ticket']);
									unset($_POST['uplata']);
									unset($_POST['uplata']);
									header('Location:' . $_SERVER['HTTP_REFERER']);
						
						}else{
							echo "<p style='color:#e6e6e6;clear:both;text-align:center'>Ticket is not submited!</p>";
							}
							
						}else{
							echo "<p style='color:#e6e6e6;clear:both;text-align:center'>Game is not added</p>";
						}
						}else{
								echo "<p style='color:#e6e6e6;clear:both;text-align:center'>".$translate['dont_have_that_money']."</p>";
							}
					}else{
							echo "<p style='color:#e6e6e6;clear:both;text-align:center'>".$translate['late']."</p>";

						}
					}else{
						echo "<p style='color:#e6e6e6;clear:both;text-align:center'>".$translate['must_pick']."</p>";
						
						}
					}else{
						 	echo "<p style='color:#e6e6e6;clear:both;text-align:center'>".$translate['insert_stake']."</p>";
						}
						
}

}else{
		echo "<p style='color:#e6e6e6;'>".$translate['registered']."</p>";
	}

}
public static function WinersShowTickets(){
	$translate = Profil::Translate($_SESSION['City']);
	if (isset($_SESSION['id'])) {
		$id= $_SESSION['id'];
	$db_name = Config::get('DB/db_name');
		$time_zone = $_SESSION['City'];
		date_default_timezone_set($time_zone);
		$sad = Date("Y-m-d H:i");
	$tickets = self::$db->query("SELECT * FROM {$db_name}.winers,{$db_name}.tickets WHERE id_user_w = '{$id}' ORDER BY tickets.id_tickets DESC");
echo '<table class="table table-bordered table-striped table-hover" id="table-list">';
$games = self::$db->query("SELECT * FROM games ORDER BY beginning ASC");

		while ($row = $tickets->fetch(PDO::FETCH_ASSOC)){
		

				
									if (($row['g_match'] === $row['g_match_w']) AND ($row['id_tickets'] === $row['id_tickets_w'])){
										?>
										 <thead>
                                        <tr>
                                            <th style='color:#4dff4d;'><?=$translate['game']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['stake']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['odds']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['you_win']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['ticket_no']?></th>

                                            <th style='color:#4dff4d;'><?=$translate['action']?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
										
										<tr>
                                            <td style='color:#4dff4d;'><?=$row['g_match']?></td>
                                            <td><br><?=number_format($row['allocation_w'],2)?></td>
                                            <td><br><?=number_format($row['t_money'],2)?></td>
                                            <td><br><?=number_format($row['pos_win'],2)?></td>
                                            <td><br><?=$row['id_tickets']?></td>
                                            <td><br><a href="pay.php?id=<?=$row['id_tickets']?>&pay=<?=$row['pos_win']?>&user=<?=$row['id_user']?> "><?=$translate['take_money']?></a></td>
                                        </tr>

                                        </tbody>
									<?php
										$win_insert_ticket = self::$db->query("INSERT INTO final_winers (win_id_tickets, win_g_match, win_allocation, win_t_money, win_pos_win, win_id_user) VALUES ({$row['id_tickets']}, '{$row['g_match']}', {$row['allocation']}, {$row['t_money']}, {$row['pos_win']}, {$row['id_user']})");

										$win_insert_winer_ticket = self::$db->query("INSERT INTO winer_tickets (winer_tickets_win_id_tickets, winer_tickets_g_match, winer_tickets_allocation, winer_tickets_win_t_money, winer_tickets_win_pos_win, winer_ticket_win_id_user) VALUES ({$row['id_tickets']}, '{$row['g_match']}', {$row['allocation']}, {$row['t_money']}, {$row['pos_win']}, {$row['id_user']})");
										
										}elseif ($row['id_tickets'] === $row['id_tickets_w']){

											?>

										 <thead>
                                        <tr>
                                        	
                                            <th><a style='color:black;' target="_blank" href="/ticket.php?id=<?=$row['id_tickets']?>&winer=0"><?=$translate['game']?> Ticket id: <?=$row['id_tickets']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                            <th><?=$translate['possibile_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['action']?></th>
                                          	<th>LIKE</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
										
										<tr>
										
										
											
                                            <td><?=$row['g_match']?></td>
                                            <td><br><?=number_format($row['t_money'],2)?></td>
                                            <td><br><?=number_format($row['allocation'],2)?></td>
                                            <td><br><?=number_format($row['pos_win'],2)?></td>
                                            <td><br><?=$row['id_tickets']?></td>
                                            <td><br>
                                            <?php
                                            if ($sad > $row['first_game_start']) {
                                            	echo "<a href='trash.php?id={$row['id_tickets']}'><img src='img/trash.png' data-toggle='tooltip' data-placement='bottom' title={$translate['before_throw']}'></a>";
                                            	
                                            }else{
                                            	echo "<a href='storn.php?id={$row['id_tickets']}&pay={$row['t_money']}&user={$row['id_user']}'><img src='img/storn.png' data-toggle='tooltip' data-placement='bottom' title='Storn'></a>";
                                            	
                                            }
                                            

                                            ?></td>
                                       		<td><center><div class="fb-like" data-href="/ticket.php?id=<?=$row['id_tickets']?>&winer=0" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></center></td>
                                        </tbody>

									<?php


										}
				}
				
				echo "</table>";
}
}
public static function Storn($id_tickets,$pay,$user){

$result = self::$db->query("SELECT * FROM users WHERE id_users = {$user}");

					while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					$id_user = $row['id_users'];
					}
					
					if ($_SESSION['id'] == $id_user) {
							$plus = $money + $pay;

	$update = self::$db->query("UPDATE users SET user_money = '{$plus}' WHERE id_users = '{$user}'");
	if (!$update == NULL){

				$game_delete_w = self::$db->query("DELETE FROM winers WHERE id_tickets_w = '{$id_tickets}'");
				$game_delete = self::$db->query("DELETE FROM tickets WHERE id_tickets = '{$id_tickets}'");
					}
					if ((!$game_delete_w == NULL) AND (!$game_delete == NULL)){
											header('Location:' . $_SERVER['HTTP_REFERER']);
										
							}
		}else{
			die('Its not your ticket!');
			
		}
}
public static function ShowTicketsTop($id){
	$translate = Profil::Translate($_SESSION['City']);
	$db_name = Config::get('DB/db_name');
	$tickets = self::$db->query("SELECT * FROM {$db_name}.winers,{$db_name}.tickets WHERE id_user_w = '{$id}' ORDER BY tickets.id_tickets DESC");
	
echo '<table class="table table-bordered table-striped table-hover" id="table-bet">';
			
		while ($row = $tickets->fetch(PDO::FETCH_ASSOC)){
			if (($row['g_match'] === $row['g_match_w']) AND ($row['id_tickets'] === $row['id_tickets_w'])){
?>
									<thead>
                                        <tr>
                                            <th><?=$translate['game']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                            <th><?=$translate['you_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>

                                            <?php
                                            if ($_SESSION['id'] === $row['id_user']) {
                                            	echo "<th>".$translate['action']."</th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
										
										<tr>
                                            <td style='color:#4dff4d;'><?=$row['g_match']?></td>
                                            <td style='color:#4dff4d;'><br><?=number_format($row['t_money'],2)?></td>
                                            <td><br><?=number_format($row['allocation'],2)?></td>
                                            <td style='color:#4dff4d;'><br><?=number_format($row['pos_win'],2)?></td>

                                            <td><br><?=$row['id_tickets']?></td>

                                            <?php
                                            if ($_SESSION['id'] === $row['id_user']) {
                                            	?><td><br><a href="pay.php?id=<?=$row['id_tickets']?>&pay=<?=$row['pos_win']?>&user=<?=$row['id_user']?> "><?=$translate['take_money']?></a></td>";
                                            	<?php
                                            }
                                            ?>

                                        </tr>

                                        </tbody>
                                       

<?php


										}elseif ($row['id_tickets'] === $row['id_tickets_w']){
									
?>

									<thead>
                                        <tr>
                                            <th><a style='color:black;' target="_blank" href="/ticket.php?id=<?=$row['id_tickets']?>&winer=0"><?=$translate['game']?> Ticket id: <?=$row['id_tickets']?></a></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                            <th><?=$translate['possibile_win']?></th>
                                            <th><?=$translate['time']?></th>
                                            <th><?=$translate['ticket_no']?></th>

                                            <?php 
                                            if (isset($_SESSION['id'])) {
	                                            	if ($_SESSION['id'] === $row['id_user']) {
	                                            echo '<th>'.$translate['action'].'</th>';

	                                            }
                                            }
                                            
                                            ?>
                                            <th>LIKE</th>
                                        </tr>
                                    </thead>

                                    <tbody>
										
										<tr>
                                            <td style="color: #cccccc;"><?=$row['g_match']?></td>
                                            <td style="color: #cccccc;"><br><?=number_format($row['t_money'],2)?></td>
                                            <td style="color: #cccccc;"><br><?=number_format($row['allocation'],2)?></td>
                                            <td style="color: #cccccc;"><br><?=number_format($row['pos_win'],2)?></td>
                                            <td style="color: #cccccc;"><br><?=$row['time_a']?></td>
                                            <td style="color: #cccccc;"><br><?=$row['id_tickets']?></td>
                                            <?php 
                                            if (isset($_SESSION['id'])) {
	                                            	if ($_SESSION['id'] === $row['id_user']) {
	                                            	?>
	                                            	<td><a href="trash.php?id=<?=$row['id_tickets']?>"><img src="img/trash.png" alt="trash"></a></td>
	                                            	<?php
	                                            }
                                            }
                                            
                                            
                                            ?>
                                            <td><center><div class="fb-like" data-href="/ticket.php?id=<?=$row['id_tickets']?>&winer=0" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></center></td>
                                            </tr>
                                            </tbody>
                                           

                                       
<?php
											

										}

 
				}
			
 echo "</table>";
			
			
	$win_tickets = self::$db->query("SELECT * FROM winer_tickets WHERE winer_ticket_win_id_user = '{$id}' ORDER BY winer_tickets_time DESC LIMIT 10");
	echo "<br><br>";
	echo '<table class="table table-bordered table-striped table-hover" id="table-list">';
		while ($row_winer = $win_tickets->fetch(PDO::FETCH_ASSOC)){
			?>
									<thead>
                                        <tr>
                                            <th><a style='color:black;' target="_blank" href="/ticket.php?id=<?=$row_winer['winer_tickets_win_id_tickets']?>&winer=1"><?=$translate['last10']?> Ticket id: <?=$row_winer['winer_tickets_win_id_tickets']?></a></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                            <th><?=$translate['possibile_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['time']?></th>
                                            <th>LIKE</th>
                                        </tr>
                                    </thead>
										<tbody>
										
											<tr>
	                                            <td style='color:#4dff4d;'><?=$row_winer['winer_tickets_g_match']?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_win_t_money'],2)?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_allocation'],2)?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_win_pos_win'],2)?></td>
	                                            <td><br><?=$row_winer['winer_tickets_win_id_tickets']?></td>
	                                            <td><br><?=$row_winer['winer_tickets_time']?></td>
	                                           <td><center><div class="fb-like" data-href="/ticket.php?id=<?=$row_winer['winer_tickets_win_id_tickets']?>&winer=1" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></center></td>
	                                            <tr><td colspan="7">
	                                            <li>
                                            <?php
                                            Game::ShowComments($row_winer['winer_tickets_win_id_tickets'],$row_winer['winer_ticket_win_id_user']);
                                            ?>
</li>
                   <form action='add-comment.php' method='POST'>
                        <div class="comment-main-level">
                                        <div class="comment-box-main">
                                            <div class="comment-content">
                                                <textarea type="text" name="comment"  class="main-message" placeholder="<?=$translate['your_comment']?>"></textarea>
                                                <input type="hidden" name="id_tickets" value="<?=$row_winer['winer_tickets_win_id_tickets']?>">
                            					<input type="hidden" name="id_user" value="<?=$row['id_user']?>">
                                                <div class="form-group">
                                                 <button type="submit" name="submit_comment" class="btn btn-info btn-block btn-list" value="true"><?=$translate['submit']?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                
                      
                    </form>


                    

                    						</td></tr>
                                        </tr>
                                        </tbody>
                    
									
			<?php
			

		}
				
				echo '</table>';
}
public static function ShowTicket($id,$winer){
	if (isset($id) AND isset($winer)) {
		if ($winer == 1) {
	$translate = Profil::Translate($_SESSION['City']);
	$db_name = Config::get('DB/db_name');
	$win_tickets = self::$db->query("SELECT * FROM winer_tickets WHERE winer_tickets_win_id_tickets= '{$id}'");
	$row_user = $win_tickets->fetch(PDO::FETCH_ASSOC);

	$id_user = $row_user['winer_ticket_win_id_user'];
	$win_user = self::$db->query("SELECT * FROM users WHERE id_users= {$id_user}");
	$user = $win_user->fetch(PDO::FETCH_ASSOC);
	
	$win_ticketss = self::$db->query("SELECT * FROM winer_tickets WHERE winer_tickets_win_id_tickets= '{$id}'");
	echo "<br><br>";
	echo '<table class="table table-bordered table-striped table-hover" id="table-list">';
		while ($row_winer = $win_ticketss->fetch(PDO::FETCH_ASSOC)){
			?>
									<thead>
                                        <tr>
                                            <th><?=$translate['last10']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                           <th><?=$translate['you_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['time']?></th>
                                            <th>User</th>
                                            <th>LIKE</th>
                                        </tr>
                                    </thead>
										<tbody>
										
											<tr>
	                                            <td style='color:#4dff4d;'><?=$row_winer['winer_tickets_g_match']?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_win_t_money'],2)?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_allocation'],2)?></td>
	                                            <td><br><?=number_format($row_winer['winer_tickets_win_pos_win'],2)?></td>
	                                            <td><br><?=$row_winer['winer_tickets_win_id_tickets']?></td>
	                                            <td><br><?=$row_winer['winer_tickets_time']?></td>
	                                            <td><br><?=$user['user']?></td>
	                                            <td><center><div class="fb-like" data-href="<?=$actual_link?>" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></center></td>
	                                            <tr><td colspan="8">
	                                            <li>
                                            <?php
                                            Game::ShowComments($row_winer['winer_tickets_win_id_tickets'],$row_winer['winer_ticket_win_id_user']);
                                            ?>
</li>
                   <form action='add-comment.php' method='POST'>
                        <div class="comment-main-level">
                                        <div class="comment-box-main">
                                            <div class="comment-content">
                                                <textarea type="text" name="comment"  class="main-message" placeholder="<?=$translate['your_comment']?>"></textarea>
                                                <input type="hidden" name="id_tickets" value="<?=$row_winer['winer_tickets_win_id_tickets']?>">
                            					<input type="hidden" name="id_user" value="<?=$row['id_user']?>">
                                                <div class="form-group">
                                                 <button type="submit" name="submit_comment" class="btn btn-info btn-block btn-list" value="true"><?=$translate['submit']?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                
                      
                    </form>


                    

                    						</td></tr>
                                        </tr>
                                        </tbody>
                    
									
			<?php
	}
		}elseif($winer == 0){
			$translate = Profil::Translate($_SESSION['City']);
	$db_name = Config::get('DB/db_name');
	$win_tickets = self::$db->query("SELECT * FROM tickets WHERE id_tickets= '{$id}'");
	$row_user = $win_tickets->fetch(PDO::FETCH_ASSOC);

	$id_user = $row_user['id_user'];
	$win_user = self::$db->query("SELECT * FROM users WHERE id_users= {$id_user}");
	$user = $win_user->fetch(PDO::FETCH_ASSOC);
	
	$win_ticketss = self::$db->query("SELECT * FROM tickets WHERE id_tickets= '{$id}'");
	echo "<br><br>";
	echo '<table class="table table-bordered table-striped table-hover" id="table-list">';
		while ($row_winer = $win_ticketss->fetch(PDO::FETCH_ASSOC)){
			?>
									<thead>
                                        <tr>
                                            <th><?=$translate['last10']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                           <th><?=$translate['possibile_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['time']?></th>
                                            <th>User</th>
                                            <th>LIKE</th>
                                        </tr>
                                    </thead>
										<tbody>
										
											<tr>
	                                            <td><?=$row_winer['g_match']?></td>
	                                            <td><br><?=number_format($row_winer['t_money'],2)?></td>
	                                            <td><br><?=number_format($row_winer['allocation'],2)?></td>
	                                            <td><br><?=number_format($row_winer['pos_win'],2)?></td>
	                                            <td><br><?=$row_winer['id_tickets']?></td>
	                                            <td><br><?=$row_winer['time_a']?></td>
	                                            <td><br><?=$user['user']?></td>
	                                            <td><center><div class="fb-like" data-href="<?=$actual_link?>" data-layout="box_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></center></td>
	                                            <tr><td colspan="8">
	                                            <li>
                                            <?php
                                            Game::ShowComments($row_winer['id_tickets'],$row_winer['id_user']);
                                            ?>
</li>
                   <form action='add-comment.php' method='POST'>
                        <div class="comment-main-level">
                                        <div class="comment-box-main">
                                            <div class="comment-content">
                                                <textarea type="text" name="comment"  class="main-message" placeholder="<?=$translate['your_comment']?>"></textarea>
                                                <input type="hidden" name="id_tickets" value="<?=$row_winer['winer_tickets_win_id_tickets']?>">
                            					<input type="hidden" name="id_user" value="<?=$row['id_user']?>">
                                                <div class="form-group">
                                                 <button type="submit" name="submit_comment" class="btn btn-info btn-block btn-list" value="true"><?=$translate['submit']?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                
                      
                    </form>


                    

                    						</td></tr>
                                        </tr>
                                        </tbody>
                    
									
			<?php
	}
		}else{
			echo "NOT Exists";
		}
	
	
			

		}
				
				echo '</table>';
}
public static function ShowTicketInfo($id,$winer){
	if (isset($id) AND isset($winer)) {
		if ($winer == 1) {
	$translate = Profil::Translate($_SESSION['City']);
	$db_name = Config::get('DB/db_name');
	$win_tickets = self::$db->query("SELECT * FROM winer_tickets WHERE winer_tickets_win_id_tickets= '{$id}'");
	$row_user = $win_tickets->fetch(PDO::FETCH_ASSOC);

	$id_user = $row_user['winer_ticket_win_id_user'];
	$win_user = self::$db->query("SELECT * FROM users WHERE id_users= {$id_user}");
	$user = $win_user->fetch(PDO::FETCH_ASSOC);
	
	$win_ticketss = self::$db->query("SELECT * FROM winer_tickets WHERE winer_tickets_win_id_tickets= '{$id}'");
	
		while ($row_winer = $win_ticketss->fetch(PDO::FETCH_ASSOC)){
			$text = $row_winer['winer_tickets_g_match'];
			
			$allocation = number_format($row_winer['winer_tickets_allocation'],2);
	        $bet = number_format($row_winer['winer_tickets_win_t_money'],2);
	        $posibile_win = number_format($row_winer['winer_tickets_win_pos_win'],2);
	        $time = $row_winer['winer_tickets_time'];
	        $player = $user['user'];
	        $id = $row_winer['winer_tickets_win_id_tickets'];
	        $winer = 1;
                                           return $array = array('text' => $text, 'allocation' => $allocation, 'bet' => $bet, 'posibile_win' => $posibile_win, 'time' => $time, 'player' => $player, 'id' => $id, 'winer' => $winer);
                    
									
			
	}
		}elseif($winer == 0){
			$translate = Profil::Translate($_SESSION['City']);
	$db_name = Config::get('DB/db_name');
	$win_tickets = self::$db->query("SELECT * FROM tickets WHERE id_tickets= '{$id}'");
	$row_user = $win_tickets->fetch(PDO::FETCH_ASSOC);

	$id_user = $row_user['id_user'];
	$win_user = self::$db->query("SELECT * FROM users WHERE id_users= {$id_user}");
	$user = $win_user->fetch(PDO::FETCH_ASSOC);
	
	$win_ticketss = self::$db->query("SELECT * FROM tickets WHERE id_tickets= '{$id}'");
		
		while ($row_winer = $win_ticketss->fetch(PDO::FETCH_ASSOC)){
			$text = $row_winer['g_match'];

			$allocation = number_format($row_winer['allocation'],2);
	        $bet = number_format($row_winer['t_money'],2);
	        $posibile_win = number_format($row_winer['pos_win'],2);
	        $time = $row_winer['time_a'];
	        $player = $user['user'];
	        $id = $row_winer['id_tickets'];
	        $winer = 0;
                                 return $array = array('text' => $text, 'allocation' => $allocation, 'bet' => $bet, 'posibile_win' => $posibile_win, 'time' => $time, 'player' => $player, 'id' => $id, 'winer' => $winer);
	}
		}else{
			echo "NOT Exists";
		}
	
	
			

		}
				
				echo '</table>';
}
public static function WinersShowTicketsAdmin($id){
	$translate = Profil::Translate($_SESSION['City']);
	if (isset($id)) {
	$db_name = Config::get('DB/db_name');
	$tickets = self::$db->query("SELECT * FROM {$db_name}.winers,{$db_name}.tickets WHERE id_user_w = '{$id}' ORDER BY tickets.id_tickets DESC");
echo '<table class="table table-bordered table-striped table-hover" id="table-list">';
$games = self::$db->query("SELECT * FROM games ORDER BY beginning ASC");

		while ($row = $tickets->fetch(PDO::FETCH_ASSOC)){
		

				
									if (($row['g_match'] === $row['g_match_w']) AND ($row['id_tickets'] === $row['id_tickets_w'])){
										?>
										 <thead>
                                        <tr>
                                            <th style='color:#4dff4d;'><?=$translate['game']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['stake']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['odds']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['you_win']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['ticket_no']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['time']?></th>
                                            <th style='color:#4dff4d;'><?=$translate['action']?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
										
										<tr>
                                            <td style='color:#4dff4d;'><?=$row['g_match']?></td>
                                            <td><br><?=number_format($row['allocation_w'],2)?></td>
                                            <td><br><?=number_format($row['t_money'],2)?></td>
                                            <td><br><?=number_format($row['pos_win'],2)?></td>
                                            <td><br><?=$row['id_tickets']?></td>
                                            <td><br><?=$row['time_a']?></td>
                                            <td><br><a href="pay.php?id=<?=$row['id_tickets']?>&pay=<?=$row['pos_win']?>&user=<?=$row['id_user']?> "><?=$translate['take_money']?></a></td>
                                        </tr>

                                        </tbody>
									<?php
										$win_insert_ticket = self::$db->query("INSERT INTO final_winers (win_id_tickets, win_g_match, win_allocation, win_t_money, win_pos_win, win_id_user) VALUES ({$row['id_tickets']}, '{$row['g_match']}', {$row['allocation']}, {$row['t_money']}, {$row['pos_win']}, {$row['id_user']})");

										$win_insert_winer_ticket = self::$db->query("INSERT INTO winer_tickets (winer_tickets_win_id_tickets, winer_tickets_g_match, winer_tickets_allocation, winer_tickets_win_t_money, winer_tickets_win_pos_win, winer_ticket_win_id_user) VALUES ({$row['id_tickets']}, '{$row['g_match']}', {$row['allocation']}, {$row['t_money']}, {$row['pos_win']}, {$row['id_user']})");
										
										}elseif ($row['id_tickets'] === $row['id_tickets_w']){

											?>

										 <thead>
                                        <tr>
                                        	
                                            <th><?=$translate['game']?></th>
                                            <th><?=$translate['stake']?></th>
                                            <th><?=$translate['odds']?></th>
                                            <th><?=$translate['possibile_win']?></th>
                                            <th><?=$translate['ticket_no']?></th>
                                            <th><?=$translate['time']?></th>
                                            <th><?=$translate['action']?></th>
                                          
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
										
										<tr>
										
										
											
                                            <td><?=$row['g_match']?></td>
                                            <td><br><?=number_format($row['t_money'],2)?></td>
                                            <td><br><?=number_format($row['allocation'],2)?></td>
                                            <td><br><?=number_format($row['pos_win'],2)?></td>
                                            <td><br><?=$row['id_tickets']?></td>
                                            <td><br><?=$row['time_a']?></td>
                                            <td><br><a href="trash.php?id=<?=$row['id_tickets']?>"><img src="img/trash.png" data-toggle="tooltip" data-placement="bottom" title="<?=$translate['before_throw']?>"></a></td>
                                       		
                                        </tbody>

									<?php


										}
				}
				
				echo "</table>";
}
}
public static function Trash($id_tickets){
	$status = self::$db->query("SELECT * FROM tickets WHERE id_tickets = '{$id_tickets}'");
	while ($row = $status->fetch(PDO::FETCH_ASSOC)){
		$id_user = $row['id_user'];
	}
	if ($_SESSION['id'] == $id_user OR $_SESSION['id'] == 3) {
			$game_delete_w = self::$db->query("DELETE FROM winers WHERE id_tickets_w = '{$id_tickets}'");
			$game_delete = self::$db->query("DELETE FROM tickets WHERE id_tickets = '{$id_tickets}'");
			$game_delete_comments = self::$db->query("DELETE FROM comments WHERE ticket_id = '{$id_tickets}'");
		}else{
			echo $translate['not_yours'];
		}

	if (isset($game_delete_w)) {
		if ((!$game_delete_w == NULL) AND (!$game_delete == NULL)){
							header('Location:' . $_SERVER['HTTP_REFERER']);
						
						}else{
							echo "Game not Deleted!";
							}
	}
	
	

}
public static function Pay($id_tickets,$pay,$user){

$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user}'");
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					$id_user = $row['id_users'];
					$name = $row['user'];
					$win_money = $row['win_money'];
					}

$ticket = self::$db->query("SELECT * FROM final_winers WHERE win_id_tickets = {$id_tickets}  AND win_id_user = {$user} AND win_pos_win = {$pay}");	
while ($rows = $ticket->fetch(PDO::FETCH_ASSOC)) {
					$ticket_id = $rows['win_id_tickets'];
					$kes = $rows['win_pos_win'];
					
					}
					
					if (($_SESSION['id'] == $id_user) AND ($pay == $kes) AND ($ticket_id == $id_tickets)) {
							$plus = $money + $pay;

	$update = self::$db->query("UPDATE users SET user_money = '{$plus}' WHERE id_users = '{$user}'");
	if (!$update == NULL){
				$enter_money_win = $win_money + $pay;
				$update_money_win = self::$db->query("UPDATE users SET win_money = {$enter_money_win} WHERE id_users = '{$user}'");
				$game_delete_w = self::$db->query("DELETE FROM winers WHERE id_tickets_w = '{$id_tickets}'");
				$game_delete = self::$db->query("DELETE FROM tickets WHERE id_tickets = '{$id_tickets}'");
				$final_game_delete = self::$db->query("DELETE FROM final_winers WHERE win_id_tickets = {$id_tickets}");
					}
					if ((!$game_delete_w == NULL) AND (!$game_delete == NULL) AND (!$final_game_delete == NULL)){
						$ongoings_text = 'Congratulations <a style="color:orange;" href="profil.php?id='.$id_user.'">'.$name.'</a> is won '.number_format($pay,2).' virtual money! ticket id: '.$ticket_id.'';
						$insert_ongoings= self::$db->query("INSERT INTO ongoings (ongoings_text) VALUES ('{$ongoings_text}')");

											header('Location:' . $_SERVER['HTTP_REFERER']);
										
							}
		}else{
			die('Its not your ticket!');
			
		}
}


public static function AddComments($ticket_id,$user_id,$comment,$user_name,$ids,$img){
	$comment = strip_tags($comment);
    $comment = str_replace("'", "", $comment);
    $comment = str_replace('"', '', $comment);
				$add_comments = self::$db->query("INSERT INTO comments (user_id, ticket_id, comment, user_name, id_reaciver,user_img) VALUES ({$user_id}, {$ticket_id}, '{$comment}', '{$user_name}', '{$ids}', '{$img}')");
					if (!$add_comments == NULL) {
$commented = self::$db->query("SELECT * FROM users WHERE id_users = '{$ids}'");
	while ($row = $commented->fetch(PDO::FETCH_ASSOC)) {
		$commented_name = $row['user'];
		$commented_id = $row['id_users'];
	}
						$ongoings_text = '<a style="color:orange;" href="profil.php?id='.$user_id.'">'.$user_name.'</a> is commented  <a style="color:orange;" href="profil.php?id='.$commented_id.'">'.$commented_name.'</a> ticket!';
							$insert_ongoings= self::$db->query("INSERT INTO ongoings (ongoings_text) VALUES ('{$ongoings_text}')");
						header('Location:' . $_SERVER['HTTP_REFERER']);
					}else{
						echo "NOT OK!";
					}
			
		
	
	
}

public static function ShowComments($id,$id_member){
	if (isset($_SESSION['id'])) {
		$show_comments = self::$db->query("SELECT * FROM comments WHERE ticket_id = '{$id}'");

				while ($row = $show_comments->fetch(PDO::FETCH_ASSOC)) {
					?>
									
										<div class="comment-main-level">
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                
                                                <h6 class="comment-name"><a href="profil.php?id=<?=$row['user_id']?>"><?=$row['user_name']?></a></h6>
                                                <span><?=$row['time_comments']?></span>
                                                 <?php
                                                 $id = $_GET['id'];
                                                	if ($id == $_SESSION['id']) {
                                                		?>
                                                <a href="delete-comment.php?id=<?=$row['id_comments']?>&user=<?=$id_member?>">X</a>
                                                <?php
                                            }
                                                ?>
                                            </div>
                                            <div class="comment-content">
                                                <?=$row['comment']?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

										
                                        <?php
				}
				
	}else{
		echo "<p>Please Login</p>";
	}
	
}
public static function DeleteComment($id,$user){

	if ($user === $_SESSION['id']) {
		$delete_comment = self::$db->query("DELETE FROM comments WHERE id_comments = $id ");
		if (!$delete_comment == NULL) {
				header('Location:' . $_SERVER['HTTP_REFERER']);
			}
	}else{
		echo "its not your comment!";
	}


}
public static function ShowOngoings(){
	$translate = Profil::Translate($_SESSION['City']);
		$show_ongoings = self::$db->query("SELECT * FROM ongoings ORDER BY ongoings_time DESC LIMIT 10");

					while ($row = $show_ongoings->fetch(PDO::FETCH_ASSOC)) {
						$date = date_create($row['ongoings_time']);
						$date =  date_format($date," d/m/Y");
						$saddate = Date(" d/m/Y");
						$time2 = date_create($row['ongoings_time']);
						$time2 =  date_format($time2," H:i");

						if ($date == $saddate) {
			$time = $translate['today'].": " . $time2;
		}else{
			$time = $row['ongoings_time'];
		}

echo '<tr><td>'.$row['ongoings_text'].'</td></tr>';
echo '<tr><td><i>'.$time.'</i></td></tr>';

}
               
}

public static function Slot($user_id){
	$translate = Profil::Translate($_SESSION['City']);
	$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user_id}'");
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					}

	
				
	$s1 = rand(1,10);
	
	$s2 = rand(1,10);
	
	$s3 = rand(1,10);
	

	if ($s1 == 1) {
		$s1 = "<img src='slot-clubs/1.png'>";
	}elseif ($s1 == 2) {
		$s1 = "<img src='slot-clubs/2.png'>";
	}elseif ($s1 == 3) {
		$s1 = "<img src='slot-clubs/3.png'>";
	}elseif ($s1 == 4) {
		$s1 = "<img src='slot-clubs/4.png'>";
	}elseif ($s1 == 5) {
		$s1 = "<img src='slot-clubs/5.png'>";
	}elseif ($s1 == 6) {
		$s1 = "<img src='slot-clubs/6.png'>";
	}elseif ($s1 == 7) {
		$s1 = "<img src='slot-clubs/7.png'>";
	}elseif ($s1 == 8) {
		$s1 = "<img src='slot-clubs/8.png'>";
	}elseif ($s1 == 9) {
		$s1 = "<img src='slot-clubs/9.png'>";
	}else{
		$s1 = "<img src='slot-clubs/10.png'>";
	}



	if ($s2 == 1) {
		$s2 = "<img src='slot-clubs/1.png'>";
	}elseif ($s2 == 2) {
		$s2 = "<img src='slot-clubs/2.png'>";
	}elseif ($s2 == 3) {
		$s2 = "<img src='slot-clubs/3.png'>";
	}elseif ($s2 == 4) {
		$s2 = "<img src='slot-clubs/4.png'>";
	}elseif ($s2 == 5) {
		$s2 = "<img src='slot-clubs/5.png'>";
	}elseif ($s2 == 6) {
		$s2 = "<img src='slot-clubs/6.png'>";
	}elseif ($s2 == 7) {
		$s2 = "<img src='slot-clubs/7.png'>";
	}elseif ($s2 == 8) {
		$s2 = "<img src='slot-clubs/8.png'>";
	}elseif ($s2 == 9) {
		$s2 = "<img src='slot-clubs/9.png'>";
	}else{
		$s2 = "<img src='slot-clubs/10.png'>";
	}



	if ($s3 == 1) {
		$s3 = "<img src='slot-clubs/1.png'>";
	}elseif ($s3 == 2) {
		$s3 = "<img src='slot-clubs/2.png'>";
	}elseif ($s3 == 3) {
		$s3 = "<img src='slot-clubs/3.png'>";
	}elseif ($s3 == 4) {
		$s3 = "<img src='slot-clubs/4.png'>";
	}elseif ($s3 == 5) {
		$s3 = "<img src='slot-clubs/5.png'>";
	}elseif ($s3 == 6) {
		$s3 = "<img src='slot-clubs/6.png'>";
	}elseif ($s3 == 7) {
		$s3 = "<img src='slot-clubs/7.png'>";
	}elseif ($s3 == 8) {
		$s3 = "<img src='slot-clubs/8.png'>";
	}elseif ($s3 == 9) {
		$s3 = "<img src='slot-clubs/9.png'>";
	}else{
		$s3 = "<img src='slot-clubs/10.png'>";
	}

if (isset($_POST['submit_slot']) AND !(empty($_POST['uplata']))) {
	if ($money > 1) {
	echo "<center>".$s1."-".$s2."-".$s3."</center>";
	if ($_POST['uplata'] == 1) {
			$prize_1 = 50;
			$prize_2 = 50;
			$prize_3 = 50;
			$prize_4 = 50;
			$prize_5 = 50;
			$prize_6 = 50;
			$prize_7 = 50;
			$prize_8 = 50;
			$prize_9 = 50;
			$prize_10 = 50;
	}elseif ($_POST['uplata'] == 2) {
			$prize_1 = 100;
			$prize_2 = 100;
			$proze_3 = 100;
			$prize_4 = 100;
			$prize_5 = 100;
			$prize_6 = 100;
			$prize_7 = 100;
			$prize_8 = 100;
			$prize_9 = 100;
			$prize_10 = 100;
	}elseif ($_POST['uplata'] == 3) {
			$prize_1 = 150;
			$prize_2 = 150;
			$prize_3 = 150;
			$prize_4 = 150;
			$prize_5 = 150;
			$prize_6 = 150;
			$prize_7 = 150;
			$prize_8 = 150;
			$prize_9 = 150;
			$prize_10 = 150;
	}elseif ($_POST['uplata'] == 4) {
			$prize_1 = 200;
			$prize_2 = 200;
			$prize_3 = 200;
			$prize_4 = 200;
			$prize_5 = 200;
			$prize_6 = 200;
			$prize_7 = 200;
			$prize_8 = 200;
			$prize_9 = 200;
			$prize_10 = 200;
	}elseif ($_POST['uplata'] == 5) {
			$prize_1 = 250;
			$prize_2 = 250;
			$prize_3 = 250;
			$prize_4 = 250;
			$prize_5 = 250;
			$prize_6 = 250;
			$prize_7 = 250;
			$prize_8 = 250;
			$prize_9 = 250;
			$prize_10 = 250;
	}elseif ($_POST['uplata'] == 6) {
			$prize_1 = 300;
			$prize_2 = 300;
			$prize_3 = 300;
			$prize_4 = 300;
			$prize_5 = 300;
			$prize_6 = 300;
			$prize_7 = 300;
			$prize_8 = 300;
			$prize_9 = 300;
			$prize_10 = 300;
	}elseif ($_POST['uplata'] == 7) {
			$prize_1 = 350;
			$prize_2 = 350;
			$prize_3 = 350;
			$prize_4 = 350;
			$prize_5 = 350;
			$prize_6 = 350;
			$prize_7 = 350;
			$prize_8 = 350;
			$prize_9 = 350;
			$prize_10 = 350;
	}elseif ($_POST['uplata'] == 8) {
			$prize_1 = 400;
			$prize_2 = 400;
			$prize_3 = 400;
			$prize_4 = 400;
			$prize_5 = 400;
			$prize_6 = 400;
			$prize_7 = 400;
			$prize_8 = 400;
			$prize_9 = 400;
			$prize_10 = 400;
	}elseif ($_POST['uplata'] == 9) {
			$prize_1 = 450;
			$prize_2 = 450;
			$prize_3 = 450;
			$prize_4 = 450;
			$prize_5 = 450;
			$prize_6 = 450;
			$prize_7 = 450;
			$prize_8 = 450;
			$prize_9 = 450;
			$prize_10 = 450;
	}elseif ($_POST['uplata'] == 10) {
			$prize_1 = 500;
			$prize_2 = 500;
			$prize_3 = 500;
			$prize_4 = 500;
			$prize_5 = 500;
			$prize_6 = 500;
			$prize_7 = 500;
			$prize_8 = 500;
			$prize_9 = 500;
			$prize_10 = 500;
	}


				if ($s1 == "<img src='slot-clubs/1.png'>" AND $s2 == "<img src='slot-clubs/1.png'>" AND $s3 == "<img src='slot-clubs/1.png'>") {
	$money += $prize_1;
	$insert_money_1 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");
				if (!$insert_money_1 == NULL) {
							$win = $prize_1;
					}
}elseif ($s1 == "<img src='slot-clubs/2.png'>" AND $s2 == "<img src='slot-clubs/2.png'>" AND $s3 == "<img src='slot-clubs/2.png'>") {
	
	$money += $prize_2;
	$insert_money_2 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_2 == NULL) {
							$win = $prize_2;
					}
}elseif ($s1 == "<img src='slot-clubs/3.png'>" AND $s2 == "<img src='slot-clubs/3.png'>" AND $s3 == "<img src='slot-clubs/3.png'>") {
	
	$money += $prize_3;
	$insert_money_3 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_3 == NULL) {
							$win = $prize_3;
					}
}elseif ($s1 == "<img src='slot-clubs/4.png'>" AND $s2 == "<img src='slot-clubs/4.png'>" AND $s3 == "<img src='slot-clubs/4.png'>") {
	
	$money += $prize_4;
	$insert_money_4 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_4 == NULL) {
							$win = $prize_4;
					}
}elseif ($s1 == "<img src='slot-clubs/5.png'>" AND $s2 == "<img src='slot-clubs/5.png'>" AND $s3 == "<img src='slot-clubs/5.png'>") {
	
	$money += $prize_5;
	$insert_money_5 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_5 == NULL) {
							$win = $prize_5;
					}
}elseif ($s1 == "<img src='slot-clubs/6.png'>" AND $s2 == "<img src='slot-clubs/6.png'>" AND $s3 == "<img src='slot-clubs/6.png'>") {
	
	$money += $prize_6;
	$insert_money_6 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_6 == NULL) {
							$win = $prize_6;
					}
}elseif ($s1 == "<img src='slot-clubs/7.png'>" AND $s2 == "<img src='slot-clubs/7.png'>" AND $s3 == "<img src='slot-clubs/7.png'>") {
	
	$money += $prize_7;
	$insert_money_7 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_7 == NULL) {
							$win = $prize_7;
					}
}elseif ($s1 == "<img src='slot-clubs/8.png'>" AND $s2 == "<img src='slot-clubs/8.png'>" AND $s3 == "<img src='slot-clubs/8.png'>") {
	
	$money += $prize_8;
	$insert_money_8 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_8 == NULL) {
							$win = $prize_8;
					}
}elseif ($s1 == "<img src='slot-clubs/9.png'>" AND $s2 == "<img src='slot-clubs/9.png'>" AND $s3 == "<img src='slot-clubs/9.png'>") {
	
	$money += $prize_9;
	$insert_money_9 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_9 == NULL) {
							$win = $prize_9;
					}
}elseif ($s1 == "<img src='slot-clubs/10.png'>" AND $s2 == "<img src='slot-clubs/10.png'>" AND $s3 == "<img src='slot-clubs/10.png'>") {
	
	$money += $prize_10;
	$insert_money_10 = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_10 == NULL) {
							$win = $prize_10;
					}
}else{
	$money -= $_POST['uplata'];
	$insert_money_minus = self::$db->query("UPDATE users SET user_money = '{$money}' WHERE id_users = '{$user_id}'");

				if (!$insert_money_minus == NULL) {
							$win = 0;
					}
}

	}else{
		echo "<p style='color:red;'>You dont have money";
	}
	
}else{
			echo "<img src='slot-clubs/1.png'>-<img src='slot-clubs/1.png'>-<img src='slot-clubs/1.png'>";
		}
		echo "<h2 style='color:green;'>".$money."</h2>";
?>

<form action='/slot.php' method='post'>
    <div class="form-inline">
        <div class="form-group">
            <label for="InputStake"><?=$translate['stake']?>:</label>
            <input type="number" name="uplata" min="1" max="10" class="form-control" id="InputStake" value="<?=$_POST['uplata']?>">
        </div>
        <div class="form-group winning-field">
            <label for="InputWinnings">Dobitak:</label>
            <input type="text" name="proizvod-kvota" class="form-control" id="InputWinnings" disabled placeholder="<?=$win?>">
        </div>
    </div>
    <div class="form-group">
        <button type="submit" name="submit_slot" class="btn btn-info btn-block btn-list"><?=$translate['submit']?></button>
    </div>
</div>
 </form>
<?php
}
}
Game::init();
