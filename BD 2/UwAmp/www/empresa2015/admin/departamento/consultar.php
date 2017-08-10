
<?php

include_once '../class/Departamento.php';
$depto = new Departamento();

echo "<h3>Cadastro Geral de Setores</h3>";

echo "<table>"
 . "<tr>"
 . "<td>ID</td>"
 . "<td>Nome</td>"
 . "<td>Nr Funcionários</td>"
 . "<td>Excluir?</td>"
 . "<td>Editar</td>"
 . "</tr>";

$depto->consultar();
echo "</table>";
?>
