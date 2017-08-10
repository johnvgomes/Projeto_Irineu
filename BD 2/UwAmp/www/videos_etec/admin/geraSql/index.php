<?php

//host,user,senha
mysql_connect("localhost", "root", "") or die(mysql_error());

//db
$result = mysql_query("CREATE DATABASE IF NOT EXISTS 2web2013") or die(mysql_error());

if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Banco de dados 2web2013 criado com sucesso.<br />";

mysql_select_db("2web2013") or die(mysql_error());

//CASO QUEIRA APAGAR ANTES DE INSTALAR O BD
mysql_query("DROP TABLE login") Or die(mysql_error());

$result = mysql_query("CREATE TABLE IF NOT EXISTS login (
        id int(11) NOT NULL AUTO_INCREMENT,
        usuario varchar(100) DEFAULT NULL,
        senha varchar(255) DEFAULT NULL,
        PRIMARY KEY (id)
    )") Or die(mysql_error());

if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Table login criada com sucesso.<br />";

$result = mysql_query("INSERT INTO login VALUES (null,'teste','" . sha1(123) . "')");
if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Inserido com sucesso teste 123.<br />";

$result = mysql_query("CREATE TABLE IF NOT EXISTS marca (
        id int(11) NOT NULL AUTO_INCREMENT,
        marca varchar(70) DEFAULT NULL,
        origem varchar(50) DEFAULT NULL,
        PRIMARY KEY (id)
    )") Or die(mysql_error());

if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Table marca criada com sucesso.<br />";

$result = mysql_query("CREATE TABLE IF NOT EXISTS moto (
        id int(11) NOT NULL AUTO_INCREMENT,
        placa varchar(8) DEFAULT NULL,
        modelo varchar(100) DEFAULT NULL,
        cc int(4) DEFAULT NULL,
        renavam varchar(20) DEFAULT NULL,
        foto varchar(150) DEFAULT NULL,
        estoque int(1) DEFAULT NULL,
        valor double(10,2) DEFAULT NULL,
        id_marca int(11) DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY(id_marca) references marca (id)
    )") Or die(mysql_error());

if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Table moto criada com sucesso.<br />";

$result = mysql_query("CREATE TABLE IF NOT EXISTS noticia (
        id int(11) NOT NULL AUTO_INCREMENT,
        titulo varchar(120) DEFAULT NULL,
        url varchar(120) DEFAULT NULL,
        conteudo text,
        imagem varchar(120) DEFAULT NULL,
        id_marca int(11) DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY(id_marca) references marca (id)
    )") Or die(mysql_error());

if (!$result)
    die("Falha ao executar o comando: " . mysql_error());
else
    echo "Table noticia criada com sucesso.<br />";


mysql_close();
?>
