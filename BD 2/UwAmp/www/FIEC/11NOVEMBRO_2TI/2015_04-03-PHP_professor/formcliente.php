<table>
    <form name="cliente" id="cliente" method="post">
        <tr>
            <td colspan="2">Cadastro de Cliente</td>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><input type="text" name="txtnome" size="50"
                       maxlength="70" id="txtnome"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="txtemail" size="50"
                       maxlength="70" id="txtemail"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="btnenviar" 
                                   id="btnenviar" value="enviar dados"></td>

        </tr>


    </form>
</table>

<?php
if (isset($_POST['btnenviar'])) {
    include_once 'class/Cliente.php';

    //criar um objeto
    $cli = new Cliente();
    //envio de dados via set
    $cli->setNome($_POST['txtnome']);
    $cli->setEmail($_POST['txtemail']);
    //mostrar dados na tela
    echo "<div class='mostrar'>Nome do Cliente: "
    . $cli->getNome() . "<br>"
    . "E-mail do Cliente: "
    . $cli->getEmail() . "</div>";
    
    //usar o construct para enviar dados aos atributos
    $cli2 = new Cliente("",$_POST['txtnome'],$_POST['txtemail']);
    
    $cli2->mostrar();
    
}
?>

