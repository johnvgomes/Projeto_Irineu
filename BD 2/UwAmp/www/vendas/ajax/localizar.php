<?php

extract($_POST, EXTR_OVERWRITE);

$cep = str_replace(array(".", "-"), "", $cep);

require_once "../class/Correios.php";
$cor = new Correios;
$cor->retornaInformacoesCep(@$cep);

$uf = utf8_encode($cor->informacoesCorreios->getUf());
$cidade = utf8_encode($cor->informacoesCorreios->getLocalidade());
$bairro = utf8_encode($cor->informacoesCorreios->getBairro());
$endereco = utf8_encode($cor->informacoesCorreios->getLogradouro());

if (!empty($endereco)) {
    $endereco .= ", nº ";
}

echo "/^uf=" . $uf . "$/&"
 . "/^cidade=" . $cidade . "$/&"
 . "/^bairro=" . $bairro . "$/&"
 . "/^endereco=" . $endereco . "$/";

?>