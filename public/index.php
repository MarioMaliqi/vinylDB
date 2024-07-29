<?php
session_start();
require_once('./includes/loggedin.php');
loggedInGuard();
?>

<html>
	<body>
		<span>
			<a href='login.php' > Login </a>
			or
			<a href='signup.php' > Signup </a>
		</span>
	</body>
</html>
