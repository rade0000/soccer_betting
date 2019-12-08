<?php
require_once 'core/init.php';
$pdo = NEW PDO('mysql:host=127.0.0.1;dbname=filmovi1_1x2','filmovi1_1x2','u=G7iqPuU#EQ');
		$result = $pdo->query('SELECT * FROM webchat_lines ORDER BY id DESC LIMIT 5');
		$r = $result->fetchAll(PDO::FETCH_OBJ);
echo json_encode($r);


?>