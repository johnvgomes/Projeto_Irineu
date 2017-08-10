<?php
include "metaconnect.php";
$sql = "SELECT * FROM fotos";
            
$r=($sql=execute());
           
            while ($linha = $r->fetch(PDO::FETCH_NUM)){
                echo "<pre>$linha[1]</pre>";
            }
?>