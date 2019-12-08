<?php
require_once 'core/init.php';
if (isset($_GET['id']) AND !empty($_SESSION['admin_logged'])) {
	$idr = str_replace(';', '', $_GET['id']);
	$idr = str_replace('-', '', $_GET['id']);
	Admin::DeleteUser($idr);
}else{
	die('You are not admin');
}
?>