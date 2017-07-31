<h3>Funcionários da empresa</h3>
<p>Confira abaixo algumas notícias de interesse geral</p>
<br>
<?php
include_once 'class/Url.php';
$url = new Url();

@$pagina = $url->getURL(1);
include_once 'class/Funcionario.php';
include_once 'class/PaginarFuncionario.php';
$f = new Funcionario();
/*
 * $pagina -> representa o numero da página
 * "funcionario" -> representa a table mysql noticia
 * "imagem_funcionario" -> representa a table mysql imagem_noticia
 * "{$url->getBase()}imagem_funcionario/" -> pasta de imagens
 * "{$url->getBase()}funcionario/" ->captura o nome desta página
 */

$f->paginar($pagina, "funcionario", 
        "imagem_funcionario"
        , "{$url->getBase()}foto_funcionario/", 
            "{$url->getBase()}funcionario/");


?>
