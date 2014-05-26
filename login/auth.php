<?php
	//start session
	session_start();
	//check whether session variable SESS_USER_ID is present or not
	if(!isset($_SESSION['SESS_USER_ID']) || (trim($_SESSION['SESS_USER_ID']) == '')) {
		header("location: /login/index.php");
		exit();
	}
?>