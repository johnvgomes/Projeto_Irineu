<?php

//Conecta ao servidor mysql localhost e no banco urna com o usuário root e senha em branco.
if ($con = mysql_pconnect("localhost", "root", "root")) {
//Seleciona o banco urna.
    mysql_select_db("urna");
    return $con;
} else {
    echo "Erro ao conectar ao servidor.";
}
?>