<?php
require_once 'core/init.php';

if (isset($_GET['id'])) {
Game::Trash($_GET['id']);
	}else{
	echo "string";
}
?>