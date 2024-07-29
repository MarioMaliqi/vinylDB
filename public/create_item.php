<?php
session_start();
require_once('./includes/loggedin.php');
require_once('./includes/redirect.php');

if (!userLoggedIn()) {
	redirect("index.php");
}

$userInfo = isset($_COOKIE['loggedin']) ? $_COOKIE : $_SESSION;
?>


<html>
	<head>
		<title> Add an Album to the Collection </title>
	</head>
	<body>
		<form action="add_item.php" method="POST" enctype="multipart/form-data">
			<label for="name"> Album Name: </label>
			<input type="text" name="name" required/>

			<label for="artist"> Artist Name: </label>
			<input type="text" name="artist" required/>

			<label for="date"> Release Date: </label>
			<input type="date" name="date" required/>

			<label for="price"> Price: </label>
			<input type="number" name="price" min="0.00" max="10000.00" step="0.01" required/>

			<label for="cover"> Album Cover: </label>
			<input type="file" name="cover" accept="image/*" required>

			<input type="submit" />
		</form>
	</body>
</html>
