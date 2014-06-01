<?php
	//MySQL connection variables
	$hostname = 'localhost';
	$user = ini_get('mysqli.default_user');
	$pw = ini_get('mysqli.default_pw');
	$database = 'rhytxfpd_projectbass_admin';
	
	//Connect to database
	$db = mysqli_connect($hostname, $user, $pw, $database);
	
	//Check connection
	if (mysqli_connect_errno()) {
		die('Failed to connect to MySQL server: ' . mysqli_connect_error());
	}
?>