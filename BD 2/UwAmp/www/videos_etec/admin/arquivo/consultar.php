<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    ?>

    <form method="post" name="form" id="form">
        <label>Tipo:</label> <br>
        <select name="cbotipo">
            <option value="Aluno com arquivo">Aluno com arquivo</option>
            <option value="Aluno sem arquivo">Aluno sem arquivo</option>
            <option value="Servidor com arquivo">Servidor com arquivo</option>
            <option value="Servidor sem arquivo">Servidor sem arquivo</option>
            <option value="Plano Escolar">Plano Escolar</option>
        </select>

        <input type="submit" name="btnpesquisar" id="cadastrar" value="Pesquisar"><br>
    </form>

    <?php
    if (isset($_POST['btnpesquisar'])) {
        include_once '../class/Arquivo.php';

        $a = new Arquivo();
        $a->consultarAdm($_POST['cbotipo']);
    }
}
?>