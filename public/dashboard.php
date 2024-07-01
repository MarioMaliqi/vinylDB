<?php
session_start();
require_once('./includes/loggedin.php');
if (!userLoggedIn()) {
	header("Location: index.php");
}

$userInfo = isset($_COOKIE['loggedin']) ? $_COOKIE : $_SESSION;
// check wether or not user is still logged in.
// if not redirect with an error maybe
?>

<html>
	<h1>
		Welcome to the dashboard!
	</h1>
	<h1>
		You are currently logged in as <?php echo $userInfo['name'] ?>!
	</h1>
	<a href="logout.php"> Logout </a>
</html>
