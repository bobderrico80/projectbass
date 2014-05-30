<?php
	//Displays header
	function get_header() {
		require_once(COMP_DIR . 'header.php');
	}
	
	//Displays page title
	function get_page_title() {
		$path = $_SERVER['PHP_SELF'];
		$splitPath = explode('/', $path);
		$titleLower = $splitPath[1];
		$titleUpper = ucfirst($titleLower);
		echo $titleUpper;
	}
	
	//Displays full name of currently logged-in user
	function get_user_full_name() {
		echo $_SESSION['SESS_USER_FIRST'] . ' ' . $_SESSION['SESS_USER_LAST'];
	}
	
	//Displays program name
	function get_program_name() {
		echo $_SESSION['SESS_USER_PROGRAM'];
	}
?>