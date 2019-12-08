<?php
require_once 'core/init.php';
if (!empty($_GET['id']) AND !empty($_GET['user'])) {
	$id = $_GET['id'];
	$user = $_GET['user'];
Game::DeleteComment($id,$user);
}