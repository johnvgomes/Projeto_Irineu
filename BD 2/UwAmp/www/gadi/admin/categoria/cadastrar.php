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
                    <h3>Cadastro de Categoria</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Categoria</label> 
                    <input name="txtnome" maxlength="100" type="text"> 
                
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Categoria">
                </td>
            </tr>
        </form>
    </table>

    <?php

    include_once '../class/Categoria.php';
    $e = new Categoria();

    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtnome'])) {


            extract($_POST, EXTR_OVERWRITE);
            $e->setNome(strtr(strtoupper($txtnome), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
            $e->salvar();
        } else {
            echo "Preencha todos os campos!";
        }
    }

    $e->consultar();
}//fecha a verifica��o do login
?>
















