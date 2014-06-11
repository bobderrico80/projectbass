<?php
	require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in
	require_once(LIB_DIR . 'userconnection.php'); //connects to the user's database
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
			<ul id="nav">
				<li><a href="/dashboard/index.php" <?php is_current('dashboard'); ?>>Dashboard</a></li>
				<li><a href="/students/index.php" <?php is_current('students'); ?>>Students</a></li>
				<li><a href="/ensembles/index.php" <?php is_current('ensembles'); ?>>Ensembles</a></li>
				<li><a href="/lessons/index.php" <?php is_current('lessons'); ?>>Lessons</a></li>
				<li><a href="/instruments/index.php" <?php is_current('instruments'); ?>>Instruments</a></li>
				<li><a href="/uniforms/index.php" <?php is_current('uniforms'); ?>>Uniforms</a></li>
				<li><a href="/equipment/index.php" <?php is_current('equipment'); ?>>Equipment</a></li>
				<li><a href="/music/index.php" <?php is_current('music'); ?>>Music</a></li>
				<li><a href="/fundraising/index.php" <?php is_current('fundraising'); ?>>Fundraising</a></li>
				<li><a href="/schools/index.php" <?php is_current('schools'); ?>>Schools</a></li>
			</ul>
		</div>
<?php //markup continues on the script that originally called get_header() ?>