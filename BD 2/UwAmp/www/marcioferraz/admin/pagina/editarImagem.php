<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Pagina.php';
    include_once '../class/Controles.php';

    $p = new Pagina();
    $ct = new Controles();

    $id = (int) $ct->limparTexto($_GET['id']);
    $vetor = $p->carregar($id);
    ?>
    <table>
        <form method="post" enctype="multipart/form-data">
            <tr><td><h3>Editar Imagem da Pagina</h3></td></tr>
            <tr>
                <td>
                    <img src="../imagem_pagina/<?php echo $vetor[5]; ?>"
                         width="100px" />
                         <?php echo $vetor[5]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    URL: <?php echo $vetor[1]; ?> - 
                    Titulo: <?php echo $vetor[2]; ?>
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
                    <input type="submit" value="Trocar imagem" name="btneditar" />
                </td>
            </tr>
        </form>
    </table>
    <?php
    if (isset($_POST['btneditar'])) {
        $novo = $_FILES['imagem']['name'];
        $temporario = $_FILES['imagem']['tmp_name'];

        $p->editarImagem($id, $novo, $temporario, $vetor[5]);

        header('Location:?p=pagina/consultar');
        echo '<meta http-equiv="refresh" content="1;URL=?p=pagina/consultar">';
    }//fim if
}//fim verificação login
?>