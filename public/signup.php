<?php
session_start();
require_once('./includes/loggedin.php');
loggedInGuard();
?>

<html>
	<head>
		<meta charset="utf-8">
		<title> Sign-up </title>
	</head>
	<body>
		<h1> Sign-up </h1>
		<form action="./create_user.php" method="post">
			<label for="email"> E-mail: </label>
			<input type="email" name="email" placeholder="E-mail" id="email" required>
			<label for="username"> Username: </label>
			<input type="text" name="username" placeholder="Username" id="username" required>
			<label for="password"> Password: </label>
			<input type="password" name="password" placeholder="Password" id="password" required>
			<input type="submit" value="Login">
		</form>
	</body>
</html>
