<?php
	//Start session
	session_start();
	
	//unset variables stored in a previous session
	unset($_SESSION['SESS_USER_ID']);
	unset($_SESSION['SESS_USER_FIRST']);
	unset($_SESSION['SESS_USER_LAST']);
	unset($_SESSION['SESS_USER_PROGRAM']);
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/stylesheet.css"/>
		<title>Project Bass - Login</title>
	</head>
	<body>
		<form name="loginform" action="/login/loginExec.php" method="post">
			<div id="inputValidation">
				<?php
					if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
						echo '<ul class="err">';
						foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
							echo '<li>' . $msg . '</li>';
						}
						echo '</ul>';
						unset($_SESSION['ERRMSG_ARR']);
					}
				?>
			</div>
			<div class="formArea">
				<div class="formRow">
					<div class="formLabel">
						Username:
					</div>
					<div class="formControl">
						<input name="username" type="text"/>
					</div>
				</div>
				<div class="formRow">
					<div class="formLabel">
						Password:
					</div>
					<div class="formControl">
						<input name="password" type="password"/>
					</div>
				</div>
				<div class="formRow">
					<input name="" type="submit" value="login"/>
				</div>
			</div>
		</form>
<?php //markup continues on footer.php ?>