<?php
require_once 'core/init.php';
if (isset($_GET['id']) AND isset($_GET['pay']) AND isset($_GET['user'])) {
	$id = str_replace(';', '', $_GET['id']);
	$id = str_replace('-', '', $_GET['id']);
	$pay = str_replace(';', '', $_GET['pay']);
	$pay = str_replace('-', '', $_GET['pay']);
	$user = str_replace(';', '', $_GET['user']);
	$user = str_replace('-', '', $_GET['user']);
Game::Pay($id,$pay,$user);
	}else{
	echo "string";
}
?>