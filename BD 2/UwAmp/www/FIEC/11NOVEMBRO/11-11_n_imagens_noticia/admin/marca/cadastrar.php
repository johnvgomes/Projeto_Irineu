<?php
session_start();
if(!isset($_SESSION['sessao'])){
    echo "Sem acesso!";
}else{
    
?>
<form action="" method="post" id="form" name="formCadastro">
    <h3>Cadastro de Marca</h3>
    <br>
    <input type="text" name="txtnome" id="txtnome" 
           maxlength="70" size="50" placeholder="Informe a marca">
    <br>
    <select name="cbopais" id="cbopais">
        <option value="">País de Origem</option>
        <option value="Brasil">Brasil</option>
        <option value="Japão">Japão</option>
        <option value="Alemanha">Alemanha</option>
        <option value="EUA">EUA</option>
    </select>
    <br>
    
    <input type="number" name="txtano" id="txtano" maxlength="4" min="1800"
           max="2014" placeholder="Ano Fundação"><br>
    
    <input type="submit" name="btncad" id="btncad" value="Cadastrar">
</form>

<?php
//este cadastrar será aberto dentro do index.php do admin
if(isset($_POST['btncad'])){
    extract($_POST,EXTR_OVERWRITE);
    
    include_once '../class/Marca.php';
    
    $ma = new Marca();
    $ma->setNome(strtoupper($txtnome));
    $ma->setAno_fundacao($txtano);
    $ma->setPais_origem($cbopais);
    
    $ma->cadastrar();
}
}
?>

