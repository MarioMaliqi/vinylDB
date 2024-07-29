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
	'password'
];

if ($inputsRes = areInputsSet($fieldNames, 'POST')[0]) {
	redirect('login.php?err=0');
}

$formattedInputs = formatInput($fieldNames);
if (!$inputsRes = areInputsSet(['remember'], 'POST')[0]) {
	$rememberUser = false;
} else {
	$rememberUser = true;
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $formattedInputs['username']);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		if (password_verify($formattedInputs['password'], $password)) {
			session_regenerate_id();
			if (isset($rememberUser)) {
				setcookie("loggedin", true);
				setcookie('name', $formattedInputs['username']);
				setcookie('id', $id);
			} else {
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $formattedInputs['username'];
				$_SESSION['id'] = $id;
			}
			redirect('view_collection.php');
			die();
		} else {
			redirect('login.php?err=1');
		}
	} else {
		redirect('login.php?err=1');
	}
	$stmt->close();
}
