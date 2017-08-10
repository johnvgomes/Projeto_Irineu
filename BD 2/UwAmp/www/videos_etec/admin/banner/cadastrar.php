<?php

//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {
    include_once '../class/Banner.php';
    $b = new Banner();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Banner</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Título:</label> <br>
                    <input name="txttitulo" maxlength="100" type="text"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Banner:</label>   <br> 
                    <input type="file" name="banner">    
                </td>
            </tr>
            <tr>
                <td>
                    <label>Link:</label> <br>
                    <input name="txtlink" maxlength="100" type="text"> 
                </td>
            </tr>
            <tr>
                <td>
                    <label>Destino:</label> <br>
                    <select name="cbodestino">
                        <option value="_self" selected>SELF</option>
                        <option value="_blank">BLANK</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" id="cadastrar" value="Cadastrar Banner">
                </td>
            </tr>
        </form>
    </table>

    <?php

    if (isset($_POST['btn'])) {
        if (!empty($_POST['txttitulo'])) {

            extract($_POST, EXTR_OVERWRITE);



            $banner = $_FILES['banner']['name'];
            $bannertemp = $_FILES['banner']['tmp_name'];

            $extensoes = array(".gif", ".jpeg", ".jpg", ".png", ".bmp");
            $ext = strtolower(substr($banner, -4));

            if (in_array($ext, $extensoes)) {
                $newnome = date("Ymdhis") . md5($banner);

                $b->setTitulo(strtr(strtoupper($txttitulo), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"));
                $b->setImagem($newnome . $ext);
                $b->setTpimagem($bannertemp);
                $b->setLink($txtlink);
                $b->setDestino($cbodestino);

                $b->salvar();
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    echo "<br><br>  <h3> Para alterar qualquer banner, clique sobre o mesmo</h3>";
    $b->consultarAdmin();
}//fecha a verifica��o do login
?>
