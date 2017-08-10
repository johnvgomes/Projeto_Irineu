<?php
session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Arquivo.php';
    //include_once '../class/Controles.php';

    $a = new Arquivo();
    //$ct = new Controles();
    //havij
    $id = 1;//sempre 1, pq só atualiza o mesmo registro
    //passar o id e a table abaixo
    $vetor = $a->carregar($id,"manual_aluno");
    echo "<br>";
    //passar a table abaixo
    echo $a->consultar("manual_aluno");
    echo "<br><br>";
    ?>

    <table>
        <form method="post" 
              enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Trocar arquivo do Manual do Aluno (somente PDF)</h3>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Escolha o novo arquivo</label>
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
            $newnome = date("Ymdhis") . md5($arquivo);

            $a->editarArquivo($id, $newnome . $ext, $temporario, $vetor[1],
                    "../manual-aluno/","manual_aluno","arquivo");
            
        }



        echo "<script language='javaScript'>window.location.href='?p=manual-aluno/editar'</script>";
    }
}
?>

