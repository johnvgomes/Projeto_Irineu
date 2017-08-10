<?php

session_start();
$_SESSION = array();
session_destroy();

echo '<script language="javascript">
    window.location.href="index.php"
    </script>';
?>
