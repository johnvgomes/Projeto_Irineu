
<form name="frmlogin" method="post" action="">
  <table width="200" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2">Efetuar login - ETEC Itu</td>
    </tr>
    <tr>
      <td>Usu&aacute;rio</td>
      <td><label>
        <input name="user" type="text" id="user" size="10" maxlength="20">
      </label></td>
    </tr>
    <tr>
      <td >Senha</td>
      <td><label>
        <input name="senha" type="password" id="senha" size="10" maxlength="10">
      </label></td>
    </tr>
    <tr>
        <td colspan="2">
            <input name="enviar" type="submit" id="Enviar" value="enviar">
        </td>
    </tr>
  </table>
</form>

<?php
if(isset($_POST['enviar'])){
    require_once '../class/Conectar.php';
    $con = new Conectar();

    $user = $_POST['user'];
    $senha = $_POST['senha'];
    $sql = $con->executar("SELECT * FROM login WHERE usuario = '$user'"); 
    $linhas = mysql_fetch_row($sql);

    if ($linhas == 0) { 
        echo "Usu&aacute;rio n&atilde;o encontrado!";
        echo "<a href=index.php target=_self>Voltar</a>";
        }else{
            if($senha != mysql_result($sql, 0, "senha")){
                echo "Senha incorreta!";
                echo "<a href=index.php target=_self>Voltar</a>";
                }else {
                        session_start();
                        $_SESSION['nome_usuario'] = $user;
                        $_SESSION['senha_usuario'] = $senha;
                        header ("Location: adm.php");
                }
    }
}
?>