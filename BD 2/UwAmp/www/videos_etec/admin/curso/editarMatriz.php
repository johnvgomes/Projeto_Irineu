<?php
session_start();
if(!isset($_SESSION['sessao'])){
    echo 'Sem acesso!';
}else{

    include_once '../class/Curso.php';
    include_once '../class/Controles.php';
    
    $c = new Curso();
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
                <h3>Editar Matriz Curricular de Curso</h3>
            </td>
        </tr>
        <tr>
            <td>
                Curso: <?php echo $vetor[2]; ?> | 
                Eixo Tecnológico: <?php echo $vetor[7]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>Escolha outra Matriz Curricular de Curso</label>
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
           $vetor[5],"matriz");
   
   echo "<script language='javaScript'>window.location.href='?p=curso/consultar'</script>";
}

} 
?>

