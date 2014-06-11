<?php
	//MySQL connection variables
	$hostname = 'localhost';
	$user = 'rhytxfpd_pbu' . $_SESSION['SESS_USER_ID'];
	$pw = $_SESSION['SESS_USER_PW'];
	$database = 'rhytxfpd_projectbass_' . $_SESSION['SESS_USER_ID'];
	
	//connect to database
	$userdb = mysqli_connect($hostname, $user, $pw, $database);
	
	//save connection to global session variable
	$_SESSION['SESS_USER_DB'] = $userdb;
	
	//check connection
	if (mysqli_connect_errno()) {
		die('Failed to connect to MySQL server:' . mysqli_connect_error());
	}s
?>