<?php
session_start();
require_once('./includes/loggedin.php');
loggedInGuard();

require_once('./includes/dbcon.php');
require_once('./includes/sanitize_validate.php');
require_once('./includes/redirect.php');

$db = new DBCon();
$con = $db->getCon();

$fieldNames =  [
	'username', 
	'password',
	'email',
];

if (!$inputsRes = areInputsSet($fieldNames, 'POST')[0]) {
	redirect('signup.php?err=0');
}
$formattedInputs = formatInput($fieldNames);

// check if acc with mail or name already exits 
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $formattedInputs['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		redirect('signup.php?err=2');
	}
	$stmt->close();
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	$stmt->bind_param('s', $formattedInputs['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		redirect('signup.php?err=3');
	}
	$stmt->close();
}

if ($stmt = $con->prepare("INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)")) {
	$hashed_password = password_hash($formattedInputs['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $formattedInputs['username'], $hashed_password, $formattedInputs['email']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->affected_rows > 0) {
		// this is fine
		echo 'Account was successfully created. <a href="login.php"> Click here to login </a>';
	}
	$stmt->close();
}
