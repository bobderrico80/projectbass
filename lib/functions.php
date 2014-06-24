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
	
	//Populates a listbox (<select>) with options based on an SQL query
	/* Select only two columns! the first column should be an index value
	(i.e. the primary key of the table), and the second column should be
	the text to be displayed as the option in the listbox */
	function get_list_contents($sql) {
		
		$userdb = $_SESSION['SESS_USER_DB'];
		$rst = mysqli_query($userdb,$sql);
		
		while ($record = mysqli_fetch_row($rst)) {
			echo '<option value = "' . $record[0] . '">' . $record[1] .'</option>';
		}
	}
	
	//Populates a listbox with the US States (values as abbreviations)
	function get_list_states(){
		$states = array('AL'=>"Alabama",
					'AK'=>"Alaska",
					'AZ'=>"Arizona",
					'AR'=>"Arkansas",
					'CA'=>"California",
					'CO'=>"Colorado",
					'CT'=>"Connecticut",
					'DE'=>"Delaware",
					'DC'=>"District Of Columbia",
					'FL'=>"Florida",
					'GA'=>"Georgia",
					'HI'=>"Hawaii",
					'ID'=>"Idaho",
					'IL'=>"Illinois",
					'IN'=>"Indiana",
					'IA'=>"Iowa",
					'KS'=>"Kansas",
					'KY'=>"Kentucky",
					'LA'=>"Louisiana",
					'ME'=>"Maine",
					'MD'=>"Maryland",
					'MA'=>"Massachusetts",
					'MI'=>"Michigan",
					'MN'=>"Minnesota",
					'MS'=>"Mississippi",
					'MO'=>"Missouri",
					'MT'=>"Montana",
					'NE'=>"Nebraska",
					'NV'=>"Nevada",
					'NH'=>"New Hampshire",
					'NJ'=>"New Jersey",
					'NM'=>"New Mexico",
					'NY'=>"New York",
					'NC'=>"North Carolina",
					'ND'=>"North Dakota",
					'OH'=>"Ohio",
					'OK'=>"Oklahoma",
					'OR'=>"Oregon",
					'PA'=>"Pennsylvania",
					'RI'=>"Rhode Island",
					'SC'=>"South Carolina",
					'SD'=>"South Dakota",
					'TN'=>"Tennessee",
					'TX'=>"Texas",
					'UT'=>"Utah",
					'VT'=>"Vermont",
					'VA'=>"Virginia",
					'WA'=>"Washington",
					'WV'=>"West Virginia",
					'WI'=>"Wisconsin",
					'WY'=>"Wyoming");
		foreach ($states as $key=>$val) {
			echo '<option value="' . $key . '">' . $val . '</option>';
		}
	}
?>