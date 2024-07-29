<?php
session_start();
require_once('./includes/loggedin.php');

if (!userLoggedIn()) {
	header("Location: index.php");
}

require_once('./includes/dbcon.php');
$db = new DBCon();
$con = $db->getCon();

$userInfo = isset($_COOKIE['loggedin']) ? $_COOKIE : $_SESSION;

$collection;
if ($stmt = $con->prepare('SELECT name, date, price, artist, cover_id FROM albums WHERE account_id = ?')) {
	$stmt->bind_param('i', $userInfo['id']);
	$ex = $stmt->execute();
	$res = $stmt->store_result();
	if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $date, $price, $artist, $cover_id);
        while ($stmt->fetch()) {
            $collection[] = compact('name', 'date', 'price', 'artist', 'cover_id');
        }
	} else {
        $collection = array();
	}
    $stmt->close();
} else {
    $collection = array();
}

// $collection = array();
?>

<html>
  <head>
    <title> Collection Overview </title>
      <h1> Collection Overview </h1>
      <a href="logout.php"> Logout </a>
      <br>
      <a href="create_item.php"> Add an Album </a>
  </head>
  <body>

<?php if (count($collection) < 1): ?>
  <p> There are no available albums in your Collection. Try adding some! </p>

<?php else: ?>
    <table>
      <thead>
        <tr>
          <td> Album Name </td>
          <td> Date </td>
          <td> Price </td>
          <td> Artist Name </td>
          <td> Cover </td>
        </tr>
      </thead>
      <tbody>
<?php
foreach ($collection as $album) {
	echo "<tr>";
	foreach ($album as $col => $data) {
		if ($col == 'cover_id') {
			echo '<td> bruh </td>';
			continue;
		}
		echo "<td> $data </td>";
	}
	echo "</tr>";
}
?>
      </tbody>
    </table>

<?php endif; ?>
  </body>
</html>
