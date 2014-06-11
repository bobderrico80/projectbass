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
	
	//Displays formatted table for the specified sql string
	/* NOTE: function is designed for SELECT queries where the first
	field is the primary key.  This field will not display, but it's
	value will be written as the id for each table row element, as well
	as the id for a checkbox element that will display at the start of
	each row.
	*/
	function display_table($sql, $tid) {
		
		$userdb = $_SESSION['SESS_USER_DB'];
		$rst = mysqli_query($userdb,$sql);
		
		//code to print column headings
		$fields = mysqli_fetch_fields($rst);
		echo '<table id="' . $tid . '" class="recordset">';
		echo '<thead>';
		echo '<tr id="header">';
		echo '<td></td>'; //empty cell for checkbox column
		for ($i = 1; $i < count($fields); $i++) {
			echo '<td>' . $fields[$i]->name . '</td>';
		}
		echo '</tr>';
		echo '</thead>';
		
		//code to print records
		echo '<tbody>';
		while ($record = mysqli_fetch_row($rst)) {
			$rowcount++;
			if ($rowcount % 2 == 0) {
				echo '<tr id="' . $record[0] .'" class="altrow">';
			} else {
				echo '<tr id="' . $record[0] .'">';
			}
			echo '<td><input type="checkbox" class="recordselect" id="' . $record[0] . '"/></td>';
			for ($i = 1; $i < count($record); $i++) {
				echo '<td>' . $record[$i] . '</td>';
			}
			echo '</tr>';
		}
		echo '</tbody>';		
		echo '</table>';
	}
?>