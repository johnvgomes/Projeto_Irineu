<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>
<!-- admin>curso>cadastrar.php -->
    <table>
        <form name="formcurso" id="formcurso" method="post">
            <tr>
                <th colspan="2"><h3>Cadastro de Curso</h3></th>
            </tr>
            <tr>
                <td>Nome</td>
                <td>
                    <input type="text" name="txtnome" 
                           id="txtnome" maxlength="70" size="50">
                </td>
            </tr>
            <tr>
                <td>Tipo</td>
                <td>

                    <select name="cbotipo" id="cbotipo">
                        <option value="Ensino Técnico">Ensino Técnico</option>
                        <option value="Ensino Superior">Ensino Superior</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Eixo</td>
                <td>

                    <select name="cboeixo" id="cboeixo">
                        <?php
                        include_once '../class/Eixo.php';
                        $eixo = new Eixo();
                        $eixo->carregarSelect();
                        ?>
                    </select>
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
// curso/cadastrar.php

    if (isset($_POST['btncadastrar'])) {
        include_once '../class/Curso.php';
        $c = new Curso();
        
        extract($_POST, EXTR_OVERWRITE);
        
        $c->setNome($txtnome);
        $c->setTipo($cbotipo);
        $c->setId_eixo($cboeixo);
        
        $c->cadastrar();
    }
}
?>
