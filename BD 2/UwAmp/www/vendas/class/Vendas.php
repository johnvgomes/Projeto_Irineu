<?php

include_once 'Conectar.php';

class Vendas {

    private $id;
    private $total;
    private $data;
    private $hora;
    private $frete;
    private $obs;
    private $status;
    private $id_tipopagamentos;
    private $id_cliente;
    private $con;

    public function __construct($id = "", $total = "", $data = "", $hora = "", $frete = "", $obs = "", $status = "", $id_tipopagamentos = "", $id_cliente = "") {
        $this->id = $id;
        $this->total = $total;
        $this->data = $data;
        $this->hora = $hora;
        $this->frete = $frete;
        $this->obs = $obs;
        $this->status = $status;
        $this->id_tipopagamentos = $id_tipopagamentos;
        $this->id_cliente = $id_cliente;
        $this->con = new Conectar();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getFrete() {
        return $this->frete;
    }

    public function setFrete($frete) {
        $this->frete = $frete;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getId_tipopagamentos() {
        return $this->id_tipopagamentos;
    }

    public function setId_tipopagamentos($id_tipopagamentos) {
        $this->id_tipopagamentos = $id_tipopagamentos;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }
    
    public function dadosTabela() {
        try {
            $sql = "SELECT COUNT(*) FROM vendas as v "
                    . "UNION ALL "
                    . "SELECT COUNT(*) FROM vendas as v, tipospagamento as tp, clientes as cl
                        WHERE v.id_tipopagamento=tp.id AND v.id_cliente=cl.id "
                    . "UNION ALL "
                    . "SELECT MAX(v.id) FROM vendas as v, tipospagamento as tp, clientes as cl
                        WHERE v.id_tipopagamento=tp.id AND v.id_cliente=cl.id";
            $result = $this->con->query($sql);

            echo "<tr>"
            . "<td>Vendas</td>";

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<td>$linhas[0]</td>";
            }
            echo "</tr>";
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function consultar($consulta) {
        try {
            if (empty($consulta)) {
                $consulta = 'ORDER BY v.id LIMIT 0,50';
            } else if (strpos($consulta, 'LIKE') !== false) {
                $consulta = 'WHERE ' . $consulta;
            }

            $sql = "SELECT v.* FROM vendas as v $consulta";
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo utf8_decode("
                <tr id=$linhas[0]>
                    <td>$linhas[0]</td>
                    <td>" . $this->mudaPreco($linhas[1]) . "</td>
                    <td>" . $this->mudaPreco($linhas[4]) . "</td>
                    <td>" . date("d/m/Y", strtotime($linhas[2])) . "</td>
                    <td>" . date("H:i:s", strtotime($linhas[3])) . "</td>
                    <td>" . $linhas[5] . "</td>
                    <td>$linhas[6]</td>
                    <td class='infoImg clickable' onclick='exibirCliente(" . $linhas[0] . ");'>
                        <img src='../img/relacao.png' width='25' height='25' alt='Exibir detalhes' />
                    </td>
                    <td class='infoImg clickable' onclick='exibirItens(" . $linhas[0] . ");'>
                        <img src='../img/itens.png' width='25' height='25' alt='Exibir itens' />
                    </td>
                    <td class='infoImg'><a href='?p=vendas/excluir&id=$linhas[0]'><img src='../img/excluir.png' width='25' height='25' alt='Excluir' />
                        </a></td>
                </tr>");
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function mudaPreco($valor) {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM vendas WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);

            if ($sqlprep->execute())
                echo 'Exclu&iacute;do com sucesso!';
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function enviaEmail($id) {
        try {
            $sqlprep = $this->con->prepare("SELECT c.email FROM clientes as c, vendas as v"
                    . "WHERE v.id=? AND c.id = v.id_cliente");
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            $linha = $sqlprep->fetch(PDO::FETCH_NUM);

            $remetente = 'buyon-commerce@outlook.com';
            $para = $linha[0];
            $assunto = 'Pedido nº ' . $id . ' negadao - BuyOn';
            $msg = "Mensagem enviada em: " . date("d/m/Y") .
                    "O pedido identificado pelo nº " . $id .
                    "foi negado por algum motivo. <br />" .
                    "Tente fazer o pedido novamente mais tarde ou entre em "
                    . "contato com a BuyOn para identificarmos o problema. <br />" .
                    "Nós agradecemos a preferência e lamentamos o ocorrido. <br />"
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

    public function exibirCliente($id) {
        try {
            $sql = "SELECT v.*, cl.*, tp.* "
                    . "FROM vendas as v, clientes as cl, tipospagamento as tp "
                    . "WHERE v.id=? AND v.id_cliente = cl.id AND v.id_tipopagamento = tp.id";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "/^nome_tipopagamento=$linha[24]$/
                    &/^id_tipopagamento=$linha[23]$/
                    &/^nome_cliente=$linha[10]$/
                    &/^id_cliente=$linha[9]$/
                    &/^cpf_cliente=" . $this->expReg($linha[12], 'cpf', true) . "$/" .
                        "&/^cep_cliente=" . $this->expReg($linha[19], 'cep', true) . "$/";
            }
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

                    if ($i == 4) {
                        $nvalor .= '-';
                    }
                }

                return $nvalor;
            } else if ($tipo == 'tel') {
                $nvalor = '(';

                for ($i = 0; $i < count($valor_array); $i++) {
                    $nvalor .= $valor_array[$i];

                    switch ($i) {
                        case 1:
                            $nvalor .= ')';
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
                            $nvalor .= ')';
                            break;
                        case 6:
                            $nvalor .= '-';
                            break;
                    }
                }

                return $nvalor;
            }
        } else {
            $chars = array(".", "-", "(", ")");
            return str_replace($chars, "", $valor);
        }
    }

    public function quantPg($busca) {
        $numreg = 50;

        if (empty($busca)) {
            $busca = '';
        } else if (strpos($busca, 'LIKE') !== false) {
            $busca = 'WHERE ' . $busca;
        }

        @$res = $this->con->query("SELECT COUNT(*)
                FROM vendas as v $busca");

        @$quantreg = $res->fetchColumn();
        @$quant_pg = floor($quantreg / $numreg);
        @$quant_pg = $quant_pg + 1;

        return $quant_pg;
    }

    public function __destruct() {
        $this->id = "";
        $this->total = "";
        $this->data = "";
        $this->hora = "";
        $this->frete = "";
        $this->obs = "";
        $this->status = "";
        $this->id_tipopagamentos = "";
        $this->id_cliente = "";
        $this->con = "";
    }

}

?>
