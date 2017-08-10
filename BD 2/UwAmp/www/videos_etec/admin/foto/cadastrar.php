<?php

//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Foto.php';
    $f = new Foto();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Foto</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Legenda:</label> <br />
                    <input name="txtlegenda" maxlength="50" type="text"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Foto(s):</label>    
                    <input type="file" name="imagem">    
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Foto">
                </td>
            </tr>
        </form>
    </table>

    <?php

    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtlegenda'])){

            extract($_POST, EXTR_OVERWRITE);

            include_once '../class/Controles.php';
            $ct = new Controles();

            $foto = $_FILES['imagem']['name'];
            $fototemp = $_FILES['imagem']['tmp_name'];

            $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
            $ext = strtolower(substr($foto, -4));

            if (in_array($ext, $extensoes)) {
                $newnome = date("Ymdhis") . md5($foto);

                $f->setLegenda(strtr(strtoupper($txtlegenda), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
                $f->setNome($newnome . $ext);
                $f->setTpnome($fototemp);
                $f->setUrl($ct->retirarAcentos(strtolower($txtlegenda)));

                $f->salvar();
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    echo "<br><br>  <h3> Para alterar qualquer foto, clique sobre a mesma</h3>";
    $f->consultarAdmin();
}//fecha a verifica��o do login
?>
