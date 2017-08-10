<?php
session_start();
?>
<form method="post" action="" name="frmcep">
    <label>Cep:</label>
    <input type="text" maxlength="8" 
           id="cep" name="txtcep" 
           placeholder="Digite o CEP" />
    <input type="submit" id="getEndereco" 
           value="Pesquisar CEP" name="btnCep"/><br/>

    <?php
    if (isset($_POST['btnCep'])) {
        require_once "class/Correios.php";
        $c = new Correios;
        $c->retornaInformacoesCep(@$_POST['txtcep']);
    ?>
    
    <label>Logradouro:</label>
    <input type="text" readonly="readonly" name="txtlog" id="log"
    value="<?php echo @$c->informacoesCorreios->getLogradouro(); ?>" />
    <br/> 
    <?php $_SESSION['log'] = @$c->informacoesCorreios->getLogradouro(); ?>

    <label>Bairro:</label>
    <input type="text" readonly="readonly" id="bairro" name="txtbairro"
        value="<?php echo @$c->informacoesCorreios->getBairro(); ?>" />
    <br/>
    <?php $_SESSION['b'] = @$c->informacoesCorreios->getBairro(); ?>
    
    <label>Localidade:</label>
    <input type="text" readonly="readonly" id="localidade" name="txtlocal"
    value="<?php echo @$c->informacoesCorreios->getLocalidade(); ?>" />
    <br/>
    <?php $_SESSION['loc'] = @$c->informacoesCorreios->getLocalidade(); ?>
        
    <label>UF:</label>
    <input type="text" readonly="readonly" id="uf" name="txtuf"
        value="<?php echo @$c->informacoesCorreios->getUf(); ?>" />
    <br/>
    <?php $_SESSION['uf'] = @$c->informacoesCorreios->getUf(); ?>
    <?php $_SESSION['cep'] = @$c->informacoesCorreios->getCep(); ?>
    
    <?php
    }
    ?>
    
    Numero: <input type="number" name="txtnum" /><br/>
    Nome: <input type="text" name="txtnome" /><br/>
    Email: <input type="email" name="txtemail" /><br/>
    <input name="btnCadastrar" type="submit" id="cadastrar" />
</form>

<?php
if (isset($_POST['btnCadastrar'])) {
    extract($_POST, EXTR_OVERWRITE);

    echo
    "Nome: " . $txtnome ."<br />".
    "Email: " . $txtemail ."<br />".
    "Logradouro: " . $_SESSION['log'] ."<br />".
    "Numero: " . $txtnum ."<br />".        
    "Bairro: " . $_SESSION['b'] ."<br />".
    "Localidade: " . $_SESSION['loc'] ."<br />".
    "UF: " . $_SESSION['uf'] ."<br />".
    "CEP: " . $_SESSION['cep'];
}
?>
