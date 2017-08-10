<h3>Servidor</h3>
<?php
include_once 'class/Url.php';
include_once 'class/Arquivo.php';

$url = new Url();
$a = new Arquivo();

echo "<div class='pgcurso'>
    <img src='".$url->getBase()."imagem/calendario.png' alt='Calendário'>";
?>
<h4>
Servidor docente e administrativo.
</h4>
Acesso a folha de pagamento, recadastramento obrigatório anual, manual
de conduta, entre outros. Basta clicar sobre a imagem para visualizar 
ou acessar.<br><br>


<?php
$a->consultar($url->getBase(), "Servidor com arquivo");
$a->consultar("", "Servidor sem arquivo");
echo "</div>";

?>