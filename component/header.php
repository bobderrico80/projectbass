<?php
	require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/stylesheet.css"/>
		<title>Project Bass - <?php get_page_title(); ?></title>
	</head>
	<body>
		<div id="userBar">
			<div id="titleArea">
				Project Bass
			</div>
			<div id="userArea">
				<div id="username">
					Welcome, <?php get_user_full_name(); ?>
				</div>
				<div id="userOpts">
					<a href="#">Account Settings</a> | <a href="/login/index.php">Logout</a>
				</div>
			</div>
		</div>
		<div id="masthead">
			<?php get_program_name(); ?>
		</div>
		<div id="navBar">
		</div>
<?php //markup continues on the script that originally called get_header() ?>