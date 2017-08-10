<?php
header('Content-type: text/html; charset=utf-8');
require_once 'validaUser.php';

if(!(empty($nome_usuario) OR empty($senha_usuario))){

require_once '../class/Menu.php';
require_once '../class/Controles.php';
$co = new Controles();
$menu = new Menu();
$id = (int) $co->limparTexto($_GET['id']);
$array = $menu->carregarID($id);
?>

<form action="" method="post">
<table>
    <tr><td colspan="2"><h3>Formul&aacute;rio de Cadastro de Menu</h3></td></tr>
    <tr><td>Titulo:</td><td><input name="txttitulo" type="text" size="50" maxlength="70" value="<?php echo $array[1]; ?>" /></td></tr>
    <tr><td>Link:</td><td><input name="txtlink" type="text" size="50" maxlength="70" value="<?php echo $array[2]; ?>" /></td></tr>
    <tr><td>Destino:</td><td>			
    <select name="txtdestino">
            <option value="_self">_self</option>
            <option value="_blank">_blank</option>
    </select></td></tr>
    <tr><td>Tipo:</td><td>			
    <select name="txttipo">
            <option value="adm">Administrador</option>
            <option value="lim">Limitado</option>
    </select></td></tr>
    <tr><td>Ordem:</td><td><input name="txtordem" type="text" size="4" value="<?php echo $array[5]; ?>" /></td></tr>
    <tr><td>Categoria:</td><td>			
    <select name="txtcategoria">
            <option value="titulo">Titulo</option>
            <option value="comum">Comum</option>
    </select></td></tr>
    <tr><td>Eixo:</td><td>
    <select name="txteixo">  
        <?php      
            require_once '../class/Eixo.php';    
            $eixo = new Eixo();
            $eixo->carregarEixo();
        ?>
    </select>
    <tr><td colspan="2"><center><input type="submit" name="cadastrar" value="cadastrar" 
            id="botao"></center></td></tr>
    </table>
    </form>

<?php
if (isset($_POST['cadastrar'])){
    require_once '../class/Menu.php';
    @$menu = new Menu();
    @$menu->editar($id,$_POST['txttitulo'], $_POST['txtlink'], $_POST['txtdestino'], 
            $_POST['txttipo'], $_POST['txtordem'], $_POST['txtcategoria'], $_POST['txteixo']);
    echo "<h3>Atualizacao efetuada com sucesso!</h3>";
    header("Location:?p=menu/consultar.php");
}

}

?>