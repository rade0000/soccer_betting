<?php
require_once 'core/init.php';
if (isset($_GET['id']) AND isset($_GET['pay'])) {
	$id = str_replace(';','', $_GET['id']);
	$id = str_replace('-','', $_GET['id']);
	$pay = str_replace(';','', $_GET['pay']);
	$pay = str_replace('-','', $_GET['pay']);
Admin::BuyRank($id,$pay);
	}else{
	echo "string";
}
?>