<?php
	
	//sets path constants
	define(ROOT_DIR, dirname(__FILE__) . '/'); //Root path
	define(LIB_DIR, ROOT_DIR . 'lib/'); //library files path
	define(LOGIN_DIR, ROOT_DIR . 'login/'); //login path
	define(COMP_DIR, ROOT_DIR . 'component/'); //component files path
	define(DASH_DIR, ROOT_DIR . 'dashboard/'); //dashboard section path
	define(STUDENTS_DIR, ROOT_DIR . 'students/'); //students section path
	
	//includes custom functions
	require_once(LIB_DIR . 'functions.php');
	
?>