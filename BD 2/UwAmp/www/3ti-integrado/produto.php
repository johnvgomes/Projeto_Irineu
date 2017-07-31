<h3>Produtos...</h3>
<p>Confira abaixo alguns produtos que podem vir a ser de seu interesse</p>
<br>
<?php
include_once 'class/Url.php';
$url = new Url();

@$pagina = $url->getURL(1);
include_once 'class/Produto.php';
include_once 'class/PaginarProduto.php';
$p = new Produto();
/*
 * $pagina -> representa o numero da página
 * "funcionario" -> representa a table mysql noticia
 * "imagem_funcionario" -> representa a table mysql imagem_noticia
 * "{$url->getBase()}imagem_funcionario/" -> pasta de imagens
 * "{$url->getBase()}funcionario/" ->captura o nome desta página
 */

$p->paginar($pagina, "produto", 
        "imagem_Produto"
        , "{$url->getBase()}foto_produto/", 
            "{$url->getBase()}produto/");


?>
