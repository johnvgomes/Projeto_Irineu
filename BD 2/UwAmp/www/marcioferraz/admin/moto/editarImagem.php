<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Moto.php';
    include_once '../class/Controles.php';

    $m = new Moto();
    $ct = new Controles();

    $id = (int) $ct->limparTexto($_GET['id']);
    $vetor = $m->carregar($id);
    ?>
    <table>
        <form method="post" enctype="multipart/form-data">
            <tr><td><h3>Editar Imagem da Moto</h3></td></tr>
            <tr>
                <td>
                    <img src="../imagem_moto/<?php echo $vetor[5]; ?>"
                         width="100px" />
                         <?php echo $vetor[5]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Placa: <?php echo $vetor[1]; ?> - 
                    Modelo: <?php echo $vetor[2]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Escolha outra imagem</label>
                    <input type="file" name="imagem" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Editar" name="btneditar" />
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btneditar'])) {
        $novo = $_FILES['imagem']['name'];
        $temporario = $_FILES['imagem']['tmp_name'];

        $m->editarArquivo($id, $novo, $temporario, $vetor[5]);

        header('Location:?p=moto/consultar');
    }//fim if
}//fim verificação login
?>