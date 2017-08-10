<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Foto.php';
    include_once '../class/Controles.php';

    $f = new Foto();
    $ct = new Controles();
    //havij
    $id = (int) $ct->limparTexto($_GET['id']);
    $vetor = $f->carregar($id);
    ?>

    <table>
        <form method="post" 
              enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Editar Foto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    Foto: <?php echo $vetor[3]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Escolha outra foto</label>
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

        $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
        $ext = strtolower(substr($arquivo, -4));

        if (in_array($ext, $extensoes)) {
            $newnome = date("Ymdhis") . md5($arquivo);

            $f->editarFoto($id, $newnome . $ext, $temporario, $vetor[1]);
            
        }



        echo "<script language='javaScript'>window.location.href='?p=foto/cadastrar'</script>";
    }
}
?>

