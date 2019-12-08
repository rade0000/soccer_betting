<?php
if (isset($_GET['id']) AND isset($_GET['text']) AND isset($_GET['allocation']) AND isset($_GET['bet']) AND isset($_GET['posibile_win'])) {
	$id = $_GET['id'];
	header("Content-type: image/jpeg");
	$allocation = 'Odds: '.$_GET['allocation'];
	$bet = 'Bet: '.$_GET['bet'];
	
	$posibile_win = 'Win: '.$_GET['posibile_win'];
	$text = str_replace(',', ' ',$_GET['text']);
	$text = explode("<br>",$text);
       
$br = 0;
$velicina = 0;
$img_number = imagecreate(500,350); 
$backcolour = imagecolorallocate($img_number,0,0,0); 
$textcolour = imagecolorallocate($img_number,0,244,34); 
$textcolour2 = imagecolorallocate($img_number,220,20,60); 
imagefill($img_number,0,0,$backcolour); 
		foreach ($text as $textt) {
			$velicina += 20;
			$br++;
		imagestring($img_number,110,5,$velicina,$textt,$textcolour);
		}
		$velicina += 40;
imagestring($img_number,110,5,$velicina,$allocation,$textcolour2);
imagestring($img_number,110,115,$velicina,$bet,$textcolour2);
imagestring($img_number,110,270,$velicina,$posibile_win,$textcolour2);
 
imagejpeg($img_number); 
}



?>
