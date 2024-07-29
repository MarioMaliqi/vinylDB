<?php
session_start();

require_once('./includes/redirect.php');
require_once('./includes/loggedin.php');
require_once('./includes/sanitize_validate.php');
require_once('./includes/dbcon.php');

if (!userLoggedIn()) {
	redirect("index.php");
}

$db = new DBCon();
$con = $db->getCon();

$userInfo = isset($_COOKIE['loggedin']) ? $_COOKIE : $_SESSION;

$ErrURL = 'create_item.php';
$SuccURL = 'view_collection.php';

$names = [
	'name',
	'artist',
	'date',
	'price',
];

if ($inputsRes = areInputsSet($names, 'POST')[0]) {
	redirect("$ErrURL?err=0");
}

if (!$inputsRes = areInputsSet(['cover'], 'FILES')[0]) {
	redirect("$ErrURL?err=0");
}

$formatPOST = formatInput($names);
$img = $_FILES['cover'];

$cover_id;
$content = file_get_contents($img['tmp_name']);
if ($stmt = $con->prepare("INSERT INTO images (name, mime, size, data) VALUES (?, ?, ?, ?) RETURNING id")) {
	$stmt->bind_param('ssis',
		$img['name'],
		$img['type'],
		$img['size'],
		$content,
	);
	$stmt->execute();
	$stmt->bind_result($cover_id);
	$stmt->fetch();
	var_dump($stmt->num_rows);
	$stmt->close();
}

if ($stmt = $con->prepare("INSERT INTO albums (account_id, name, price, date, artist, cover_id) VALUES (?, ?, ?, ?, ?, ?)")) {
	$stmt->bind_param('isdssi',
		$userInfo['id'],
		$formatPOST['name'],
		$formatPOST['price'],
		$formatPOST['date'],
		$formatPOST['artist'],
		$cover_id,
	);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->affected_rows > 0) {
		redirect($SuccURL);
	} else {
		// redirect here
		redirect($ErrURL . '?err=album');
	}
	$stmt->close();
}

die();
?>
