<?php

@session_start();
@$_SESSION = array();
@session_destroy();
echo "<script language='javaScript'>window.location.href='login.php'</script>";
?>