<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/TCC.php';
    include_once '../class/Controles.php';

    $t = new TCC();
    $ct = new Controles();
    //havij
    $id = (int) $ct->limparTexto($_GET['id']);
    $vetor = $t->carregar($id);
    ?>

    <table>
        <form method="post" 
              enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Editar TCC/Arquivo</h3>
                </td>
            </tr>
            <tr>
                <td>
                    Curso: <?php echo $vetor[9]; ?> - 
                    Ano: <?php echo $vetor[5]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Escolha outro arquivo pdf</label>
                    <input type="file" name="arquivo" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Editar"
                           name="btnenviar" />
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btnenviar'])) {
        $arquivo = $_FILES['arquivo']['name'];
        $temporario = $_FILES['arquivo']['tmp_name'];

        $extensoes = array(".pdf");
        $ext = strtolower(substr($arquivo, -4));

        if (in_array($ext, $extensoes)) {
            //alterando o nome da imagem com md5
            $novonome = date("Ymdhis") . md5($arquivo) . $ext;
        }

        $c->editarArquivo($id, $novonome, $temporario, $vetor[6]);

        echo "<script language='javaScript'>window.location.href='?p=tcc/consultar'</script>";
    }
}
?>

