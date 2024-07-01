<?php
session_start();

//removes session
session_destroy();

// removes cookies
setcookie("loggedin","",time()-3600);
setcookie("name","",time()-3600);
setcookie("id","",time()-3600);

header("Location: index.php");
?>
