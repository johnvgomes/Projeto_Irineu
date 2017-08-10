<?php
session_start();
if(!isset($_SESSION['sessao'])){
    echo 'Sem acesso!';
}else{

    include_once '../class/Calendario.php';
    include_once '../class/Controles.php';
    
    $c = new Calendario();
    $ct = new Controles();
    //havij
    $id = (int) $ct->limparTexto($_GET['id']);
    $vetor = $c->carregar($id);
    
?>

<table>
    <form method="post" 
          enctype="multipart/form-data">
        <tr>
            <td>
                <h3>Editar Calendário/Arquivo</h3>
            </td>
        </tr>
        <tr>
            <td>
                Unidade: <?php echo $vetor[5]; ?> - 
                Ano: <?php echo $vetor[2]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Escolha outro arquivo</label>
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
if(isset($_POST['btnenviar'])){
   $arquivo = $_FILES['arquivo']['name'];
   $temporario = $_FILES['arquivo']['tmp_name'];
   
   $c->editarArquivo($id, $arquivo, $temporario, 
           $vetor[3]);
   
   echo "<script language='javaScript'>window.location.href='?p=calendario/consultar'</script>";
}

} 
?>

