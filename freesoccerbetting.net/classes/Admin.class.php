<?php
Class Admin{
	private static $db;
	public static function init(){
		self::$db = Connect::getInstance();
    }
public static function AddGames(){
	if (isset($_POST['submit'])) {
		$team1 = trim($_POST['team1']);
		$team2 = trim($_POST['team2']);
		$beginning = $_POST['beginning'];
		$tip1= $_POST['tip1'];
		$tip2= $_POST['tip2'];
		$tip_x= $_POST['tip_x'];
		if (!empty($team1)){
			if (!empty($team2)){
				if  (!empty($tip1)){
					if  (!empty($tip2)){
						if  (!empty($tip_x)){
							if ($tip1 < 31 AND $tip2 < 31 AND $tip_x < 31) {
								if ($tip1 > 1 AND $tip2 > 1 AND $tip_x > 1) {
									
								
$game = $team1 ." - ". $team2;
							$insert_game = self::$db->query("INSERT INTO games (team1, team2, beginning, tip1, tip2, tip_x, utakmica) VALUES ('{$team1}', '{$team2}', '{$beginning}', '{$tip1}', '{$tip2}', '{$tip_x}', '{$game}')");
									if (!$insert_game == NULL) {
									return "<p style='color:green;'>Successfully added game</p>";
									header('Location:' . $_SERVER['HTTP_REFERER']);
								}else{
									return "Not Inserted";
								}
								}else{
									return "You must put quote biger then 1.00 like: '1.01' ";
								}
							}else{
								return "You cant put quote biger then 31.00";
							}
						}else{
						return "Tip X missing!";
					}
				}else {
					return "Tip 2 missing!";
				}
			}else{
				return "Tip 1 missing!";
			}
		}else{
			return "Team 2 missing!";
		}
	}else{
		return "Team 1 missing";
	}
}
}
public static function AutoAddGames(){
	$query = self::$db->query("SELECT * FROM options");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if (!empty($row['api'])) {
			$api = $row['api'];
		}else{
			$api2 = $row['api2'];
		}
		
	}

	if (!empty($api)) {
		$sutra = new DateTime();
$sutra->modify('+2 day');

$danas = new DateTime();
$danas->modify('+1 day');

           include("XMLSoccer.php");
            try{
                $soccer=new XMLSoccer($api);
                $soccer->setServiceUrl("http://www.xmlsoccer.com/FootballData.asmx");
                $result=$soccer->GetFixturesByDateInterval(array("startDateString"=>$danas->format('Y-m-d')." 00:00","endDateString"=>$sutra->format('Y-m-d')." 00:00"));
                    foreach($result as $key=>$value){
                        $odds = $soccer->GetOddsByFixtureMatchId(array("FixtureMatch_Id"=>$value->Id));
                        $team1 = trim($value->HomeTeam);
                        $team2 = trim($value->AwayTeam);
                        $beginning = $value->Date;
                        
                        $tip1 = $odds->Odds->Bet365_Home;
                        $tip2 = $odds->Odds->Bet365_Away;
                        $tip_x = $odds->Odds->Bet365_Draw;


                        if ($team1 == 'Sporting Lisbon') {
                        	$team1 = '';
                        }
                        if ($team2 == 'Sporting Lisbon') {
                        	$team2 = '';
                        }
                       
				if  (!empty($tip1) AND !empty($team1) AND !empty($team2)){
                        $game = $team1 ." - ". $team2;
							$insert_game = self::$db->query("INSERT INTO games (team1, team2, beginning, tip1, tip2, tip_x, utakmica) VALUES ('{$team1}', '{$team2}', '{$beginning}', '{$tip1}', '{$tip2}', '{$tip_x}', '{$game}')");

                    }
                    
            }
        }catch(XMLSoccerException $e){
                echo "XMLSoccerException: ".$e->getMessage();
            }
	}else{
$sutra = new DateTime();
$sutra->modify('+2 day');
$sutra = $sutra->format('Y-m-d');

$danas = new DateTime();
$danas->modify('+1 day');
$danas = $danas->format('Y-m-d');
$json = file_get_contents( 'https://apifootball.com/api/?action=get_events&from='.$danas.'&to='.$danas.'&APIkey='.$api2.''); // this one service we gonna use to obtain timezone by IP
// maybe it's good to add some checks (if/else you've got an answer and if json could be decoded, etc.)

$ipData = json_decode($json, true);
		  foreach($ipData as $key=>$value){
		  	$id = $value['match_id'];
			
			
			$json_odds = file_get_contents('https://apifootball.com/api/?action=get_odds&from='.$danas.'&to='.$danas.'&match_id='.$id.'&APIkey='.$api2.'');
			$odds = json_decode($json_odds, true);
				if (!empty($odds[0]['odd_1'])) {
					$team1 = trim($value['match_hometeam_name']);
					$team2 = trim($value['match_awayteam_name']);
					$tip1 = $odds[0]['odd_1'];
        			$tip2 = $odds[0]['odd_2'];
					$tip_x = $odds[0]['odd_x'];
						$date = $value['match_date'];
						$time = $value['match_time'];
					$beginning = $date.' '.$time;
					if (!empty($team1) AND !empty($team2)) {
						$game = $team1 ." - ". $team2;
							$insert_game = self::$db->query("INSERT INTO games (team1, team2, beginning, tip1, tip2, tip_x, utakmica) VALUES ('{$team1}', '{$team2}', '{$beginning}', '{$tip1}', '{$tip2}', '{$tip_x}', '{$game}')");

					}
					
				}
        	
      
            

}
	}

           
      
            
}


public static function AutoDeleteGames(){

$juce = new DateTime();
$juce = $juce->modify('-1 day');
$juce = $juce->format('Y-m-d');
echo $juce;
		$game_delete = self::$db->query("DELETE FROM games WHERE beginning LIKE '$juce%'");
	

            
}
	// List of Games in Admin area
public static function AdminGames(){

	$games = self::$db->query("SELECT * FROM games ORDER by beginning ASC");
	$br = 0;
	?>
	
                        <table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Game</th>
                                    <th>TIP WIN</th>
                                    <th>Delete</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

			<?php
	
							while ($row = $games->fetch(PDO::FETCH_ASSOC)){
								$time = date_create($row['beginning']);
								$time =  date_format($time,"d/m/Y H:i");
		$date_and_time = $row['beginning'];
		
if (new DateTime() > new DateTime($date_and_time)) {
    
    $style_time = "color:#ff8080;";
}else{
	
	$style_time = "color:#00cc00;";
}
		$br++;
		if ($row['tip_win'] == NULL) {
			 $hiden_style = "";
		}else{
			$hiden_style = "visibility: hidden;";
		}
		?>
		
		<tr>
	 <td style="<?=$style_time?>"><?=$time?></td>
	 <td style="color: #cccccc;"><?=$row['team1']?> - <?=$row['team2']?></td>
	 <td><?=$row['tip_win']?></td>
	 <td><a href="remove-game.php?id_game=<?=$row['id_game']?>">X</a></td>
	 <td><a style="<?=$hiden_style?>" href="edit-game.php?id_game=<?=$row['id_game']?>">Edit</a></td>
			</tr>
			

			
			<?php 
			
						}
						echo "</tbody></table>";
		}
public static function EditGame(){
			if (isset($_GET['id_game']) AND isset($_SESSION['admin_logged'])) {
				$id = $_GET['id_game'];
				$result = self::$db->query("SELECT * FROM games WHERE id_game = '{$id}'");
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
						$team1 = $row['team1'];
						$team2 = $row['team2'];
						$tip_win = $row['tip_win'];
						$tip1 = $row['tip1'];
						$tip2 = $row['tip2'];
						$tip_x = $row['tip_x'];
						$utakmica1 = $row['utakmica'];
						$beginning = $row['beginning'];
						$home_goals = $row['goals_home'];
						$away_goals = $row['goals_away'];
											}
			}
			echo '<fieldset>';
				echo '<form action="" method="POST"/>';
					echo '<span style="color:orange;"><b>Clubs</b></span>';
					echo '<input type="text" class="form-control" size="25px" name="team1" value="'.$team1.'"/>';
					echo '<input type="text" class="form-control" size="25px" name="team2" value="'.$team2.'"/>';
					echo '<span style="color:orange;"><b>Beginning Time</b></span><br/>';
					echo '<input type="text" class="form-control" size="25px" name="beginning" value="'.$beginning.'"/>';
					echo '<span style="color:orange;"><b>Result</b></span><br/>';
					echo '<input class="form-control" type="text" name="home_goals" value="'.$home_goals.'" placeholder="goals home"/>';
					echo '<input class="form-control" type="text" name="away_goals" value="'.$away_goals.'" placeholder="Goals away"/>';

					echo '<span style="color:orange;"><b>Odds</b></span><br/>';
				      echo '<input type="number" class="form-control" name="tip1" step="any" value="'.$tip1.'" placeholder="'.$tip1.'"><br>';
				      echo '<input type="number" class="form-control" name="tip2" step="any" value="'.$tip2.'" placeholder="'.$tip2.'"><br>';
				      echo '<input type="text" class="form-control" name="tip_x" value="'.$tip_x.'" placeholder="'.$tip_x.'"><br>';
					echo '<input type="submit" name="submit_edit" value="Update"/>';
				echo '</form>';
			echo '</fieldset>';
						if (isset($_POST['submit_edit'])) {
							if (isset($_POST['home_goals']) AND isset($_POST['away_goals'])) {
							$team1 = $_POST['team1'];
							$team2 = $_POST['team2'];
							$tip1_update = $_POST['tip1'];
							$tip2_update = $_POST['tip2'];
							$tip_x_update = $_POST['tip_x'];
							$beginning_update = $_POST['beginning'];
							$tip_x_update = $tip_x_update;
							$utakmica1 = $team1 ." - ". $team2."*";
							$utakmica2 = $team1 ." - ". $team2;
$HomeGoals = $_POST['home_goals'];
$AwayGoals = $_POST['away_goals'];
							if ((int)$HomeGoals > (int)$AwayGoals) {
                        		$tip_win_update = 1;
                        	}elseif ((int)$HomeGoals < (int)$AwayGoals) {
                        		$tip_win_update = 2;
                        	}else{
                        		$tip_win_update = 'X';
                        	}
                        	$utakmica="<br>".$tip_win_update. ": " .$team1. " - " .$team2.": ";
							
							$update = self::$db->query("UPDATE winers SET g_match_w = REPLACE(g_match_w, '$utakmica1', '$utakmica') WHERE g_match_w LIKE '%{$utakmica1}%'");
							$update2 = self::$db->query("UPDATE games SET tip_win = '{$tip_win_update}', goals_home = '{$HomeGoals}', goals_away = '{$AwayGoals}' WHERE utakmica = '{$utakmica2}'");

								if (!$update2 == NULL) {
									header('Location:' . Config::get('site_url') . 'admin.php');
								}else{
									
								}
				if (!$update == NULL) {
					header("Location:" . Config::get('site_url') . "admin.php");
								}else{
									echo "<p>S</p>";
								}
							
							}else{
								echo "<p>You must enter 1 or 2 or X</p>";

							}

						}

					 
	}

public static function AutoEditGames(){
	$query = self::$db->query("SELECT * FROM options");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if (!empty($row['api'])) {
			$api = $row['api'];
		}else{
			$api2 = $row['api2'];
		}
		
	}
	if (!empty($api)) {
		$danas = Date("Y-m-d");
		$ponoc = new DateTime();
		$ponoc->modify('+1 day');


           include("XMLSoccer.php");
            try{
                $soccer=new XMLSoccer($api);
                $soccer->setServiceUrl("http://www.xmlsoccer.com/FootballData.asmx");
                $result=$soccer->GetFixturesByDateInterval(array("startDateString"=>$danas." 00:00","endDateString"=>$ponoc->format('Y-m-d')." 00:00"));
                    foreach($result as $key=>$value){
                    	

                        $team1 = trim($value->HomeTeam);
                        $team2 = trim($value->AwayTeam);
                        $Finished = $value->Time;
                        $beginning = $value->Date;
                        $HomeGoals = $value->HomeGoals;
                        $AwayGoals = $value->AwayGoals;
                        $utakmica1 = $team1 ." - ". $team2."*";
						$utakmica2 = $team1 ." - ". $team2;
                        $last_game = new DateTime($beginning);
						$last_game->modify('+2 hour');
						$t = $last_game->format('Y-m-d H:i');

						
                        	if ((int)$HomeGoals > (int)$AwayGoals) {
                        		$tip_win_update = 1;
                        	}elseif ((int)$HomeGoals < (int)$AwayGoals) {
                        		$tip_win_update = 2;
                        	}else{
                        		$tip_win_update = 'X';
                        	}
                        
                        $utakmica="<br>".$tip_win_update. ": " .$team1. " - " .$team2.": ";

				if  ($Finished == 'Finished'){

                        $update = self::$db->query("UPDATE winers SET g_match_w = REPLACE(g_match_w, '$utakmica1', '$utakmica') WHERE g_match_w LIKE '%{$utakmica1}%'");
						$update2 = self::$db->query("UPDATE games SET tip_win = '{$tip_win_update}', goals_home = '{$HomeGoals}', goals_away = '{$AwayGoals}' WHERE utakmica = '{$utakmica2}'");
                    }
            }
            }catch(XMLSoccerException $e){
                echo "XMLSoccerException: ".$e->getMessage();
            }
	}else{
		$danas = Date("Y-m-d");

$json = file_get_contents( 'https://apifootball.com/api/?action=get_events&from='.$danas.'&to='.$danas.'&APIkey='.$api2.''); // this one service we gonna use to obtain timezone by IP
// maybe it's good to add some checks (if/else you've got an answer and if json could be decoded, etc.)

$ipData = json_decode($json, true);
		  foreach($ipData as $key=>$value){
		  	$id = $value['match_id'];
			
			
			$json_odds = file_get_contents('https://apifootball.com/api/?action=get_odds&from='.$danas.'&to='.$danas.'&match_id='.$id.'&APIkey='.$api2.'');
			$odds = json_decode($json_odds, true);
				if (!empty($odds[0]['odd_1'])) {
					$team1 = trim($value['match_hometeam_name']);
					$team2 = trim($value['match_awayteam_name']);
						$date = $value['match_date'];
						$time = $value['match_time'];
					$Finished = $value['match_status'];
					$beginning = $date.' '.$time;

                        $HomeGoals = $value['match_hometeam_score'];
                        $AwayGoals = $value['match_awayteam_score'];
                        $utakmica1 = $team1 ." - ". $team2."*";
						$utakmica2 = $team1 ." - ". $team2;

						$last_game = new DateTime($beginning);
						$last_game->modify('+2 hour');
						$t = $last_game->format('Y-m-d H:i');
                        	if ((int)$HomeGoals > (int)$AwayGoals) {
                        		$tip_win_update = 1;
                        	}elseif ((int)$HomeGoals < (int)$AwayGoals) {
                        		$tip_win_update = 2;
                        	}else{
                        		$tip_win_update = 'X';
                        	}

	                        	

                        	
                 
                        $utakmica="<br>".$tip_win_update. ": " .$team1. " - " .$team2.": ";

				if  ($Finished == 'FT'){

                        $update = self::$db->query("UPDATE winers SET g_match_w = REPLACE(g_match_w, '$utakmica1', '$utakmica') WHERE g_match_w LIKE '%{$utakmica1}%'");
						$update2 = self::$db->query("UPDATE games SET tip_win = '{$tip_win_update}', goals_home = '{$HomeGoals}', goals_away = '{$AwayGoals}' WHERE utakmica = '{$utakmica2}'");
                    }
            }
            
      
            
}
	}

      
            
}
public static function DeleteGame(){
	if (isset($_GET['id_game'])) {
		$game_id = str_replace(';', '', $_GET['id_game']);
		$game_id = str_replace('-', '', $_GET['id_game']);
		$game_delete = self::$db->query("DELETE FROM games WHERE id_game = {$game_id}");
		header("Location: ./admin.php");
		}else{
			die('Something Wrong!');
		}
}
// every day +50 if user have < 200
public function AddPoints(){
	$query = self::$db->query("SELECT * FROM options");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		$points = $row['points_every_day'];
		$points_less_then = $row['points_less_then'];
	}
	
$update = self::$db->query("UPDATE users SET user_money = (user_money +{$points}) WHERE user_money<{$points_less_then} AND rank IS NULL");

$update100 = self::$db->query("UPDATE users SET user_money = (user_money +100) WHERE user_money<{$points_less_then} AND rank = 1");

$update150 = self::$db->query("UPDATE users SET user_money = (user_money +150) WHERE user_money<{$points_less_then} AND rank = 2");


$update200 = self::$db->query("UPDATE users SET user_money = (user_money +200) WHERE user_money<{$points_less_then} AND rank = 3");

$update250 = self::$db->query("UPDATE users SET user_money = (user_money +250) WHERE user_money<{$points_less_then} AND rank = 4");

$update300 = self::$db->query("UPDATE users SET user_money = (user_money +300) WHERE user_money<{$points_less_then} AND (rank = 5 OR rank > 5)");

}
// Korisnici / Admin
public static function GetUsersAdmin($limit){
	    $per_page = $limit;
		 if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page=1;
		}

	$start_from = ($page-1) * $per_page;
		
		$query = self::$db->query("SELECT * FROM users ORDER by id_users DESC LIMIT $start_from, $per_page");
			

		?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Status</th>
                                  	<th>Money</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete Member</th>
                                </tr>
                            </thead>
<tbody>
        <?php
	
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if ($row['status'] == 1) {
				$status = 'User';
		}else{
			$status = 'Administrator';
		}
				?>
							
                                <tr>
                                    <td><?=$row['id_users']?></td>
                                    <td style="color: #d9d9d9;"><?=$status?></td>
                                    <td><?=number_format($row['user_money'],2)?></td>
                                    <td style="color: #d9d9d9;"><?=$row['email']?></td>
                                    <td><a href="profil.php?id=<?=$row['id_users']?>"><?=$row['user']?></a></td>
                                    <td><a href="edit-member.php?id=<?=$row['id_users']?>"> Edit</a></td>
                                    <td><a href="remove-member.php?id=<?=$row['id_users']?>"> Delete</a></td>
                                   
                                </tr>
                           
				<?php
			  

				}
									   
			  echo "</tbody> </table>";
			
			$res = self::$db->query('SELECT COUNT(*) FROM users');
			$total_records = $res->fetchColumn();
			
			$total_pages = ceil($total_records / $per_page);
			
			echo "<div id='pagination'><center><a href='admin-users.php?page=1'>" . 'First page ' . "</a>";
			
			for ($i=1; $i<=$total_pages; $i++){
				echo "<a href='admin-users.php?page=".$i."'>".$i."</a> ";
			};
			echo "<a href='admin-users.php?page=".$total_pages."'>" . ' Last page' . "</a></div></center>";
}

public static function GetUsers($limit){
	$translate = Profil::Translate($_SESSION['City']);
	    $per_page = $limit;
		 if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page=1;
		}

	$start_from = ($page-1) * $per_page;
		
		$query = self::$db->query("SELECT * FROM users ORDER by user_money DESC LIMIT $start_from, $per_page");
			function String2Stars($string='',$first=0,$last=0,$rep='*'){
	  $begin  = substr($string,0,$first);
	  $middle = str_repeat($rep,strlen(substr($string,$first,$last)));
	  $end    = substr($string,$last);
	  $stars  = $begin.$middle.$end;
	  return $stars;
}
?>
<div class="col-md-8 table-container-left">
                        <table class="table table-bordered table-striped table-hover" id="table-users">
                            <thead>
                                	<th>ID</th>
                                    <th>Status</th>
                                  	<th><?=$translate['money']?></th>
                                    <th>Email</th>
                                    <th><?=$translate['users']?></th>
                                    <th>Rank</th>
                            </thead>
                            <tbody>
                            <?php
		
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
								$rank = $row['rank'];
								$img = str_replace("'", "", $row['img']);
if ($rank === NULL) {
                	 $rank = '<img src="img/silver.png" alt="silver">';
                }elseif ($rank == 1) {
                	$rank = '<img src="img/star.png" alt="star">';
                	
                }elseif ($rank == 2) {
                	$rank = '<img src="img/star.png" alt="star"><img width="22" src="img/star.png" alt="star">';
                }elseif ($rank == 3) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img  src="img/star.png" alt="star">';
                }elseif ($rank == 4) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank >= 5) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }
		if ($row['status'] == 1) {
				$status = $translate['user'];
		}else{
			$status = 'Administrator';
		}
				?>

                                <tr>
                                    <td><?=$row['id_users']?></td>
                                    <td><?=$status?></td>
                                    <td><?=number_format($row['user_money'],2)?></td>
                                    <td><?=String2Stars($row['email'],5,-5)?></td>
                                    <td><img src="user-images/<?=$img?>" alt="<?=$row['user']?>"> <a href="profil.php?id=<?=$row['id_users']?>"><?=$row['user']?></a></td>
                                    <td><?=$rank?></td>
                                </tr>
                            
				<?php
			  

				}
									 echo '</tbody></table>'; 
			
			$res = self::$db->query('SELECT COUNT(*) FROM users');
			$total_records = $res->fetchColumn();
			
			$total_pages = ceil($total_records / $per_page);
			
			echo "<div id='pagination'><center><a href='users.php?page=1'> " . $translate['first_page']. " </a>";
			
			for ($i=1; $i<=$total_pages; $i++){
				echo "<a href='users.php?page=".$i."'>".$i."</a> ";
			};
			echo "<a href='users.php?page=".$total_pages."'>" . $translate['last_page']. " </a></div></center>";
}
public static function GetLeagues(){
	$translate = Profil::Translate($_SESSION['City']);
	    
		$query = self::$db->query("SELECT * FROM leagues ORDER by league_id");
			

		?>
		<table class="table table-bordered table-striped table-hover" id="table-leauges">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>League</th>
                                                <th>Country</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            
                                        
<tbody>
<?php
		$br=0;
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
								
								$cauntry_array[] = $row['league_country'];
								
							if (in_array($row['league_country'], $cauntry_array)){
	   								$img=$row['league_country'];
							   			$img = str_replace(' ', '-', $img);
								  $img_team = "<img src='img-clubs/{$img}.png' alt='{$img}'>";
								  		
							}else{
								  	$img_team = '';
								  	$img_team = '';
							}
							$br++;
?>
							 <tr>
                                                <td><?=$br?></td>
                                                <td><a href='standing.php?league=<?=$row['league_name_seo']?>'><?=$row['league_name']?></a></td>
                                                <td><?=$row['league_country']?></td>
                                                <td><?=$img_team?></td>
                                            </tr>
                               
                            
				<?php
			  

				}
									   
			  echo "</tbody></table>";
}
public static function GetStandings($league){
	$translate = Profil::Translate($_SESSION['City']);
	    $br=0;
		$query = self::$db->query("SELECT * FROM standings WHERE league = '{$league}' ORDER BY points DESC");

		?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Img</th>
                                    <th>Team</th>
                                  	<th>Played</th>
                                    <th>played Home</th>
                                    <th>Played Away</th>
                                    <th>Won</th>
                                    <th>Draw</th>
                                    <th>Lost</th>
                                    <th>Yellow cards</th>
                                    <th>Red cards</th>
                                    <th>Goals</th>
                                    <th>Goal Against</th>
                                    <th>Goal Difference</th>
                                   	<th>Points</th>
                                </tr>
                            </thead>
<tbody>
<?php
		
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
								$team_array[] = $row['team'];
								$br++;
							if (in_array($row['team'], $team_array)){
	   								$img=$row['team'];
							   			$img = str_replace(' ', '-', $img);
								  $img_team = "<img src='img-clubs/{$img}.png' alt='{$img}'>";
								  		
							}else{
								  	$img_team = '';
								  	$img_team = '';
							}

?>
							
                                <tr>
                                    <td><?=$br?></td>
                                    <td><?=$img_team?></td>
                                    <td style="color: orange;"><?=$row['team']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['played']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['played_home']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['played_away']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['won']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['draw']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['lost']?></td>
                                    <td style="color: yellow;"><?=$row['yelow_cards']?></td>
                                    <td style="color: red;"><?=$row['red_cards']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['goals']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['goal_against']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['goal_difference']?></td>
                                    <td style="color: orange;"><?=$row['points']?></td>
                                </tr>
                            
				<?php
			  

				}
									   
			  echo "</tbody></table>";
}
public static function DeleteUser($idr){
	
		$resultt = self::$db->query("DELETE FROM users WHERE id_users = $idr ");
		if (!$resultt == NULL) {
			
				header("Location: ./admin-users.php");
			}else{
				
				echo "not ok".$idr;
				}
		
		}
public static function TopTen(){
	$resultt = self::$db->query("SELECT * FROM users ORDER by user_money DESC LIMIT 10");
	$br = 0;
	
						while ($row = $resultt->fetch(PDO::FETCH_ASSOC)){
								$br++;
								$rank = $row['rank'];
								$img = $row['img'];
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
                                                    <td><?=$br?></td>
                                                    <td><?=number_format($row['user_money'],2)?></td>
                                                    <td style="text-align: left;"> <img class="img-circle" width="29" src="user-images/<?=$img?>" alt="<?=$row['user']?>"> <?=$row['user']?></td>
                                                    <td><?=$rank?></td>
                                                    <td><a href="profil.php?id=<?=$row['id_users']?>"> Tickets</a></td>
                                                </tr>
                                    
									<?php
						}


	
}
public static function Prize(){
	$translate = Profil::Translate($_SESSION['City']);
	if (isset($_SESSION['id'])) {
		
	$id = $_SESSION['id'];
	$resultt = self::$db->query("SELECT * FROM users WHERE id_users={$id}");
	$virtual_money = Admin::VirtyualMoney();
	$prize = Admin::PrizeWin();

	
		
	while ($row = $resultt->fetch(PDO::FETCH_ASSOC)){
		$rank = $row['rank'];
		$money = $virtual_money - $row['user_money'];
		if ($row['user_money'] > $virtual_money) {
			

			  ?>
			  							<tr>
                                            <td><?=$row['user']?></td>
                                            <td><?=number_format($row['user_money'],2)?></td>
                                            <td><a style='color:green;' href='pay-prize.php?id=<?=$row['id_users']?>&pay=<?=$virtual_money?>'>Take <?=$prize?>$ <br> Make sure you submit your PayPal Email to your profile!</a></td>
                                        </tr>
			  <?php


				
					}else{
						
							$sto= $translate['you_need']." ".number_format($money,2)." ". $translate['to_win']. " ".$prize."$";
			
			  						?>

                                        	<tr>
                                                <td rowspan="2"><?=$row['user']?></td>
                                                <td rowspan="2"><?=number_format($row['user_money'],2)?></td>
                                            </tr>
                                            <tr>
                                                <td><?=$sto?></td>
                                            </tr>
                                    <?php
					}

		   
			  
			}
		
	}
}

public function PayPrize($id,$pay){

$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$id}'");
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					$id_user = $row['id_users'];
					$email_paypal = $row['email_paypal'];
					$name = $row['user'];
					$rank = $row['rank'];
					$virtual_money = Admin::VirtyualMoney();
					$prize = Admin::PrizeWin();
					}
					
					if (($_SESSION['id'] == $id_user) AND ($money > $virtual_money)) {
							
							$minus = $money - $virtual_money;

	$update = self::$db->query("UPDATE users SET user_money = '{$minus}' WHERE id_users = '{$id_user}'");
	if (!$update == NULL){
					$prize_insert = self::$db->query("INSERT INTO prize (prize_user_id, prize_user, prize_email, prize_money) VALUES ({$id_user}, '{$name}', '{$email_paypal}', {$prize})");
					if (!$prize_insert == NULL){
						header('Location:' . $_SERVER['HTTP_REFERER']);
					}
					}
					
		}else{
			die('Its not your prize!');
			
		}
}
public static function Rank(){
	$translate = Profil::Translate($_SESSION['City']);
	if (isset($_SESSION['id'])) {
		
	$id = $_SESSION['id'];
	$resultt = self::$db->query("SELECT * FROM users WHERE id_users={$id}");
	
	while ($row = $resultt->fetch(PDO::FETCH_ASSOC)){
		$rank = $row['rank'];
		if ($rank == NULL) {
			$virtual_money = 10000;
			$star ='<img width="16" src="img/star.png" alt="star">';
		}elseif ($rank == 1) {
			$virtual_money = 15000;
			$star ='<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		}elseif ($rank == 2) {
			$virtual_money = 20000;
			$star ='<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		}elseif ($rank == 3) {
			$virtual_money = 25000;
			$star ='<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		}elseif ($rank == 4) {
			$virtual_money = 30000;
			$star ='<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		}else{
			$virtual_money = 30000;
			$star ='<img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star"><img width="16" src="img/star.png" alt="star">';
		}
		
		$prize = 'Rank';

		$money = $virtual_money - $row['user_money'];
		
		if ($row['user_money'] > $virtual_money) {
			

			  ?>
			  							<tr>
                                            <td></td>
                                            <td></td>
                                            <td><a style='color:green;' href='buy-rank.php?id=<?=$row['id_users']?>&pay=<?=$virtual_money?>'>Buy <?=$prize?> <?=$star?> <br>For <?=number_format($virtual_money,2)?> And you will get +50 more on daily income!</a></td>
                                        </tr>
			  <?php


				
					}else{
						
							$sto= $translate['you_need']." ".number_format($money,2)." ". $translate['to_buy']. " ".$prize." ".$star ;
			
			  						?>
										<tr>
                                            <td></td>
                                            <td></td>
                                            <td><?=$sto?></td>
                                        </tr>
                                    <?php
					}

		   
			  
			}
		
	}
}
public function BuyRank($id,$pay){

$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$id}'");
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					$id_user = $row['id_users'];
					$email_paypal = $row['email_paypal'];
					$name = $row['user'];
					$rank = $row['rank'];
					}

		if ($rank == NULL) {
			$virtual_money = 10000;
		}elseif ($rank == 1) {
			$virtual_money = 15000;
		}elseif ($rank == 2) {
			$virtual_money = 20000;
		}elseif ($rank == 3) {
			$virtual_money = 25000;
		}elseif ($rank == 4) {
			$virtual_money = 30000;
		}else{
			$virtual_money = 35000;
		}
		
		$prize = 'Viši Rank';
					
					if (($_SESSION['id'] == $id_user) AND ($money > $virtual_money)) {
							$rank = $rank + 1;
							$minus = $money - $virtual_money;

	$update = self::$db->query("UPDATE users SET user_money = '{$minus}', rank = '{$rank}' WHERE id_users = '{$id_user}'");
	if (!$update == NULL){
					
						header('Location:' . $_SERVER['HTTP_REFERER']);
					
					}
					
		}else{
			die('Its not your prize!');
			
		}
}
public static function AdminPrizeWiners(){

	$prize_winers = self::$db->query("SELECT * FROM prize ORDER by prize_time DESC");
	$br = 0;

	?>
<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User ID</th>
                                    <th>User</th>
                                    <th>PayPal Email</th>
                                    <th>Prize Money</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>

			<?php
	
							while ($row = $prize_winers->fetch(PDO::FETCH_ASSOC)){
								if ($row['prize_status'] == 0) {
			 					$hiden_style = "";
									}else{
											$hiden_style = "visibility: hidden;";
									}
								$time = date_create($row['prize_time']);
								$time =  date_format($time,"d/m/Y H:i");
								$prize_id = $row['prize_id'];
if ($row['prize_status'] == 0) {
	$br++;
	?>
	<tbody>
		<tr>
	 <td><?=$br?></td>
	 <td style="color: #d9d9d9;"><?=$row['prize_user_id']?></td>
	 <td><?=$row['prize_user']?></td>
	 <td style="color: #d9d9d9;"><?=$row['prize_email']?></td>
	 <td><?=$row['prize_money']?></td>
	 <td>Not payed</td>
	 <td><?=$time?></td>
	 <td><?php echo "<a style='{$hiden_style}' href='edit-prize-winer.php?id={$prize_id}'>Edit</a>";?></td>
		</tr>
	</tbody>
    
    <?php
}else{
	$br++;
	?>
	<tbody>
		<tr>
	 <td><?=$br?></td>
	 <td style="color: #d9d9d9;"><?=$row['prize_user_id']?></td>
	 <td><?=$row['prize_user']?></td>
	 <td style="color: #d9d9d9;"><?=$row['prize_email']?></td>
	 <td><?=$row['prize_money']?></td>
	 <td>Payed</td>
	 <td><?=$time?></td>
	 <td><?php echo "<a style='{$hiden_style}' href='edit-prize-winer.php?id={$prize_id}'>Edit</a>";?></td>
		</tr>
	</tbody>

    <?php
	
}
		
		
						
		} 
		echo "</table>";
	}
	public static function EditPrizeWiner(){
			if (isset($_GET['id']) AND !empty($_SESSION['admin_logged'])) {
				$id = $_GET['id'];
				$result = self::$db->query("SELECT * FROM prize WHERE prize_id = '{$id}'");
					while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
						$prize_id = $row['prize_id'];
						$prize_user_id = $row['prize_user_id'];
						$prize_user = $row['prize_user'];
						$prize_email = $row['prize_email'];
						$prize_money = $row['prize_money'];
						$prize_status = $row['prize_status'];
						$prize_time = $row['prize_time'];
						
											}

			  
			}
				?>
			<fieldset>
				<form action="" method="POST" /> 
					
					<input type="number" class="form-control" name="status" value="<?=$prize_status?>" />
					
					<input type="submit" name="submit_edit" value="Update" />
				</form>
			</fieldset>
			   <?php
						if (isset($_POST['submit_edit'])) {
							$status_update = $_POST['status'];
							
							
							$update = self::$db->query("UPDATE prize SET prize_status = '{$status_update}' WHERE prize_id = '{$prize_id}'");
							
				if (!$update == NULL) {
				header('Location:' . $_SERVER['HTTP_REFERER']);
								}else{
									die ('Something Wrong!');
								}
							
						}



	}
public static function WinerTickets(){
			if (isset($_SESSION['id'])) {
				$id = $_SESSION['id'];
				
				$WinerTickets = self::$db->query("SELECT * FROM winer_tickets WHERE winer_ticket_win_id_user = {$id} ORDER by winer_tickets_win_pos_win DESC LIMIT 10");
				$br = 0;

					while ($row = $WinerTickets->fetch(PDO::FETCH_ASSOC)){
							$br++;


									?>
                                         <tr>
                                            <td><br><?=$br?></td>
                                            <td><?=$row['winer_tickets_g_match']?></td>
                                            <td><br><?=number_format($row['winer_tickets_win_t_money'],2)?></td>
                                            <td><br><?=number_format($row['winer_tickets_win_pos_win'],2)?></td>
                                            <td><br><?=$row['winer_tickets_win_id_tickets']?></td>
                                            <td><br><?=$row['winer_tickets_time']?></td>
                                        </tr>
                                    
									<?php




					}
				
			}
	}
public static function Options(){
				
				$options = self::$db->query("SELECT * FROM options");
				
				while ($row = $options->fetch(PDO::FETCH_ASSOC)) { 
				$site_name = $row['site_name'];
				$site_desc = $row['site_desc'];
				$ad = $row['ad'];

				$analytics = $row['analytics'];
				$logo = $row['logo'];
				$seo_text = $row['seo_text'];
				$virtual_money = $row['virtual_money'];
				$prize = $row['prize'];
				$api = $row['api'];
				$api2 = $row['api2'];
				$gplus = $row['gplus'];
				$prizeoff = $row['prizeoff'];
				$points_every_day = $row['points_every_day'];
				$points_less_then = $row['points_less_then'];
				$paypal_email = $row['paypal_email'];
				$paypal_identitytoken = $row['paypal_identitytoken'];
				$paypal_off = $row['paypal_off'];
				$paypal_price = $row['paypal_price'];
				$virtual_amount = $row['virtual_amount'];

			  }
			  if (!$gplus == NULL) {
			  	$checkeds = 'checked';
			  }else{
			  	$checkeds = '';
			  }
			  if ($prizeoff == 1) {
			  	$checked = 'checked';
			  }else{
			  	$hiden_style_prizeoff = "visibility:hidden;";
			  	$checked = '';
			  }
			  
			  if ($paypal_off == 1) {
			  	$checkedsp = 'checked';
			  }else{
			  	$hiden_style_paypal = "visibility:hidden;";
			  	$checkedsp = '';
			  }
			?>
			<div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3 stake-container">
                   
        
                        <form action="" method="POST" enctype="multipart/form-data"> 
                        		<span style="color:#ffb84d;"><b>Site Title</b></span><br/>
                              <input type="text" class="form-control" name="site_name" value="<?=$site_name?>" placeholder="Site Title"><br>
                              <span style="color:#ffb84d;"><b>Site Description</b></span><br/>
                              <textarea type="text" class="form-control" name="site_desc"><?=$site_desc?></textarea><br>
                             <span style="color:#ffb84d;"><b>Analytics</b></span><br/>
                              <textarea type="text" class="form-control" name="analytics"><?=$analytics?></textarea><br>
                              <span style="color:#ffb84d;"><b>AD</b></span><br/>
                              <textarea type="text" class="form-control" name="ad"><?=$ad?></textarea><br>
                              <span style="color:#ffb84d;"><b>SEO text</b></span><br/>
                              <textarea type="text" class="form-control" name="seo_text"><?=$seo_text?></textarea><br>
                              <span style="color:#ffb84d;"><b>Logo</b></span><br/>
                              <textarea type="text" class="form-control" name="logo"><?=$logo?></textarea><br>
                              <span style="color:#ffb84d;">Login with Gplus On / Off</span>
                              <input type="checkbox" class="form-control" name="gplus" value="<?=$gplus?>" <?=$checkeds?>><br>
                             
 								<span style="color:#ffb84d;"><b>Prize On / Off</b></span>
                              <input class="form-control" type="checkbox" name="prizeoff" value="<?=$prizeoff?>" <?=$checked?> >
                              <br>
                              <span style="color:#ffb84d;">API xmlsoccer.com</span>
 							<textarea type="text" class="form-control" name="api"><?=$api?></textarea>
 							<br>
 							<span style="color:#ffb84d;">API apifootball.com</span>
 							<textarea type="text" class="form-control" name="api2"><?=$api2?></textarea>
 							<br>
		<span style="color:#ffb84d;<?=$hiden_style_prizeoff?>"><b>Write how much virtual money need to get a prize</b></span><br/>
		<input class="form-control"style="<?=$hiden_style_prizeoff?>" type="number" name="virtual_money" value="<?=$virtual_money?>" /><br/>
		<span style="color:#ffb84d;<?=$hiden_style_prizeoff?>"><b>Write how much you pay for prize</b></span><br/>
		<input class="form-control"style="<?=$hiden_style_prizeoff?>" type="number" name="prize" value="<?=$prize?>" /><br/>
		
		 <span style="color:#ffb84d;"><b>Free points</b></span><br> 
		<span style="color:#ffb84d;">Give Points every day</span><br/>
		<input class="form-control" type="number" name="points_every_day" value="<?=$points_every_day?>" />
		<span style="color:#ffb84d;">If user have less then</span>
		<input class="form-control" type="number" name="points_less_then" value="<?=$points_less_then?>" /><br/>
		<span style="color:#ffb84d;"><b>PayPall On / Off</b></span>
		<input class="form-control" type="checkbox" name="paypal_off" value="<?=$paypal_off?>" <?=$checkedsp?> > 
		<span style="color:#ffb84d;<?=$hiden_style_paypal?>"> <b>PayPal Price</b></span><br/>
		<input class="form-control" style="<?=$hiden_style_paypal?>" type="number" name="paypal_price" value="<?=$paypal_price?>" /><b style="color:#ffb84d;<?=$hiden_style_paypal?>">$ For </b>
		<input class="form-control" style="<?=$hiden_style_paypal?>" type="number" name="virtual_amount" value="<?=$virtual_amount?>" /> 
		<span style="color:#ffb84d;<?=$hiden_style_paypal?>"> virtual money</span>
		<br>
		<br>
		<span style="color:#ffb84d;<?=$hiden_style_paypal?>"> PayPal Email</span><br/>
		<input class="form-control" style="<?=$hiden_style_paypal?>" type="text" name="paypal_email" value="<?=$paypal_email?>" /><br>
		<span style="color:#ffb84d;<?=$hiden_style_paypal?>"> PayPal Identity Token </span><br>
		<input class="form-control"  style="<?=$hiden_style_paypal?>" type="text" name="paypal_identitytoken" value="<?=$paypal_identitytoken?>" /><br>
		<a style="float: right;<?=$hiden_style_paypal?>" href="<?=Config::get('site_url')?>images/paypal.png" target="_blank"> <img src="/images/paypal.png" width="250" height="125" border="0" alt="Paypal Identity Token"> </a>
		<a style="<?=$hiden_style_paypal?>" href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_profile-website-payments" target="_blank">Go to PayPal and take Identity Token</a><br><br><br>
		 
		
        <input type="submit" class="form-control" name="submit" value="Update">
                        </form>
                        
                </div>
                </div>
	
   <?php
		if (isset($_POST['submit'])) {
						$site_name_update = $_POST['site_name'];
						$site_desc_update = $_POST['site_desc'];
						$ad_update = htmlentities($_POST['ad']);
						$analytics_update = htmlentities($_POST['analytics']);
						$logo_update = $_POST['logo'];
						$seo_update = $_POST['seo_text'];
						$virtual_money_update = $_POST['virtual_money'];
						$prize_update = $_POST['prize'];
						$paypal_email_update = $_POST['paypal_email'];
						$paypal_identitytoken_update = $_POST['paypal_identitytoken'];
						$api_update = $_POST['api'];
						$api_update2 = $_POST['api2'];
						$paypal_price_update = $_POST['paypal_price'];
						$virtual_amount_update = $_POST['virtual_amount'];

				if (isset($_POST['gplus'])) {
					$_POST['gplus'] = 1;
			  		$gplus_update = $_POST['gplus'];
			  	}else{
			  	$_POST['gplus'] = 0;
			  	$gplus_update = $_POST['gplus'];
			  	}

			  	if (isset($_POST['prizeoff'])) {
			  	$_POST['prizeoff'] = 1;
			  		$prizeoff_update = $_POST['prizeoff'];
			  	}else{
			  		$_POST['prizeoff'] = 0;
			  		$prizeoff_update = $_POST['prizeoff'];
			  	}

			  	if (isset($_POST['paypal_off'])) {
			  	$_POST['paypal_off'] = 1;
			  		$paypal_off_update = $_POST['paypal_off'];
			  	}else{
			  		$_POST['paypal_off'] = 0;
			  		$paypal_off_update = $_POST['paypal_off'];
			  	}
					
						$points_every_day_update = $_POST['points_every_day'];
						$points_less_then_update = $_POST['points_less_then'];

		$update_op = self::$db->query("UPDATE options SET site_name = '{$site_name_update}', site_desc = '{$site_desc_update}', ad = '{$ad_update}', analytics = '{$analytics_update}', seo_text = '{$seo_update}', logo = '{$logo_update}', virtual_money = {$virtual_money_update}, prize = {$prize_update}, gplus = {$gplus_update}, prizeoff = {$prizeoff_update}, points_every_day = {$points_every_day_update}, points_less_then = {$points_less_then_update}, paypal_email = '{$paypal_email_update}', paypal_identitytoken = '{$paypal_identitytoken_update}', paypal_off = {$paypal_off_update}, paypal_price = {$paypal_price_update}, virtual_amount = {$virtual_amount_update}, api = '{$api_update}', api2 = '{$api_update2}'");
			
			if (!$update_op == NULL) {
				 header('Location:' . $_SERVER['HTTP_REFERER']);
			}else{
				echo "not ok";
				}
		}   
}
	public static function Ad(){
		$ad = self::$db->query("SELECT * FROM options");
				
				while ($row = $ad->fetch(PDO::FETCH_ASSOC)) { 
				$ad = $row['ad'];
				return $ad;
                }
	}
	public static function SiteName(){
		$site_name = self::$db->query("SELECT * FROM options");
				
				while ($row = $site_name->fetch(PDO::FETCH_ASSOC)) { 
				$site_name = $row['site_name'];
				return $site_name;
                }
	}
	public static function SiteDesc(){
		$site_desc = self::$db->query("SELECT * FROM options");
				
				while ($row = $site_desc->fetch(PDO::FETCH_ASSOC)) { 
				$site_desc = $row['site_desc'];
				return $site_desc;
                }
	}
	public static function Logo(){
		$logo = self::$db->query("SELECT * FROM options");
				
				while ($row = $logo->fetch(PDO::FETCH_ASSOC)) { 
				$logo = $row['logo'];
				return $logo;
                }
	}
	public static function Analytics(){
		$analytics = self::$db->query("SELECT * FROM options");
				
				while ($row = $analytics->fetch(PDO::FETCH_ASSOC)) { 
				$analytics = $row['analytics'];
				return $analytics;
				
                }
	}
	public static function SeoText(){
		$seo_text = self::$db->query("SELECT * FROM options");
				
				while ($row = $seo_text->fetch(PDO::FETCH_ASSOC)) { 
				$seo_text = $row['seo_text'];
				return $seo_text;
                }
	}
	
public static function PrizeWin(){
		$prize_win = self::$db->query("SELECT * FROM options");
				
				while ($row = $prize_win->fetch(PDO::FETCH_ASSOC)) { 
				$prize_win = $row['prize'];
				return $prize_win;
                }
	}
public static function VirtyualMoney(){
		$prize = self::$db->query("SELECT * FROM options");
				
				while ($row = $prize->fetch(PDO::FETCH_ASSOC)) { 
				$prize = $row['virtual_money'];
				return $prize;
                }
	}
public static function GplusVisibility(){
		$Gplus = self::$db->query("SELECT * FROM options");
				
				while ($row = $Gplus->fetch(PDO::FETCH_ASSOC)) { 
				$g = $row['gplus'];
				return $g;
                }
	}
public static function PrizeVisibility(){
		$prize = self::$db->query("SELECT * FROM options");
				
				while ($row = $prize->fetch(PDO::FETCH_ASSOC)) { 
				$p = $row['prizeoff'];
				return $p;
                }
   	}
public static function PayPalVisibility(){
		$paypal = self::$db->query("SELECT * FROM options");
				
				while ($row = $paypal->fetch(PDO::FETCH_ASSOC)) { 
				$paypal_pal = $row['paypal_off'];
				return $paypal_pal;
                }
	}
public static function PayPalEmail(){
		$paypal = self::$db->query("SELECT * FROM options");
				
				while ($row = $paypal->fetch(PDO::FETCH_ASSOC)) { 
				$paypal_email = $row['paypal_email'];
				return $paypal_email;
                }
	}
public static function PayPalIdentityToken(){
		$paypal = self::$db->query("SELECT * FROM options");
				
				while ($row = $paypal->fetch(PDO::FETCH_ASSOC)) { 
				$paypal_identitytoken = $row['paypal_identitytoken'];
				return $paypal_identitytoken;
                }
	}
public static function PayPalPrice(){
		$paypal_price = self::$db->query("SELECT * FROM options");
				
				while ($row = $paypal_price->fetch(PDO::FETCH_ASSOC)) { 
				$paypal_value = $row['paypal_price'];
				return $paypal_value;
                }
	}
public static function VirtualAmount(){
		$virtual = self::$db->query("SELECT * FROM options");
				
				while ($row = $virtual->fetch(PDO::FETCH_ASSOC)) { 
				$virtual_money = $row['virtual_amount'];
				return $virtual_money;
                }
	}
public static function Orders($user_id,$transaction_id,$amount){
		$orders = self::$db->query("INSERT INTO orders (user_id,transaction_id,amount) VALUES ('$user_id','$transaction_id','$amount')");
				
				if (!$orders == NULL){
					return 'Successfully';
				}
            }
	
public static function ShowOrdersAdmin($limit){
	    $per_page = $limit;
		 if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page=1;
		}

	$start_from = ($page-1) * $per_page;
		
		$query = self::$db->query("SELECT * FROM orders ORDER by order_time DESC LIMIT $start_from, $per_page");
			

		?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Order Time</th>
                                    <th>Check Payments</th>
                                    <th>Action</th>
                                    <th>Delete Order</th>
                                </tr>
                            </thead>
                            <tbody>
		<?php
							while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if ($row['paid'] === '1') {
			$status = 'Payed';

		}else{
			$status = "<a href='add-money-user.php?id={$row['user_id']}'>Add money to user</a>";
		}
				?>
								<tr>
                                    <td><?=$row['order_id']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['user_id']?></td>
                                    <td><?=$row['transaction_id']?></td>
                                    <td style="color: #d9d9d9;"><?=$row['amount']?></td>
                                 	<td><?=$row['order_time']?></td>
									<td><form method=post action="https://www.paypal.com/cgi-bin/webscr">
							  				<input type="hidden" name="cmd" value="_notify-synch">
							 				<input type="hidden" name="tx" value="<?=$row['transaction_id']?>">
							  				<input type="hidden" name="at" value="<?=Admin::PayPalIdentityToken()?>">
							  				<input type="submit" value="Success OR Failure">
										</form>
									</td>
									<td><?=$status?></td>
									<td><a href="remove-order.php?id=<?=$row['order_id']?>"> Delete</a></td>
                                </tr>

				<?php
			  
				}
									   
			  echo "</tbody></table>";
						
			
			$res = self::$db->query('SELECT COUNT(*) FROM orders');
			$total_records = $res->fetchColumn();
			
			$total_pages = ceil($total_records / $per_page);
			
			echo "<div id='pagination'><center><a href='orders.php?page=1'>" . 'First page ' . "</a>";
			
			for ($i=1; $i<=$total_pages; $i++){
				echo "<a href='orders.php?page=".$i."'>".$i."</a> ";
			};
			echo "<a href='orders.php?page=".$total_pages."'>" . ' Last page' . "</a></div></center>";
}
public static function AddMoneyUser(){
	if (isset($_GET['id']) AND !empty($_SESSION['admin_logged'])) {
		$user_id = $_GET['id'];

		$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user_id}'");
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$money = $row['user_money'];
					$id_user = $row['id_users'];
					$email_paypal = $row['email_paypal'];
					$name = $row['user'];
					$virtual_money = Admin::VirtualAmount();
					}

$plus = $money + $virtual_money;
	$update = self::$db->query("UPDATE users SET user_money = '{$plus}' WHERE id_users = '{$user_id}'");
	if (!$update == NULL){
					$payed = self::$db->query("UPDATE orders SET paid = '1' WHERE user_id = '{$user_id}'");
					if (!$payed == NULL){
						header('Location:' . $_SERVER['HTTP_REFERER']);
					}
			}
	}
}
public static function RemoveOrder(){
	if (isset($_GET['id']) AND !empty($_SESSION['admin_logged'])) {
		$order_id = $_GET['id'];
		$order_delete = self::$db->query("DELETE FROM orders WHERE order_id = {$order_id}");
		if (!$order_delete == NULL){
					header('Location:' . $_SERVER['HTTP_REFERER']);
				}
		}
	}
public static function GetIp(){
	
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    	if (!$ipaddress == NULL) {
			return $ipaddress;
    	}
	
				
}
public static function GetCity($ip){
	$json   = file_get_contents( 'http://freegeoip.net/json/' . $ip); // this one service we gonna use to obtain timezone by IP
// maybe it's good to add some checks (if/else you've got an answer and if json could be decoded, etc.)
$ipData = json_decode($json, true);

if ($ipData['time_zone']) {
    $tz = new DateTimeZone($ipData['time_zone']);
    $now = new DateTime('now',$tz); // DateTime object corellated to user's timezone
  return $ipData['time_zone'];
  
			}else {
				$belgrade = 'Europe/London';
			   return $belgrade;
			}
	}
public static function Gplus(){
                    
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
    if (isset($authUrl)) {
        
        return $authUrl;
    } else {

    }
  
}
public static function Reaciver($reaciver){
	$user = self::$db->query("SELECT * FROM users WHERE id_users = {$reaciver}");
            while ($row = $user->fetch(PDO::FETCH_ASSOC)){
                $name = $row['user'];
                $rank = $row['rank'];
                $email = $row['email'];
                $enter_money = $row['enter_money'];
                $win_money = $row['win_money'];
                $email = $row['email'];
                $money = number_format($row['user_money'],2);
                $status = $row['status'];
                $img = $row['img'];
                if ($status == 1) {
                    $status = 'User';
                }else{
                    $status = 'Administrator';
                }

                if ($rank === NULL) {
                	 $rank = '<img src="img/silver.png" alt="silver">';
                }elseif ($rank == 1) {
                	$rank = '<img src="img/star.png" alt="star">';
                	
                }elseif ($rank == 2) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 3) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 4) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank >= 5) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }
               return $array = array('name' => $name, 'email' => $email, 'money' => $money, 'status' => $status, 'rank' => $rank, 'img' => $img, 'win_money' => $win_money, 'enter_money' => $enter_money);

            }
}
public static function Sender($sender){
	$user = self::$db->query("SELECT * FROM users WHERE id_users = {$sender}");
            while ($row = $user->fetch(PDO::FETCH_ASSOC)){
                $rank = $row['rank'];
                $name = $row['user'];
                $enter_money = $row['enter_money'];
                $win_money = $row['win_money'];
                $email = $row['email'];
                $money = number_format($row['user_money'],2);
                $status = $row['status'];
                $img = $row['img'];
                if ($status == 1) {
                    $status = 'User';
                }else{
                    $status = 'Administrator';
                }
				if ($rank === NULL) {
                	 $rank = '<img src="img/silver.png" alt="silver">';
                }elseif ($rank == 1) {
                	$rank = '<img src="img/star.png" alt="star">';
                	
                }elseif ($rank == 2) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 3) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 4) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank >= 5) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="Smiley face"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }
               return $array = array('name' => $name, 'email' => $email, 'money' => $money, 'status' => $status, 'rank' => $rank, 'img' => $img, 'win_money' => $win_money, 'enter_money' => $enter_money);

            }
}
public static function SendMoneyUser($sender,$reaciver,$money){
	if (!empty($sender) AND !empty($reaciver) AND !empty($money)) {
		
		$result_reaciver = self::$db->query("SELECT * FROM users WHERE id_users = '{$reaciver}'");
							while ($row = $result_reaciver->fetch(PDO::FETCH_ASSOC)) {
					$reaciver_money = $row['user_money'];
					$name_reaciver = $row['user'];
					$id_reaciver = $row['id_users'];
					}

		$result_sender = self::$db->query("SELECT * FROM users WHERE id_users = '{$sender}'");
							while ($row = $result_sender->fetch(PDO::FETCH_ASSOC)) {
					$sender_money = $row['user_money'];
					$name_sender = $row['user'];
					$id_sender = $row['id_users'];
					}
if ($sender_money > 1000) {
	
	$plus_reaciver = $money + $reaciver_money;
	$minus_sender = $sender_money - $money;

	$update_reaciver = self::$db->query("UPDATE users SET user_money = '{$plus_reaciver}' WHERE id_users = '{$reaciver}'");
	$update_sender = self::$db->query("UPDATE users SET user_money = '{$minus_sender}' WHERE id_users = '{$sender}'");

	if ((!$update_reaciver == NULL) AND (!$update_sender == NULL)){
		$ongoings_text = '<a style="color:orange;" href="profil.php?id='.$id_sender.'">'.$name_sender.'</a> is successfully sent to <a style="color:orange;" href="profil.php?id='.$id_reaciver.'">'.$name_reaciver.'</a> '.number_format($money,2).' virtual money';
		$insert_ongoings= self::$db->query("INSERT INTO ongoings (ongoings_text) VALUES ('{$ongoings_text}')");

					echo "<p>You send ".$money." virtual money Successfully</p>";
					
			}else{
				echo "<p>Money is not transfered!</p>";
			}
		}else{
			echo '<p>You dont have that much money!</p>';
		}
	}else{
		echo "<p>In desert no water!</p>";
	
	}
}
public static function SearchIndex($limit,$criteria) {
	
		$result = self::$db->query("SELECT * FROM users WHERE user LIKE '%{$criteria}%' OR email LIKE '%{$criteria}%' LIMIT $limit");
		
		?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Status</th>
                                    <th>Money</th>
                                    <th>Name</th>
                                    <th>Rank</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
		<?php
		$br = 0;
							while ($row = $result->fetch(PDO::FETCH_ASSOC)){
								$br++;
								if ($row['status'] == 1) {
									$status = 'User';
								}else{
									$status = 'Admin';
								}
								$rank = $row['rank'];
								$img = $row['img'];
								if ($rank === NULL) {
                	 $rank = '<img src="img/silver.png" alt="silver">';
                }elseif ($rank == 1) {
                	$rank = '<img src="img/star.png" alt="star">';
                	
                }elseif ($rank == 2) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 3) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank == 4) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }elseif ($rank >= 5) {
                	$rank = '<img src="img/star.png" alt="star"><img src="img/star.png" alt="Smiley face"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star"><img src="img/star.png" alt="star">';
                }
								?>
								<tr>
	 <td style="color: #cccccc;"><?=$br?></td>
	 <td style="color: #cccccc;"><?=$status?></td>
	 <td style="color: #cccccc;"><?=number_format($row['user_money'],2)?></td>
	 <td style="text-align: left;"><img class='img-circle' src="user-images/<?=$img?>" alt="<?=$row['user']?> "> <a style='color:orange;' href="profil.php?id=<?=$row['id_users']?>"><?=$row['user']?></a></td>
	 <td style="color: #cccccc;"><?=$rank?></td>
	 
			</tr>
								<?php
				

				}
									   
			  echo "</tbody></table><br>";		
			
			
								
}
public static function NotPaidWiners($limit) {
	$per_page = $limit;
		 if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page=1;
		}
		$start_from = ($page-1) * $per_page;
		$result = self::$db->query("SELECT * FROM final_winers ORDER by win_pos_win DESC LIMIT $start_from, $per_page");
		
?>
		<table class="table table-bordered table-striped table-hover" id="table-bet">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Ticket id</th>
                                    <th>Money Won</th>
                                    <th>User id</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
<?php
		$br = 0;
							while ($row = $result->fetch(PDO::FETCH_ASSOC)){
								$br++;
								
								?>
								<tr>
	 <td style="color: #cccccc;"><?=$br?></td>
	 <td style="color: #cccccc;"><?=$row['win_id_tickets']?></td>
	 <td style="color: #cccccc;"><?=number_format($row['win_pos_win'],2)?></td>
	 <td style="color: #cccccc;"><?=$row['win_id_user']?></td>
	 
			</tr>
								<?php
				

				}
									   
			  echo "</tbody></table><br>";		
			
			$res = self::$db->query('SELECT COUNT(*) FROM final_winers');
			$total_records = $res->fetchColumn();
			
			$total_pages = ceil($total_records / $per_page);
			
			echo "<div id='pagination'><center><a href='admin.php?page=1'>" . 'First page ' . "</a>";
			
			for ($i=1; $i<=$total_pages; $i++){
				echo "<a href='admin.php?page=".$i."'>".$i."</a> ";
			};
			echo "<a href='admin.php?page=".$total_pages."'>" . ' Last page' . "</a>";
								
}
public static function GetAllLeagues(){
$query = self::$db->query("SELECT * FROM options");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if (!empty($row['api'])) {
			$api = $row['api'];
		}else{
			$api2 = $row['api2'];
		}
		
	}

	if (!empty($api)) {
		include("XMLSoccer.php");
            try{
                $soccer=new XMLSoccer($api);
               $soccer->setServiceUrl("http://www.xmlsoccer.com/FootballData.asmx");
                $result=$soccer->GetAllLeagues(array());
                    foreach($result as $key=>$value){
                        $Name = trim($value->Name);
                        $name_seo = str_replace(' ', '-', $Name);
                        $Country = trim($value->Country);

                        if ($Name == "Champions League") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "EURO 2012") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "Europe League") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "FA Cup") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "League Cup") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "World Cup 2014") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "EURO 2016") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if ($Name == "Lega Pro") {
                        	$Name ='';
                        	$name_seo ='';
                        	$Country='';
                        }
                        if (!empty($Name)) {
                        	$insert_game = self::$db->query("INSERT INTO leagues (league_name,league_country,league_name_seo) VALUES ('{$Name}','{$Country}','{$name_seo}')");
                        }
							
              }
                        
                    
            		
            }catch(XMLSoccerException $e){
                echo "XMLSoccerException: ".$e->getMessage();
            }
	}else{
		$json = file_get_contents( 'https://apifootball.com/api/?action=get_leagues&APIkey='.$api2.''); 

		$ipData = json_decode($json, true);
				  foreach($ipData as $key=>$value){
				  		$Name = trim($value['league_name']);
                        $name_seo = str_replace(' ', '-', $Name);
                        $Country = trim($value['country_name']);
                        $leagues_id = $value['league_id'];
                        if ($Country == 'Europa League') {
                        	$Name = $Name.' Europa League';
                        	$name_seo = str_replace(' ', '-', $Name);
                        }
                        if (!empty($Name)) {
                        	$insert_game = self::$db->query("INSERT INTO leagues (league_name,league_country,league_name_seo,leagues_id) VALUES ('{$Name}','{$Country}','{$name_seo}','{$leagues_id}')");
                        }
				  }
	}
           
      
           
}
public static function GetAllClubs(){
	$query = self::$db->query("SELECT * FROM options");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)){
		if (!empty($row['api'])) {
			$api = $row['api'];
		}else{
			$api2 = $row['api2'];
		}
		
	}

	if (!empty($api)) {
		$delete = self::$db->query("DELETE FROM standings");
           include("XMLSoccer.php");
            try{
                $soccer=new XMLSoccer($api);
                $soccer->setServiceUrl("http://www.xmlsoccer.com/FootballData.asmx");
                $results = self::$db->query("SELECT * FROM leagues");
                while ($row = $results->fetch(PDO::FETCH_ASSOC)){
                	$league_seo = $row['league_name_seo'];
                	$league = $row['league_name'];
                	
                	$standings = $soccer->GetLeagueStandingsBySeason(array("League"=>$league, "seasonDateString"=>"1617"));
                	
                foreach($standings as $key=>$value){
                	$league_seo = $row['league_name_seo'];
                        $Team = str_replace("'", ".", $value->Team);
                       $Team = trim($Team);
                         $Team_Id = $value->Team_Id;
                         $Played = $value->Played;
                         $PlayedAtHome = $value->PlayedAtHome;
                         $PlayedAway= $value->PlayedAway;
                         $Won= $value->Won;
                         $Draw= $value->Draw;
                         $Lost= $value->Lost;
                         $YellowCards= $value->YellowCards;
                         $RedCards= $value->RedCards;
                         $Goals_For= $value->Goals_For;
                         $Goals_Against= $value->Goals_Against;
                         $Goal_Difference= $value->Goal_Difference;
                         $Points= $value->Points;
                         
						if (!empty($Team)) {
							$insert_game = self::$db->query("INSERT INTO standings (team, team_id, played, played_home, played_away, won, draw, lost, yelow_cards, red_cards, goals, goal_against, goal_difference, points, league) VALUES ('{$Team}', '{$Team_Id}', '{$Played}', '{$PlayedAtHome}', '{$PlayedAway}', '{$Won}', '{$Draw}', '{$Lost}', '{$YellowCards}', '{$RedCards}', '{$Goals_For}', '{$Goals_Against}', '{$Goal_Difference}', '{$Points}', '{$league_seo}')");
						}
							

							
                    
            }
                }
                
                    
            }catch(XMLSoccerException $e){
                echo "XMLSoccerException: ".$e->getMessage();
            }
	}else{
		$delete = self::$db->query("DELETE FROM standings");
		
		$results = self::$db->query("SELECT * FROM leagues");
                while ($row = $results->fetch(PDO::FETCH_ASSOC)){
                	$league_seo = $row['league_name_seo'];
                	$league = $row['league_name'];
                	$leagues_id = $row['leagues_id'];

				  
				  		$json = file_get_contents( 'https://apifootball.com/api/?action=get_standings&league_id='.$leagues_id.'&APIkey='.$api2.''); 
						$ipData = json_decode($json, true);

						foreach($ipData as $key=>$value){
                        $Team = str_replace("'", ".", $value['team_name']);
                      	 $Team = trim($Team);
                         $Team_Id = '';
                         $Played = $value['overall_league_payed'];
                         $PlayedAtHome = '';
                         $PlayedAway= '';
                         $Won= $value['overall_league_W'];
                         $Draw= $value['overall_league_D'];
                         $Lost= $value['overall_league_L'];
                         $YellowCards= '';
                         $RedCards= '';
                         $Goals_For= $value['overall_league_GF'];
                         $Goals_Against= $value['overall_league_GA'];
                         $Goal_Difference= '';
                         $Points= $value['overall_league_PTS'];

						if (!empty($Team)) {
							$insert_game = self::$db->query("INSERT INTO standings (team, team_id, played, played_home, played_away, won, draw, lost, yelow_cards, red_cards, goals, goal_against, goal_difference, points, league) VALUES ('{$Team}', '{$Team_Id}', '{$Played}', '{$PlayedAtHome}', '{$PlayedAway}', '{$Won}', '{$Draw}', '{$Lost}', '{$YellowCards}', '{$RedCards}', '{$Goals_For}', '{$Goals_Against}', '{$Goal_Difference}', '{$Points}', '{$league_seo}')");
						}
}
                    
                }
	}

      
            
}



}

Admin::init();