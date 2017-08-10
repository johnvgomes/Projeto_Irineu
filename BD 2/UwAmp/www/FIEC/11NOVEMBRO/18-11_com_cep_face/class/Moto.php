<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Moto {

    private $id;
    private $nome;
    private $valor;
    private $foto;
    private $tpfoto;
    private $estoque;
    private $id_marca;
    private $con;
    private $ct;

    public function __construct($id = "", $nome = "", $valor = "", $foto = "", $estoque = "", $id_marca = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
        $this->foto = $foto;
        $this->estoque = $estoque;
        $this->id_marca = $id_marca;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getTpfoto() {
        return $this->tpfoto;
    }

    public function setTpfoto($tpfoto) {
        $this->tpfoto = $tpfoto;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function getId_marca() {
        return $this->id_marca;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    public function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
    }

    public function cadastrar() {
        try {
            //faremos o envio da foto na linha abaixo
            $this->ct->enviarArquivo($this->getTpfoto(), "../imagem_moto/" . $this->getFoto());

            //envio dos dados para a table MySQL
            $sql = "INSERT INTO moto VALUES (null,?,?,?,?,?);";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getValor(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getFoto(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getEstoque(), PDO::PARAM_INT);
            $prepsql->bindParam(5, $this->getId_marca(), PDO::PARAM_INT);

            if ($prepsql->execute()) {
                echo "Cadastro de moto efetuado com sucesso";
            } else {
                echo "Falha ao cadastrar moto";
            }
        } catch (PDOException $exc) {
            echo "Erro no cadastrar moto " . $exc->getMessage();
        }
    }

    public function consultar($tipo) {
        try {
            $sql = "SELECT mt.id, mt.nome, mt.foto, "
                    . "mt.valor, mt.estoque, "
                    . "ma.nome, ma.pais_origem "
                    . "FROM moto as mt, marca as ma "
                    . "WHERE mt.id_marca = ma.id";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                if ($tipo == "admin") {
                    $ponto = "../";
                } else {
                    $ponto = "";
                }

                echo "<div class='consulta'>"
                . "<div class='foto'>"
                . "<a href='$ponto" . "imagem_moto/$linha[2]' rel='lightbox' title='$linha[1]'>"
                . "<img src='$ponto" . "imagem_moto/$linha[2]' alt='$linha[1]'>"
                . "</a>"
                . "</div>"
                . "<div class='informacoes'>"
                . "<h3>$linha[1]</h3>"
                . "</div>"
                . "<div id='informacoes'>"
                . "R$ " . number_format($linha[3], 2, ',', '.')
                . "<br>Estoque: $linha[4] <br> Marca: $linha[5]"
                . "</div>";

                if ($tipo == "admin") {
                    echo "<div id='informacoes'>"
                    . "<a href='?p=moto/excluir&id=$linha[0]'>[ex]</a>"
                    . "<a href='?p=moto/editar&id=$linha[0]'>[ed]</a>"
                    . "<a href='?p=moto/editarfoto&id=$linha[0]'>[edf]</a>"
                    . "</div>";
                }//fim if
                echo "</div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar moto " . $exc->getMessage();
        }
    }

    public function consultarValor($inicial, $final) {
        try {
            $sql = "SELECT m.id, m.nome, m.foto, m.valor, m.estoque, "
                    . "ma.nome "
                    . "FROM moto as m, marca as ma "
                    . "WHERE m.id_marca = ma.id AND "
                    . "m.valor BETWEEN ? AND ? "
                    . "ORDER BY m.nome";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $inicial, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $final, PDO::PARAM_STR);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='consulta'>"
                . "<div class='foto'>"
                . "<a href='../imagem_moto/$linha[2]' rel='lightbox' title='$linha[1]'>"
                . "<img src='../imagem_moto/$linha[2]' alt='$linha[1]'>"
                . "</a>"
                . "</div>"
                . "<div class='informacoes'>"
                . "<h3>$linha[1]</h3>"
                . "</div>"
                . "<div id='informacoes'>"
                . "R$ " . number_format($linha[3], 2, ',', '.')
                . "<br>Estoque: $linha[4] <br> Marca: $linha[5]"
                . "</div>"
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar moto por valor " . $exc->getMessage();
        }
    }

    public function consultarLike($caracteres) {
        try {
            $sql = "SELECT m.id, m.nome, m.foto, m.valor, m.estoque, "
                    . "ma.nome "
                    . "FROM moto as m, marca as ma "
                    . "WHERE m.nome LIKE ? AND "
                    . "m.id_marca = ma.id "
                    . "ORDER BY m.nome";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $caracteres, PDO::PARAM_STR);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='consulta'>"
                . "<div class='foto'>"
                . "<a href='../imagem_moto/$linha[2]' rel='lightbox' title='$linha[1]'>"
                . "<img src='../imagem_moto/$linha[2]' alt='$linha[1]'>"
                . "</a>"
                . "</div>"
                . "<div class='informacoes'>"
                . "<h3>$linha[1]</h3>"
                . "</div>"
                . "<div id='informacoes'>"
                . "R$ " . number_format($linha[3], 2, ',', '.')
                . "<br>Estoque: $linha[4] <br> Marca: $linha[5]"
                . "</div>"
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar moto LIKE " . $exc->getMessage();
        }
    }

    public function capturarId() {
        try {
            $sql = "SELECT id FROM moto ORDER BY id DESC LIMIT 1";

            $res = $this->con->query($sql);

            if ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo $linha[0];
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar moto último ID " . $exc->getMessage();
        }
    }

    // 30/09
    public function mostrar($id_marca) {
        try {
            $sql = "SELECT m.id, m.nome, m.foto, m.valor, m.estoque, "
                    . "ma.nome "
                    . "FROM moto as m, marca as ma "
                    . "WHERE m.id_marca = ? AND "
                    . "m.id_marca = ma.id "
                    . "ORDER BY m.nome";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id_marca, PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='consulta'>"
                . "<div class='foto'>"
                . "<a href='../imagem_moto/$linha[2]' rel='lightbox' title='$linha[1]'>"
                . "<img src='../imagem_moto/$linha[2]' alt='$linha[1]'>"
                . "</a>"
                . "</div>"
                . "<div class='informacoes'>"
                . "<h3>$linha[1]</h3>"
                . "</div>"
                . "<div id='informacoes'>"
                . "R$ " . number_format($linha[3], 2, ',', '.')
                . "<br>Estoque: $linha[4] <br> Marca: $linha[5]"
                . "</div>"
                . "</div>";
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar moto por marca " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT mt.*, ma.*
                FROM moto as mt, marca as ma
                WHERE mt.id=? AND mt.id_marca = ma.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linha;
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar moto por marca " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE moto SET nome=?, valor=?, estoque=?, id_marca=? "
                    . "WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getValor(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getEstoque(), PDO::PARAM_INT);
            $sqlprep->bindParam(4, $this->getId_marca(), PDO::PARAM_INT);
            $sqlprep->bindParam(5, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute() == 1) {
                echo "Moto atualizada com sucesso";
            } else {
                echo "Problemas ao editar moto";
            }
        } catch (Exception $exc) {
            echo "Erro no editar moto " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $foto = $this->carregar($id);
            
            $this->ct->excluirArquivo("../imagem_moto/".$foto[3]);
            
            $sql = "DELETE FROM moto WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
            
        } catch (PDOException $exc) {
            echo "Erro no excluir moto " . $exc->getMessage();
        }
    }

    // 14/10
    public function editarFoto($id,$foto,$tpfoto,$anterior) {
        try {
            //excluir arquivo na pasta do server
            $this->ct->excluirArquivo("../imagem_moto/".
                    $anterior);
            
            //envia a nova foto para a pasta no server
            $this->ct->enviarArquivo($tpfoto, 
                    "../imagem_moto/".$foto);
            
            $sql = "UPDATE moto SET foto=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $foto, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            
            if($sqlprep->execute()){
                echo "Foto atualizada com sucesso";
            }            
            
        } catch (PDOException $exc) {
            echo "Erro no editar foto de moto " . 
                    $exc->getMessage();
        }
    }
    
    public function __destruct() {
        $this->id = "";
        $this->nome = "";
        $this->valor = "";
        $this->foto = "";
        $this->estoque = "";
        $this->id_marca = "";
        $this->con = "";
    }

}
