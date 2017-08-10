<?php
//cadastrar.php dentro da pasta adm/moto

session_start();
if (!isset($_SESSION['sessao'])) {
    echo 'Sem acesso!';
} else {

    include_once '../class/Marca.php';
    $m = new Marca();
    ?>

    <table>
        <form method="post" enctype="multipart/form-data">
            <tr>
                <td>
                    <h3>Cadastro de Motos</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Placa:</label>
                    <input name="txtplaca" type="text" 
                           maxlength="8" size="50" 
                           pattern="[A-Za-z0-9]{7}" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Modelo:</label>
                    <input name="txtmodelo" type="text" 
                           maxlength="100" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Cilindradas:</label>
                    <input name="txtcc" type="text" 
                           maxlength="4" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Renavam:</label>
                    <input name="txtrenavam" type="text" 
                           maxlength="11" size="50" 
                           pattern="[0-9]{11}" />
                </td>
            </tr>	
            <tr>
                <td>
                    <label>Foto:</label>
                    <input name="arqfoto" type="file" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Valor:</label>
                    <input name="txtvalor" type="text" 
                           maxlength="13" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Estoque:</label>
                    <input name="txtestoque" type="text" 
                           maxlength="1" size="50" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Marca:</label>
                    <select name="cbomarca">
                        <option>Escolha uma marca</option>
                        <?php
                        $m->carregarCombo();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input name="btn" type="submit" 
                           value="Cadastrar" />
                </td>
            </tr>
        </form>
    </table>

    <?php
    if (isset($_POST['btn'])) {
        if (!empty($_POST['txtplaca']) && !empty($_POST['txtmodelo'])) {

            extract($_POST, EXTR_OVERWRITE);

            $foto = $_FILES['arqfoto']['name'];
            $fototemp = $_FILES['arqfoto']['tmp_name'];

            include_once '../class/Moto.php';
            $mt = new Moto();
            $mt->setPlaca($txtplaca);
            $mt->setModelo($txtmodelo);
            $mt->setCc($txtcc);
            $mt->setRenavam($txtrenavam);

            $mt->setFoto($foto);
            $mt->setTpfoto($fototemp);

            $mt->setValor($txtvalor);
            $mt->setEstoque($txtestoque);
            $mt->setId_marca($cbomarca);

            $mt->salvar();
        } else {
            echo "Preencha todos os campos!";
        }
    }
}//fecha a verifica��o do login
?>
















