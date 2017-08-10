<?php
if ((isset($_POST['nomeNovoCad']) && isset($_POST['emailNovoCad'])) || isset($_POST['sbmCadastro'])) {

    include_once 'class/Clientes.php';
    $cl = new Clientes();

    @$txtNome = $_POST['nomeNovoCad'];
    @$txtEmail = $_POST['emailNovoCad'];
    ?>

    <div id="breadCrumb">
        <!--Insira seu breadCrumb aqui-->COLOCAR BREADCRUMB
    </div>

    <?php
    if ($cl->verifEmail(strtolower($txtEmail))) {
        echo "<div class='erro' id='excEmail'><div></div>E-mail já cadastrado!</div>";
    }

    if (isset($_POST['sbmCadastro'])) {
        extract($_POST, EXTR_OVERWRITE);

        if ($exist = $cl->verifEmail(strtolower($txtEmail))) {
            echo "<div class='erro' id='excEmail'><div></div>E-mail já cadastrado!</div>";
        }

        if ($txtSenha == $txtConfSenha) {
            if (!$exist) {
                $verifCpf = $cl->verifCpf($txtCpf);
                $verifDtnasc = $cl->verifDtnasc($txtDtnasc);
                $verifTelefone = $cl->verifTelefone($txtTelefone);
                $verifCep = $cl->verifCep($txtCep);

                if ((!empty($txtSenha)) && (!empty($txtEmail)) && (!empty($txtNome)) && (!$verifCpf) && (!$verifDtnasc) && (!$verifCep) && (!$verifTelefone)) {
                    $cl->setNome($txtNome);
                    $cl->setSenha($txtSenha);
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
                    $cl->setEmail(strtolower($txtEmail));

                    $cl->inserir();
                    $cl->cadastradoEmail();

                    echo '<meta http-equiv="refresh" 
            content="3;URL=' . URL::getBase() . 'minhaconta" />';
                }
            }
        } else {
            echo "<div class='erro' id='excSenha'><div></div>Senha não confirmada!</div>";
        }
    }
    ?>
    <div id="formCadastro">
        <form method="post" action="" name="frmCadastroCliente">
            <h1>Continue o cadastro abaixo:</h1>

            <fieldset id="dadosPessoais">
                <legend>Dados pessoais:</legend>

                <label>Nome completo</label>
                <input type="text" name="txtNome" id="txtNome" value="<?php echo $txtNome; ?>" maxlength="80" required />

                <label>CPF</label>
                <input type="text" name="txtCpf" id="txtCpf" placeholder="___.___.___-__" value="<?php echo @$txtCpf; ?>" onfocus="excRemove('excCpf');" required />

                <?php echo @$verifCpf; ?>

                <label>Data de nascimento</label>
                <input type="date" name="txtDtnasc" id="txtDtnasc" value="<?php echo @$txtDtnasc; ?>" onfocus="excRemove('excDtnasc');" required />

                <?php echo @$verifDtnasc; ?>

                <label>Telefone</label>
                <input type="text" name="txtTelefone" id="txtTelefone" placeholder="(xx) xxxx-xxxx" value="<?php echo @$txtTelefone; ?>" onfocus="excRemove('excTel');" required />

                <?php echo @$verifTelefone; ?>

                <label>Celular <span class="inputOpc">(opcional)</span></label>
                <input type="text" name="txtCelular" id="txtCelular" placeholder="(xx) xxxxx-xxxx" value="<?php echo @$txtCelular; ?>" />
            </fieldset>

            <fieldset id="localizacao">
                <legend>Localização:</legend>

                <label>CEP</label>
                <input type="text" name="txtCep" id="txtCep" placeholder="__.___-___" value="<?php echo @$txtCep; ?>" onfocus="excRemove('excCep');" required />
                <button type="button" id="btnLocal" onclick="localizar();">Localizar</button>

                <?php echo @$verifCep; ?>

                <label>Estado</label>
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

                <label>Cidade</label>
                <input type="text" name="txtCidade" id="txtCidade" value="<?php echo @$txtCidade; ?>" placeholder="Nome da Cidade" maxlength="80" required />

                <label>Bairro</label>
                <input type="text" name="txtBairro" id="txtBairro" value="<?php echo @$txtBairro; ?>" placeholder="Nome do Bairro" maxlength="80" required />

                <label>Endereço</label>
                <input type="text" name="txtEndereco" id="txtEndereco" value="<?php echo @$txtEndereco; ?>" placeholder="Nome da Rua, nº x" maxlength="80" required />

                <label>Complemento <span class="inputOpc">(opcional)</span></label>
                <input type="text" name="txtComp" id="txtComp" value="<?php echo @$txtComp; ?>" maxlength="100" />

            </fieldset>



            <fieldset id="dadosLogin">
                <legend>Dados para Login:</legend>
                <label>E-mail</label>
                <input type="email" name="txtEmail" id="txtEmail" value="<?php echo $txtEmail; ?>" maxlength="100" required />

                <label>Senha</label>
                <input type="password" name="txtSenha" id="txtSenha" maxlength="25" required />

                <label>Confirmar senha</label>
                <input type="password" name="txtConfSenha" id="txtConfSenha" maxlength="25" required />
            </fieldset>

            <input type="submit" id="sbmCadastro" name="sbmCadastro" value="Cadastrar" />
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