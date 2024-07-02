<?php
session_start();
require_once('./includes/loggedin.php');
require_once('./includes/auth_errors.php');
loggedInGuard();
?>

<html>
	<head>
		<meta charset="utf-8">
		<title> Login </title>
	</head>
	<body>
		<h1>Login</h1>
		<form action="./authenticate.php" method="POST">
			<label for="username"> Username: </label>
			<input type="text" name="username" placeholder="Username" id="username" required>
			<label for="password"> Password: </label>
			<input type="password" name="password" placeholder="Password" id="password" required>
			<label for="remember"> Remember Me: </label>
			<input type="checkbox" name="remember" id="remember">
			<input type="submit" value="Login">
		</form>
<?php
if (isset($_GET['err'])) {
	$errorCode = (int)$_GET['err'];
	if (ctype_digit($_GET['err']) && $errorCode < count($ERROR_MESSAGES) && $errorCode > -1) {
		echo "<span> Error: $ERROR_MESSAGES[$errorCode] </span>";
	}
}
?>
	</body>
</html>
