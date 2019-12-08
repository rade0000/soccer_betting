<?php
require_once 'core/init.php';
if (!empty($_SESSION['id']) AND !empty($_SESSION['name'])) {
if (isset($_POST['submit_comment'])) {
if (!empty($_POST['id_tickets']) AND !empty($_POST['comment'])) {
				$user_id = $_SESSION['id'];
				$img = $_SESSION['user_img'];
				$ticket_id = $_POST['id_tickets'];
				$comment = $_POST['comment'];
				$user_name = $_SESSION['name'];
	$ids = $_POST['id_user'];
	
Game::AddComments($ticket_id,$user_id,$comment,$user_name,$ids,$img);
}else{
					echo "<p>Comment cant be empty</p>";
			}
}
}else{
		echo "<p>Please Login</p>";
	}