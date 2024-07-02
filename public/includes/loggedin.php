<?php

require_once('redirect.php');

function userLoggedIn() {
	if (isset($_SESSION['loggedin']) || isset($_COOKIE['loggedin'])) {
		return true;
	}
	return false;
}

function loggedInGuard() {
	if(userLoggedIn()) {
		redirect("dashboard.php");
	}
}
