<?php

unset($_SESSION['cliente']);
unset($_SESSION['clienteId']);
unset($_SESSION['clienteNome']);

include_once 'home.php';
echo '<meta http-equiv="refresh" content="1;URL=' . URL::getBase() . 'home" />';
?>