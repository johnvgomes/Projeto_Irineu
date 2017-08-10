<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo "Sem acesso!";
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
        <tr>
            <td><h3>Editar Foto de Moto</h3></td>
        </tr>
        <tr>
            <td>
                <img src="../imagem_moto/<?php echo $vetor[3]; ?>"
                     width="100px" alt="<?php echo $vetor[3]; ?>">
                
            </td>
        </tr>
        <tr>
            <td>
                <strong>Marca: <?php echo $vetor[7]; ?>
                    - Modelo: <?php echo $vetor[1]; ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                <label>Escolha a nova foto:</label>
                <input type="file" name="arqfoto">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="btn" id="btn"
                       value="Alterar foto">
            </td>
        </tr>
    </form>
</table>


<?php

    if(isset($_POST['btn'])){
        $foto = $_FILES['arqfoto']['name'];
        $tpfoto = $_FILES['arqfoto']['tmp_name'];
        
        $m->editarFoto($id, $foto, $tpfoto, $vetor[3]);
        
        echo "<script language='javaScript'>window.location.href='?p=moto/consultar'</script>";
        
    }

}
// admin/moto/editarFoto.php
?>