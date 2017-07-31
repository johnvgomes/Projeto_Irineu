<style>
    .depto{
        float: left;
        border:1px #ccc solid;
        padding: 1%;
        border-radius: 10px;
        background: white;
        margin: 1%;
    }

    .depto a{
        text-decoration: none;
        color: red;
    }

</style>

<form name="consultar" method="post" id="consultar">
    <h3>Determine a faixa salarial</h3>
    <select name="inicial" id="inicial">
        <option value="" disabled selected>Valor inicial</option>
        <option value="800">R$ 800,00</option>
        <option value="1800">R$ 1.800,00</option>
        <option value="2800">R$ 2.800,00</option>
        <option value="3800">R$ 3.800,00</option>
        <option value="4800">R$ 4.800,00</option>
    </select>
    <select name="final" id="final">
        <option value="" disabled selected>Valor final</option>
        <option value="5800">R$ 5.800,00</option>
        <option value="7800">R$ 7.800,00</option>
        <option value="9800">R$ 9.800,00</option>
        <option value="11800">R$ 11.800,00</option>
        <option value="13800">R$ 13.800,00</option>
    </select>
    <input type="submit" value="ok" name="botao" id="botao">
</form>

<?php
extract($_POST, EXTR_OVERWRITE);
if (isset($botao)) {
    echo "<div class='visualizar'>";



include_once '../class/Funcionario.php';
$f = new Funcionario();

$f->consultarprofessor($inicial, $final);
echo "</div>";
}
?>
