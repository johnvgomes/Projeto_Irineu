<?php
if (isset($_SESSION['cliente'])) {

    include_once 'class/Clientes.php';
    include_once 'class/Controles.php';

    $cl = new Clientes();
    $co = new Controles();

    $id = (int) $co->limparTexto($_SESSION['clienteId']);

    $vetor = $cl->carregar($id);

    $txtNome = $vetor[1];
    $txtCpf = $vetor[3];
    $txtDtnasc = $vetor[4];
    $txtTelefone = $vetor[11];
    $txtCelular = $vetor[12];

    $txtCep = $vetor[10];
    $cmbEstado = $vetor[9];
    $txtCidade = $vetor[8];
    $txtBairro = $vetor[7];
    $txtEndereco = $vetor[5];
    $txtComp = $vetor[6];

    if (isset($_POST['sbmEditar'])) {

        extract($_POST, EXTR_OVERWRITE);

        $verifCpf = $cl->verifCpf($txtCpf);
        $verifDtnasc = $cl->verifDtnasc($txtDtnasc);
        $verifTelefone = $cl->verifTelefone($txtTelefone);
        $verifCep = $cl->verifCep($txtCep);

        if ((!empty($txtNome)) && (!$verifCpf) && (!$verifDtnasc) && (!$verifCep) && (!$verifTelefone)) {
            $cl->setNome($txtNome);
            $cl->setCpf($cl->expReg($txtCpf, 'cpf', false));
            $cl->setDtnasc($txtDtnasc);
            $cl->setEndereco($txtEndereco);
            $cl->setComplemento($txtComp);
            $cl->setBairro($txtBairro);
            $cl->setCidade($txtCidade);
            $cl->setEstado($cmbEstado);
            $cl->setCep($cl->expReg($txtCep, 'cep', false));
            $cl->setTelefone($cl->expReg($txtTelefone, 'tel', false));
            $cl->setCelular($cl->expReg($txtCelular, 'cel', false));
            $cl->setId($id);

            $cl->editar();
            $cl->editadoEmail($vetor[13]);

            echo '<meta http-equiv="refresh" 
            content="1;URL=' . URL::getBase() . 'minhaconta" />';
        }
    }
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <div id="minhaContaNav">
        <a href="<?php echo $url->getBase(); ?>minhaconta"><div id="minhaContaLink" class="imgLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>pedidos"><div id="meusPedidosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>favoritos"><div id="favoritosLink" class="imgLink offLink"></div></a>
        <a href="<?php echo $url->getBase(); ?>historico"><div id="historicoLink" class="imgLink offLink"></div></a>
        <hr />
    </div>

    <div id="meusDados" class="editarDados">
        <div id='hMinhaConta'><div></div><h1>Editar dados</h1></div>
        <div id="voltarConta"><a href="<?php echo $url->getBase(); ?>minhaconta">&laquo; Voltar</a></div>
        <form method="post" action="" name="frmEditarCliente">
            <h2>Dados pessoais</h2>
            <table>
                <tr>
                    <td class='tdNome'>Nome completo</td>
                    <td class='tdValor'><input type="text" name="txtNome" id="txtNome" value="<?php echo @$txtNome; ?>" maxlength="80" required /></td>
                </tr>
                <tr>
                    <td class='tdNome'>CPF</td>
                    <td class='tdValor'><input type="text" name="txtCpf" id="txtCpf" placeholder="___.___.___-__" value="<?php echo @$txtCpf; ?>" onfocus="excRemove('excCpf');" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo @$verifCpf; ?></td>
                </tr>
                <tr>
                    <td class='tdNome'>Data de Nascimento</td>
                    <td class='tdValor'><input type="date" name="txtDtnasc" id="txtDtnasc" value="<?php echo @$txtDtnasc; ?>" onfocus="excRemove('excDtnasc');" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo @$verifDtnasc; ?></td>
                </tr>
                <tr>
                    <td class='tdNome'>Telefone</td>
                    <td class='tdValor'><input type="text" name="txtTelefone" id="txtTelefone" placeholder="(xx) xxxx-xxxx" value="<?php echo @$txtTelefone; ?>" onfocus="excRemove('excTel');" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo @$verifTelefone; ?></td>
                </tr>
                <tr>
                    <td class='tdNome'>Celular (opcional)</td>
                    <td class='tdValor'><input type="text" name="txtCelular" id="txtCelular" placeholder="(xx) xxxxx-xxxx" value="<?php echo @$txtCelular; ?>" /></td>
                </tr>
            </table>
            <h2>Localização</h2>
            <table>
                <tr>
                    <td class='tdNome'>CEP</td>
                    <td class='tdValor'>
                        <input type="text" name="txtCep" id="txtCep" placeholder="__.___-___" value="<?php echo @$txtCep; ?>" onfocus="excRemove('excCep');" required />
                        <button type="button" id="btnLocal" onclick="localizar();">Localizar</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo @$verifCep; ?></td>
                </tr>
                <tr>
                    <td class='tdNome'>Estado</td>
                    <td class='tdValor'>
                        <select name="cmbEstado" id="<?php echo @$cmbEstado; ?>">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amap&aacute;</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Cear&aacute;</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Esp&iacute;rito Santo</option>
                            <option value="GO">Goi&aacute;s</option>
                            <option value="MA">Maranh&atilde;o</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Par&aacute;</option>
                            <option value="PB">Para&iacute;ba</option>
                            <option value="PR">Paran&aacute;</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piau&iacute;</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rond&ocirc;nia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">S&atilde;o Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='tdNome'>Cidade</td>
                    <td class='tdValor'><input type="text" name="txtCidade" id="txtCidade" value="<?php echo @$txtCidade; ?>" placeholder="Nome da Cidade" maxlength="80" required /></td>
                </tr>
                <tr>
                    <td class='tdNome'>Bairro</td>
                    <td class='tdValor'><input type="text" name="txtBairro" id="txtBairro" value="<?php echo @$txtBairro; ?>" placeholder="Nome do Bairro" maxlength="80" required /></td>
                </tr>
                <tr>
                    <td class='tdNome'>Endereço</td>
                    <td class='tdValor'><input type="text" name="txtEndereco" id="txtEndereco" value="<?php echo @$txtEndereco; ?>" placeholder="Nome da Rua, nº x" maxlength="80" required /></td>
                </tr>
                <tr>
                    <td class='tdNome'>Complemento (opcional)</td>
                    <td class='tdValor'><input type="text" name="txtComp" id="txtComp" value="<?php echo @$txtComp; ?>" maxlength="100" /></td>
                </tr>
            </table>
            <h2>Dados de Cadastro</h2>
            <table>
                <tr>
                    <td class='tdNome'>E-mail (inalterável)</td>
                    <td class='tdValor'><input type="email" name="txtEmail" id="txtEmail" value="<?php echo $vetor[13]; ?>" style="color: #666;" readonly /></td>
                </tr>
            </table>
            <input type="submit" id="sbmEditar" name="sbmEditar" value="Salvar alterações" />
        </form>
    </div>

    <script type="text/javascript">
        $('option[value="' + $('select').attr('id') + '"]').attr('selected', true);

        $(document).ready(function() {
            $("#txtCpf").mask("999.999.999-99");
            $("#txtCep").mask("99.999-999");
            $("#txtTelefone").mask("(99) 9999-9999");
            $("#txtCelular").mask("(99) 99999-9999");
        });
    </script>

    <?php
} else {
    include_once 'home.php';
    echo '<meta http-equiv="refresh" 
            content="1;URL=' . URL::getBase() . 'home" />';
}
?>