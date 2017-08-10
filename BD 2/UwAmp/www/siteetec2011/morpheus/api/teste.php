<?php

//	======= ESCREVENDO O JSON =======

$mencoes = array(

'GSO3' => array('MB', 'B'),
'PC2' => array('R', 'B'),
'DTCC' => array('B', 'MB'),
'ECO' => array('MB', 'B'),
'APP' => array('I', 'R'),
'PPI' => array('B', 'B'),
'DS2' => array('MB', 'R'),

);


$json = json_encode($mencoes);

echo "<b>Retorno JSON que vou receber</b>:<br>".$json;




echo "<br/><br/>===================<br/><br/>";




//	======= LENDO O JSON =======


$retorno = json_decode($json, true);


echo "MENCAO <B>INTERMEDIARIA</B> GSO3: ".$retorno['GSO3'][0];
echo "<br/>";
echo "MENCAO <B>FINAL</B> GSO3: ".$retorno['GSO3'][1];



?>