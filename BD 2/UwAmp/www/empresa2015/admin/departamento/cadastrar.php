<table>
    <form name="cadastrar" id="cadastrar" method="post">
        <tr>
            <td colspan="2">
                <h3>Cadastro de Departamento</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">Nome:<br>
                <input type="text" name="txtnome" id="txtnome"
                       maxlength="50" size="40">
            </td>
        </tr>
        <tr>
            <td>Funcionários:<br>
                <input type="number" name="txtnr" id="txtnr"
                       min="1" max="9999">
            </td>
            <td colspan="2">
                <input type="submit" name="btn" id="btn" value="Cadastrar">  
            </td>
        </tr>
    </form>
</table>
<?php
if (isset($_POST['btn']) && !empty($_POST['txtnome']) &&
        !empty($_POST['txtnr'])) {

    // incluir/importar arquivo/classe Departamento.php
    include_once '../class/Departamento.php';
    // criação de objeto, para que possamos acessar a classe (public)
    $depto = new Departamento();

    //extrair os campos do form (name="txtnome" -> $txtnome)
    extract($_POST, EXTR_OVERWRITE);

    //envio de dados do form aos atributos via métodos set
    $depto->setNome(strtoupper($txtnome));
    $depto->setNrfuncionarios($txtnr);

    // efetiva o cadastro
    $depto->salvar();
}
?>

