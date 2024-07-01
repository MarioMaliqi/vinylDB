<?php

function userLoggedIn() {
	if (isset($_SESSION['loggedin']) || isset($_COOKIE['loggedin'])) {
		return true;
	}
	return false;
}

function loggedInGuard() {
	if(userLoggedIn()) {
		header("Location: dashboard.php");
		die();
	}
}
