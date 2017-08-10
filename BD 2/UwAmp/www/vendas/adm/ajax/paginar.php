<?php

extract($_POST, EXTR_OVERWRITE);

require_once '../../class/Paginar.php';
require_once '../../class/' . $table . '.php';
$p = new Paginar();
$x = new $table();

if (!empty($name) && !empty($like)) {
    $busca = "$name LIKE '%$like%'";
}

@$maximo = $x->quantPg($busca);
$pg = $p->numPag($maximo, $pg);


echo "/^pg=$pg$/&/^max=$maximo$/";
?>