<?php

//Importa a conexão do banco.
require "config.php";

// Recebe o código informado pelo usuário para ser pesquisado no banco.
$codigo = $_GET['codigo'];

// Se o valor informado for um número ele faz a pesquisa.
if (is_numeric($codigo)) {
    $sql = "SELECT * FROM candidatos WHERE codigo=$codigo";
    $conta = 0;
    $res = mysql_query($sql, $con);
    while ($row = mysql_fetch_assoc($res)) {
        $imagem[] = array(
            'codigo' => $row['codigo'],
            'nome' => $row['nome'],
            'logo' => $row['logo'],
        );
        $conta++;
    }
    if ($conta == 1) {
// Retorna um array com os valores do candidato.
        echo( json_encode($imagem) );
    } else {
        $imagem[] = array(
            'codigo' => 0,
            'nome' => '',
            'logo' => 'invalido.png',
        );
// Retorna um array com valores inválidos.
        echo( json_encode($imagem) );
    }
} else {
    $imagem[] = array(
        'codigo' => 0,
        'nome' => '',
        'logo' => 'invalido.png',
    );
// Retorna um array com valores inválidos.
    echo( json_encode($imagem) );
}
?>