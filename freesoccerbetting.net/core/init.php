<?php
session_start();
$GLOBALS['config'] = array(
	//DataBase info
	'DB' => array(
		'host' => 'localhost', // change to your host
		'user' => 'mojacena_soccer', // change to your username
		'password' => '2k4=ikQI5q#0', // change to your password
		'db_name' => 'mojacena_soccer' // change to your db_name
	),
	'app_dir' => '/home/mojacena/freesoccerbetting.net', //You dont know? Check here -> www.yoursite.com/path.php
	'site_url' => 'https://www.freesoccerbetting.net/',
	'time_zone' => 'Europe/Belgrade',
);
spl_autoload_register(function($classname){
	
require "{$GLOBALS['config']['app_dir']}/classes/{$classname}.class.php";

}

);


