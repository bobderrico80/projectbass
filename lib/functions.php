<?php
	//Displays header
	function get_header() {
		require_once(COMP_DIR . 'header.php');
	}
	
	//Returns current parent directory of calling php script
	function get_parent_dir() {
		$path = $_SERVER['PHP_SELF'];
		$splitPath = explode('/', $path);
		return $splitPath[1];
	}
	
	//Displays page title
	function get_page_title() {
		$title = get_parent_dir();
		$titleUpper = ucfirst($title);
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
	
	//Echoes 'class="current"' if calling php script is in the current directory, otherwise echoes an empty string
	function is_current($dirname) {
		$dir = get_parent_dir();
		if ($dir == $dirname) {
			echo 'class="current"';
		} else {
			echo '';
		}		
	}
	
	//Displays the sidebar of the current page
	function get_sidebar() {
		require_once(COMP_DIR . 'sidebars.php');
	}
?>