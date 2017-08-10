<?php

$data = "01/05/2012";
$date = substr($data, -4)."-".substr($data, 3, 2)."-".substr($data, 0, 2);

echo $date;
?>