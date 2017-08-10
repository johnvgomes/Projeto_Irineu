<?php

session_start();
$_SESSION = array();
session_destroy();

header("Location: index.php");
echo '<meta http-equiv="refresh" content="1;URL=index.php">';
?>