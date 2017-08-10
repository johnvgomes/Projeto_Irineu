<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
// admin/curso/editar.php

    include_once '../class/Curso.php';
    $c = new Curso();

    $id = (int) $_GET['id'];

    $vetor = $c->carregar($id);
    ?>

    <form name="frmcurso" id="frmcurso" method="post">
        <h3>Editar Curso</h3>

        Nome: <br>
        <input type="text" maxlength="50" size="50" 
               value="<?php echo $vetor[1]; ?>" 
               id="txtnome" name="txtnome">
        <br><br>

        Tipo: <br>
        <select name="cbotipo" id="cbotipo">
            <optgroup label="Tipo selecionado">
            <option value="<?php echo $vetor[2]; ?>">
                <?php echo $vetor[2]; ?>
            </option>
            <optgroup label="Escolha um novo tipo">
            <option value="Ensino Técnico">Ensino Técnico</option>
            <option value="Ensino Superior">Ensino Superior</option>
        </select>
        <br><br>

        Eixo Tecnológico: <br>
        <select name="cboeixo" id="cboeixo">
            <optgroup label="Eixo selecionado">
            <option value="<?php echo $vetor[6]; ?>">
                <?php echo $vetor[7]; ?>
            </option>
            <optgroup label="Escolha um novo eixo">
            <?php
            include_once '../class/Eixo.php';
            $eixo = new Eixo();
            $eixo->carregarSelect();
            ?>
        </select>
        <br><br>

        <input type="submit" name="btneditar" id="btneditar" 
               value="Editar Curso">
    </form>
    <?php
    if (isset($_POST['btneditar']) && !empty($_POST['txtnome'])) {
        

        echo "<script language='javascript'>
        window.location.href='?p=curso/consultar'
        </script>";
    }
}
?>
