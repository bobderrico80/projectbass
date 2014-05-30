<?php
	//start the session
	session_start();
	
	//include user database connection details
	require_once(LIB_DIR . 'loginconnection.php');
	
	//array to store validation errors
	$errmsgArr = array();
	
	//validation error flag
	$errFlag = false;
	
	//function to sanitize form input
	function clean($val) {
		$val = @trim($val);
		if (get_magic_quotes_gpc()) {
			$val = stripslashes($val);
		}
		global $db;
		return mysqli_real_escape_string($db, $val);
	}
	
	//sanitize form input
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);
	
	//validate input
	if ($username == '') {
		$errmsgArr[] = 'Username missing';
		$errFlag = true;
	}
	if ($password == '') {
		$errmsgArr[] = 'Password missing';
		$errFlag = true;
	}
	
	//redirects back to login on missing information
	if ($errFlag) {
		$_SESSION['ERRMSG_ARR'] = $errmsgArr;
		session_write_close();
		header('location: /login/index.php');
		exit();
	}
	
	//create query
	$sql = "SELECT * FROM users WHERE userName = \"$username\" AND userPW = \"$password\"";
	$rst = mysqli_query($db, $sql);
	
	//check whether query was successful
	if($rst) {
		if(mysqli_num_rows($rst) > 0) {
			//Login successful!
			session_regenerate_id();
			$user = mysqli_fetch_assoc($rst);
			$_SESSION['SESS_USER_ID'] = $user['userId'];
			$_SESSION['SESS_USER_FIRST'] = $user['userFirst'];
			$_SESSION['SESS_USER_LAST'] = $user['userLast'];
			$_SESSION['SESS_USER_PROGRAM'] = $user['userProgram'];
			session_write_close();
			header('location: /dashboard/index.php');
			exit();
		} else {
			//Login failed
			$errmsgArr[] = 'Username and/or password not found';
			$errFlag = true;
			if ($errFlag) {
				$_SESSION['ERRMSG_ARR'] = $errmsgArr;
				session_write_close();
				header('location: /login/index.php');
				exit();
			}
		}
	} else {
		die("Query failed");
	}
?>