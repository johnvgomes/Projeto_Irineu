<?php

//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Cadastro de Unidade</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Unidade (Sede/Sala Descentralizada/Extensão):</label> 
                    <input name="txtnome" maxlength="100" type="text"> 
                
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Unidade">
                </td>
            </tr>
        </form>
    </table>

    <?php

    include_once '../class/Unidade.php';
    $u = new Unidade();

    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtnome'])) {


            extract($_POST, EXTR_OVERWRITE);
            $u->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $u->salvar();
        } else {
            echo "Preencha todos os campos!";
        }
    }

    $u->consultar();
}//fecha a verifica��o do login
?>
















