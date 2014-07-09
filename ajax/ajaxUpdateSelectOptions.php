<?php
require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in

$sql = 'SELECT ' . $_GET['column'] . ' FROM ' . $_GET['table'] . ' WHERE ' . $_GET['lookup'] . ' = ' . $_GET['id'];

$userdb = userConnect();
foreach ($userdb->query($sql) as $row) {
    echo '<option>' . $row[0] . '</option>';
}

