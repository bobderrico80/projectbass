<?php
	//Connects to user database
	function userConnect() {
		//MySQL connection variables
		$hostname = 'localhost';
		$user = 'rhytxfpd_pbu' . $_SESSION['SESS_USER_ID'];
		$pw = $_SESSION['SESS_USER_PW'];
		$database = 'rhytxfpd_projectbass_' . $_SESSION['SESS_USER_ID'];
		
		//connect to database
		try {
			$userdb = new PDO('mysql:host=' . $hostname . ';dbname=' . $database, $user, $pw);
			return $userdb;
		} catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	
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
		
		$userdb = userConnect();
		
		try {
			//code to print column headings
			$stmt = $userdb->query($sql . ' LIMIT 1');
			$fields = array_keys($stmt->fetch(PDO::FETCH_ASSOC));
			echo '<table id="' . $tid . '" class="recordset">';
			echo '<thead>';
			echo '<tr id="header">';
			echo '<td></td>'; //empty cell for checkbox column
			for ($i = 1; $i < count($fields); $i++) {
				echo '<td>' . $fields[$i] . '</td>';
			}
			echo '</tr>';
			echo '</thead>';
			$stmt = null;
			
			//code to print records
			$stmt = $userdb->query($sql);
			echo '<tbody>';
			while ($record = $stmt->fetch(PDO::FETCH_NUM)) {
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
		} catch(PDOException $e) {
			echo $e->getMessage();
			die();
		}
	}
	
	//Populates a listbox (<select>) with options based on an SQL query
	/* Select only two columns! the first column should be an index value
	(i.e. the primary key of the table), and the second column should be
	the text to be displayed as the option in the listbox 
	
	The second parameter is the index of the preselected option
	*/
	function get_list_contents($sql, $preselect = null) {
		
		try {
			$userdb = userConnect();
			$stmt = $userdb->query($sql);
			
			while ($record = $stmt->fetch(PDO::FETCH_NUM)) {
				if ($preselect == $record[0]) {
					$selected = "selected";
				} else {
					$selected = null;
				}
				echo '<option value = "' . $record[0] . '" ' . $selected .  '>' . $record[1] .'</option>';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			die();
		}
	};
	
	//Populates a listbox with the US States (values as abbreviations)
	//$preselected (optional) is the value that should be preselected)
	function get_list_states($preselect = null){
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
			if ($preselect == $key) {
				$selected = 'selected';
			} else {
				$selected = null;
			}
			echo '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
		}
	}
?>