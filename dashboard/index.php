<?php
	require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in
	require_once(LIB_DIR . 'userconnection.php'); //connects to the user's database
	get_header();
?>
		<div id="contentWrapper" class="tableArea">
			<div id="content" class="tableRow">
				<div id="sidebar" class="tableCell">
					<?php get_sidebar();?>
				</div>
				<div id="main" class="tableCell">
					<h1>Welcome to Projectbass!</h1>
				</div>
			</div>
		</div>
<?php //markup continues on footer.php ?>