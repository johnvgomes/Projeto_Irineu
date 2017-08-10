<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/TCC.php';
    include_once '../class/Controles.php';
    $t = new TCC();
    $co = new Controles();

    $id = (int) $co->limparTexto($_GET['id']);
    $vetor = $t->carregar($id);

    include_once '../class/Curso.php';
    $c = new Curso();
    ?>
    <table>
        <form method="post">
            <tr>
                <td>
                    <h3>Editar TCC</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Curso:</label>
                    <select name="cbocurso">
                        <optgroup label="Curso atual" />
                        //aqui carrega o atual
                        <option value="<?php echo $vetor[7]; ?>">
                            <?php echo $vetor[9]; ?>
                        </option>
                        //aqui carregam todos
                        <optgroup label="Escolha uma nova opção" />
                        <?php $c->carregarSelect(); ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Título:</label>
                    <input name="txttitulo" type="text" 
                           maxlength="120" value="<?php echo $vetor[2]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Descrição:</label>
                    <textarea name="txtdescricao" rows="3">
                        <?php echo $vetor[4]; ?>
                    </textarea>
                </td>
            </tr>   
            <tr>
                <td>
                    <label>Ano:</label>
                    <input name="txtano" type="number" min="2014" max="3000"
                           value="<?php echo $vetor[5]; ?>"> 
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Editar Calendário">
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btn'])) {
        extract($_POST, EXTR_OVERWRITE);

        $t->setId($id);
        $t->setId_curso($cbocurso);
        $t->setAno($txtano);
        $t->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
        $t->setUrl($ct->retirarAcentos(strtolower($txttitulo)));
        $t->setDescricao($txtdescricao);
        
        $t->editar();

        echo "<script language='javaScript'>window.location.href='?p=tcc/consultar'</script>";
    }
}
?>