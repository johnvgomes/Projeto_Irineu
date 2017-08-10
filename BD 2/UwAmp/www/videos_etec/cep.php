<?php
@session_start();
?>

<link href="<?php echo $url->getBase(); ?>css/cep.css" rel="stylesheet" type="text/css" >
<form method="post" action="" name="frmcep">
    <label>Cep:</label>
    <input type="text" maxlength="8" 
           id="cep" name="txtcep" 
           placeholder="Digite o CEP" >
    <input type="submit" id="getEndereco" 
           value="" name="btnCep"/><br/>

    <?php
    if (isset($_POST['btnCep'])) {
        require_once "class/Correios.php";
        $c = new Correios;
        $c->retornaInformacoesCep(@$_POST['txtcep']);

        $cep = $_POST['txtcep'];
        ?>

        <label>Logradouro:</label>
        <input type="text" readonly="readonly" name="txtlog" id="log" size="60"
               value="<?php echo utf8_encode(@$c->informacoesCorreios->getLogradouro()); ?>" />
        <br>
        <?php $_SESSION['log'] = utf8_encode(@$c->informacoesCorreios->getLogradouro()); ?>

        <label>Bairro:</label> 
        <input type="text" readonly="readonly" id="bairro" name="txtbairro"
               value="<?php echo utf8_encode(@$c->informacoesCorreios->getBairro()); ?>" />

        <?php $_SESSION['b'] = utf8_encode(@$c->informacoesCorreios->getBairro()); ?>

        <label>Localidade:</label>
        <input type="text" readonly="readonly" id="localidade" name="txtlocal"
               value="<?php echo utf8_encode(@$c->informacoesCorreios->getLocalidade()); ?>" />
        <br/>
        <?php $_SESSION['loc'] = utf8_encode(@$c->informacoesCorreios->getLocalidade()); ?>

        <label>UF:</label>
        <input type="text" readonly="readonly" id="uf" name="txtuf" size="2"
               value="<?php echo utf8_encode(@$c->informacoesCorreios->getUf()); ?>" />
        <br/>
        <?php $_SESSION['uf'] = utf8_encode(@$c->informacoesCorreios->getUf()); ?>
        <?php $_SESSION['cep'] = utf8_encode(@$c->informacoesCorreios->getCep()); ?>

        <?php
    }
    ?>

    Numero: <input type="number" name="txtnum" /><br/>
    Nome: <input type="text" name="txtnome" /><br/>
    Email: <input type="email" name="txtemail" /><br/>
    <input name="btncadastrar" type="submit" id="cadastrar" />
</form>

<?php
include_once 'class/gMaps.php';
// Instancia a classe
$gmaps = new gMaps();

// Pega os dados (latitude, longitude e zoom) do endereço:
$endereco = 'Av. Brasil, 1453, Rio de Janeiro, RJ';
$dados = $gmaps->geolocal($endereco);

// Exibe os dados encontrados:
print_r($dados);
?>
