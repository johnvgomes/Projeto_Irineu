<?php

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    

?>
<table>
    <form name="formeixo" id="formeixo" method="post">
        <tr>
            <th><h3>Cadastro de Eixo Tecnológico</h3></th>
        </tr>
        <tr>
            <td>
                <input type="text" name="txtnome" 
                       id="txtnome" maxlength="70" size="50">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="btncadastrar" 
                       id="btncadastrar" value="..cadastrar">
            </td>
        </tr>
    </form>
</table>


<?php

// eixo/cadastrar.php

if(isset($_POST['btncadastrar'])){
    include_once '../class/Eixo.php';
    $e = new Eixo();
    
    $e->setNome($_POST['txtnome']);
    
    $e->cadastrar();
}

}
?>
