<?php
Class Chat{
	private static $db;
	public static function init(){
		self::$db = Connect::getInstance();
}
public static function Message($text){

			if (isset($_SESSION['id'])) {
			$user_id = $_SESSION['id'];

		$result = self::$db->query("SELECT * FROM users WHERE id_users = '{$user_id}'");
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
							$user_money = $row['user_money'];
							$user = $row['user'];
							
							}

							$insert_message = self::$db->query("INSERT INTO webchat_lines (author, text, money) VALUES ('{$user}', '{$text}', '{$user_money}')");

		}else{
			echo "<p style='color:orange;'>Hi, please log in or sign up</p>";
		}

	
	}
public static function MessageShow(){

			if (isset($_SESSION['id'])) {
			$user_id = $_SESSION['id'];
		$pdo = NEW PDO('mysql:host=127.0.0.1;dbname=filmovi1_1x2','filmovi1_1x2','u=G7iqPuU#EQ');
		$result = $pdo->query('SELECT * FROM webchat_lines');
		$r = $result->fetchAll(PDO::FETCH_OBJ);
		return $r;
		}

	
	}
}


Chat::init();