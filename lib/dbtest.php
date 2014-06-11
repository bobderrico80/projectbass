<?php

$db = mysqli_connect('localhost','rhytxfpd','8pOj3eDVm4Zbh'); //

if (mysqli_connect_errno()) {
	die(mysqli_connect_error());
}

$sql = 'GRANT CREATE USER TO "rhytxfpd"@"localhost";';
$sql1 = 'CREATE USER "rhytxfpd_pbu1" IDENTIFIED BY "jsmith";';

echo '<p>SQL Statement: ' . $sql . '</p>';

$result = mysqli_query($db, $sql);

if(is_object($result)) {
	echo '<table>';

	while ($row = mysqli_fetch_assoc($result)) {
		echo '<tr>';
		foreach ($row as $val) {
			echo '<td>' . $val . '</td>';
		}
		echo '</tr>';
	}

	echo '</table>';
} else {
	if(!$result) {
		echo '<p>SQL Failed:';
		echo mysqli_error($db);
		echo '</p>';
	} else {
		echo '<p>SQL Success!</p>';
	}
}
?>