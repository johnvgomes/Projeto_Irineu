<?php

include_once 'Conectar.php';

class Clientes {

    private $id;
    private $nome;
    private $senha;
    private $cpf;
    private $dtnasc;
    private $complemento;
    private $endereco;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $telefone;
    private $celular;
    private $email;
    private $con;

    public function __construct($id = "", $nome = "", $senha = "", $cpf = "", $dtnasc = "", $complemento = "", $endereco = "", $bairro = "", $cidade = "", $estado = "", $cep = "", $telefone = "", $celular = "", $email = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->cpf = $cpf;
        $this->dtnasc = $dtnasc;
        $this->complemento = $complemento;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->email = $email;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getDtnasc() {
        return $this->dtnasc;
    }

    public function setDtnasc($dtnasc) {
        $this->dtnasc = $dtnasc;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM clientes as cl "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM clientes as cl "
                    . "UNION ALL "
                    . "SELECT MAX(cl.id) FROM clientes as cl";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Clientes</td>";

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<td>$linhas[0]</td>";
            }
            echo "</tr>";
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function inserir() {
        try {
            $sql = "INSERT INTO clientes VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getCpf(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getDtnasc(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getEndereco(), PDO::PARAM_STR);
            $sqlprep->bindParam(6, $this->getComplemento(), PDO::PARAM_STR);
            $sqlprep->bindParam(7, $this->getBairro(), PDO::PARAM_STR);
            $sqlprep->bindParam(8, $this->getCidade(), PDO::PARAM_STR);
            $sqlprep->bindParam(9, $this->getEstado(), PDO::PARAM_STR);
            $sqlprep->bindParam(10, $this->getCep(), PDO::PARAM_STR);
            $sqlprep->bindParam(11, $this->getTelefone(), PDO::PARAM_STR);
            $sqlprep->bindParam(12, $this->getCelular(), PDO::PARAM_STR);
            $sqlprep->bindParam(13, $this->getEmail(), PDO::PARAM_STR);

            if ($sqlprep->execute()) {
                $_SESSION['cliente'] = sha1(time());
                $_SESSION['clienteId'] = $this->con->lastInsertId();
                $_SESSION['clienteNome'] = $this->getNome();

                echo "<div class='sucesso'><div></div> Seu cadastro foi conclu&iacute;do com sucesso. Bem-vindo!</div>";
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastradoEmail() {
        try {
            $remetente = 'buyon-commerce@outlook.com';
            $para = $this->getEmail();
            $assunto = $this->getNome() . ' cadastrado(a) com sucesso! - BuyOn';
            $msg = "Mensagem enviada em: " . date("d/m/Y") .
                    "Seu cadastro foi concluído com sucesso! <br /> " .
                    "<br /><br /><br />"
                    . "Acesse BuyOn com as informações abaixo: <br />" .
                    "E-mail: " . $this->getEmail() . "<br />" .
                    "Senha: " . $this->getSenha() . "<br />" .
                    "Nós agradecemos a preferência! <br />"
                    . "<br /><br /><br />Favor não responder este e-mail.";

            $headers = "MIME-Version 1.1\n";
            $headers .= "Content-type: text/html; charset=utf-8\n";
            $headers .= "From:$remetente\n";
            $headers .= "Return-Path: $remetente\n";
            $headers .= "Reply-To: $remetente";

            $envio = mail($para, $assunto, $msg, $headers, "-f$remetente");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY cl.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT cl.* FROM clientes as cl $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo utf8_decode("
                <tr id=$linhas[0]>
                    <td>$linhas[0]</td>
                    <td>$linhas[1]</td>
                    <td>" . $this->expReg($linhas[3], 'cpf', true) . "</td>
                    <td>" . date("d/m/Y", strtotime($linhas[4])) . "</td>
                    <td>" . $this->expReg($linhas[11], 'tel', true) . "</td>
                    <td>" . $this->expReg($linhas[12], 'cel', true) . "</td>
                    <td>$linhas[13]</td>
                    <td class='infoImg clickable' onclick='exibirEndereco(" . $linhas[0] . ");'>
                        <img src='../img/exibir.png' width='25' height='25' alt='Exibir localiza&ccedil;&atilde;o' />
                    </td>
                </tr>");
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT * FROM clientes WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linha;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE clientes SET nome=?, cpf=?, dtnasc=?, "
                    . "endereco=?, complemento=?, bairro=?, cidade=?, estado=?, cep=?, "
                    . "telefone=?, celular=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getCpf(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getDtnasc(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getEndereco(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getComplemento(), PDO::PARAM_STR);
            $sqlprep->bindParam(6, $this->getBairro(), PDO::PARAM_STR);
            $sqlprep->bindParam(7, $this->getCidade(), PDO::PARAM_STR);
            $sqlprep->bindParam(8, $this->getEstado(), PDO::PARAM_STR);
            $sqlprep->bindParam(9, $this->getCep(), PDO::PARAM_STR);
            $sqlprep->bindParam(10, $this->getTelefone(), PDO::PARAM_STR);
            $sqlprep->bindParam(11, $this->getCelular(), PDO::PARAM_STR);
            $sqlprep->bindParam(12, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Alterado com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editadoEmail($e) {
        try {
            $remetente = 'buyon-commerce@outlook.com';
            $para = $e;
            $assunto = 'Seus dados foram alterados com sucesso! - BuyOn';
            $msg = "Mensagem enviada em: " . date("d/m/Y") .
                    "A alteração dos dados foi concluída com sucesso! <br /> " .
                    "<br /><br /><br />" .
                    "Nós agradecemos a preferência! <br />"
                    . "<br /><br /><br />Favor não responder este e-mail.";

            $headers = "MIME-Version 1.1\n";
            $headers .= "Content-type: text/html; charset=utf-8\n";
            $headers .= "From:$remetente\n";
            $headers .= "Return-Path: $remetente\n";
            $headers .= "Reply-To: $remetente";

            $envio = mail($para, $assunto, $msg, $headers, "-f$remetente");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function trocarSenha() {
        try {
            $sql = "UPDATE clientes SET senha=? WHERE id=?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo '<div id="respostaTroca">Alterada com sucesso!</div>';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function trocadoEmail($e) {
        try {
            $remetente = 'buyon-commerce@outlook.com';
            $para = $e;
            $assunto = 'Senha alterada com sucesso! - BuyOn';
            $msg = "Mensagem enviada em: " . date("d/m/Y") .
                    "A alteração da senha foi concluída com sucesso! <br /> " .
                    "<br /><br /><br />"
                    . "Acesse BuyOn com as informações abaixo: <br />" .
                    "E-mail: " . $this->getEmail() . "<br />" .
                    "Senha: " . $this->getSenha() . "<br />" .
                    "Nós agradecemos a preferência! <br />"
                    . "<br /><br /><br />Favor não responder este e-mail.";

            $headers = "MIME-Version 1.1\n";
            $headers .= "Content-type: text/html; charset=utf-8\n";
            $headers .= "From:$remetente\n";
            $headers .= "Return-Path: $remetente\n";
            $headers .= "Reply-To: $remetente";

            $envio = mail($para, $assunto, $msg, $headers, "-f$remetente");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM clientes WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo '<div id="respostaExcluir">Adeus...</div>';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluidoEmail($e) {
        try {
            $remetente = 'buyon-commerce@outlook.com';
            $para = $e;
            $assunto = 'A exclusão da conta foi concluída com sucesso! - BuyOn';
            $msg = "Mensagem enviada em: " . date("d/m/Y") .
                    "Obrigado por ter apoiado o BuyOn!<br /> " .
                    "<br /><br /><br />" .
                    "Nós agradecemos a preferência... <br />";

            $headers = "MIME-Version 1.1\n";
            $headers .= "Content-type: text/html; charset=utf-8\n";
            $headers .= "From:$remetente\n";
            $headers .= "Return-Path: $remetente\n";
            $headers .= "Reply-To: $remetente";

            $envio = mail($para, $assunto, $msg, $headers, "-f$remetente");
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function expReg($valor, $tipo, $sent) {
        if ($sent) {
            $valor_array = str_split($valor);
            $nvalor = '';

            if ($tipo == 'cpf') {
                for ($i = 0; $i < count($valor_array); $i++) {
                    $nvalor .= $valor_array[$i];

                    switch ($i) {
                        case 2:
                        case 5:
                            $nvalor .= '.';
                            break;
                        case 8:
                            $nvalor .= '-';
                            break;
                    }
                }

                return $nvalor;
            } else if ($tipo == 'cep') {
                for ($i = 0; $i < count($valor_array); $i++) {
                    $nvalor .= $valor_array[$i];

                    switch ($i) {
                        case 1:
                            $nvalor .= '.';
                            break;
                        case 4:
                            $nvalor .= '-';
                            break;
                    }
                }

                return $nvalor;
            } else if ($tipo == 'tel') {
                $nvalor = '(';

                for ($i = 0; $i < count($valor_array); $i++) {
                    $nvalor .= $valor_array[$i];

                    switch ($i) {
                        case 1:
                            $nvalor .= ') ';
                            break;
                        case 5:
                            $nvalor .= '-';
                            break;
                    }
                }

                return $nvalor;
            } else if ($tipo = 'cel') {
                $nvalor = '(';

                for ($i = 0; $i < count($valor_array); $i++) {
                    $nvalor .= $valor_array[$i];

                    switch ($i) {
                        case 1:
                            $nvalor .= ') ';
                            break;
                        case 6:
                            $nvalor .= '-';
                            break;
                    }
                }

                return $nvalor;
            }
        } else {
            $chars = array(".", "-", "(", ")", " ");
            return str_replace($chars, "", $valor);
        }
    }

    public function exibirEndereco($id) {
        try {
            $sql = "SELECT * FROM clientes WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "/^endereco=$linha[5]$/
                    &/^complemento=$linha[6]$/
                    &/^bairro=$linha[7]$/
                    &/^cidade=$linha[8]$/
                    &/^estado=$linha[9]$/
                    &/^cep=" . $this->expReg($linha[10], 'cep', true) . "$/";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 17; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function quantPg($busca) {
        $numreg = 50;

        if (empty($busca)) {
            $busca = '';
        } else if (strpos($busca, 'LIKE') !== false) {
            $busca = 'WHERE ' . $busca;
        }

        @$res = $this->con->query("SELECT COUNT(*)
                FROM clientes as cl $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function verifEmail($e) {
        try {
            $sql = "SELECT * FROM clientes WHERE email=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $e, PDO::PARAM_STR);
            $sqlprep->execute();

            $num = $sqlprep->rowCount();

            if ($num > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function verifCpf($cpf) {
        $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            return "<div class='aviso' id='excCpf'><div></div>Número de CPF inválido!</div>";
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return "<div class='aviso' id='excCpf'><div></div>Número CPF inválido!</div>";
                }
            }

            return false;
        }
    }

    public function verifDtnasc($nasc) {
        $nasc_array = explode("-", $nasc);

        $ano = $nasc_array[0];
        $mes = $nasc_array[1];
        $dia = $nasc_array[2];

        if (!checkdate($mes, $dia, $ano) || $ano < 1900 || mktime(0, 0, 0, $mes, $dia, $ano) > time()) {
            return "<div class='aviso' id='excDtnasc'><div></div>Data de nascimento inválida!</div>";
        }

        return false;
    }

    public function verifTelefone($tel) {
        if (!ereg("^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$", $tel)) {
            return "<div class='aviso' id='excTel'><div></div>Número de telefone inválido!</div>";
        }

        return false;
    }

    public function verifCep($cep) {
        $cep = trim($cep);
        $avaliaCep = ereg("^[0-9]{2}\.[0-9]{3}-[0-9]{3}$", $cep);

        if (!$avaliaCep) {
            return "<div class='aviso' id='excCep'><div></div>Número CEP inválido!</div>";
        } else {
            return false;
        }
    }

    public function minhaConta($id) {
        try {
            $sql = "SELECT * FROM clientes WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {

                if (empty($linha[12])) {
                    $linha[12] = "&nbsp;";
                } else {
                    $linha[12] = $this->expReg($linha[12], 'cel', true);
                }

                if (empty($linha[6])) {
                    $linhas[6] = "&nbsp;";
                }

                echo "<h2>Dados pessoais</h2>
                     <table>
                        <tr>
                            <td class='tdNome'>Nome completo</td>
                            <td class='tdValor'>$linha[1]</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>CPF</td>
                            <td class='tdValor'>" . $this->expReg($linha[3], 'cpf', true) . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Data de Nascimento</td>
                            <td class='tdValor'>" . @date("d/m/Y", strtotime($linha[4])) . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Telefone</td>
                            <td class='tdValor'>" . $this->expReg($linha[11], 'tel', true) . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Celular</td>
                            <td class='tdValor'>" . $linha[12] . "</td>
                        </tr>
                     </table>
                     <h2>Localização</h2>
                     <table>
                        <tr>
                            <td class='tdNome'>CEP</td>
                            <td class='tdValor'>" . $this->expReg($linha[10], 'cep', true) . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Estado</td>
                            <td class='tdValor'>" . $linha[9] . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Cidade</td>
                            <td class='tdValor'>" . $linha[8] . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Bairro</td>
                            <td class='tdValor'>" . $linha[7] . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Endereço</td>
                            <td class='tdValor'>" . $linha[5] . "</td>
                        </tr>
                        <tr>
                            <td class='tdNome'>Complemento</td>
                            <td class='tdValor'>" . $linha[6] . "</td>
                        </tr>
                     </table>
                     <h2>Dados de Cadastro</h2>
                     <table>
                        <tr>
                            <td class='tdNome'>E-mail</td>
                            <td class='tdValor'>" . $linha[13] . "</td>
                        </tr>
                     </table>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->senha = "";
        $this->cpf = "";
        $this->dtnasc = "";
        $this->complemento = "";
        $this->endereco = "";
        $this->bairro = "";
        $this->cidade = "";
        $this->estado = "";
        $this->cep = "";
        $this->telefone = "";
        $this->celular = "";
        $this->email = "";
        $this->con = "";
    }

}

?>
