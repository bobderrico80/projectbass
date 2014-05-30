<?php
	//MySQL connection variables
	$hostname = 'localhost';
	$user = 'rhytxfpd_admin';
	$pw = '&3[Swa7usTs3';
	$database = 'rhytxfpd_projectbass_admin';
	
	//Connect to database
	$db = mysqli_connect($hostname, $user, $pw, $database);
	
	//Check connection
	if (mysqli_connect_errno()) {
		die('Failed to connect to MySQL server: ' . mysqli_connect_error());
	}
?>