<?php
require_once 'core/init.php';

if (isset($_GET['id']) AND isset($_GET['pay']) AND isset($_GET['user'])) {
Game::Storn($_GET['id'],$_GET['pay'],$_GET['user']);
	}else{
	echo "string";
}
?>