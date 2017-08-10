<?php

include_once 'Conectar.php';
include_once 'Controles.php';

class Curso {

    private $id;
    private $id_eixo;
    private $nome;
    private $descricao;
    private $plano;
    private $tpplano;
    private $matriz;
    private $tpmatriz;
    private $icone;
    private $tpicone;
    private $url;
    private $con;
    private $ct;

    public function __construct($id = "", $id_eixo = "", $nome = "", 
            $descricao = "", $plano = "", $tpplano = "", $matriz = "", $tpmatriz = "", $url = ""
            , $icone = "", $tpicone = "") {
        $this->id = $id;
        $this->id_eixo = $id_eixo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->plano = $plano;
        $this->tpplano = $tpplano;
        $this->matriz = $matriz;
        $this->tpmatriz = $tpmatriz;
        $this->icone = $icone;
        $this->tpicone = $tpicone;
        $this->url = $url;
        $this->con = new Conectar();
        $this->ct = new Controles();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId_eixo() {
        return $this->id_eixo;
    }

    public function setId_eixo($id_eixo) {
        $this->id_eixo = $id_eixo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getPlano() {
        return $this->plano;
    }

    public function setPlano($plano) {
        $this->plano = $plano;
    }

    public function getTpplano() {
        return $this->tpplano;
    }

    public function setTpplano($tpplano) {
        $this->tpplano = $tpplano;
    }

    public function getMatriz() {
        return $this->matriz;
    }

    public function setMatriz($matriz) {
        $this->matriz = $matriz;
    }

    public function getTpmatriz() {
        return $this->tpmatriz;
    }

    public function setTpmatriz($tpmatriz) {
        $this->tpmatriz = $tpmatriz;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }
    
    public function getIcone() {
        return $this->icone;
    }

    public function setIcone($icone) {
        $this->icone = $icone;
    }

    public function getTpicone() {
        return $this->tpicone;
    }

    public function setTpicone($tpicone) {
        $this->tpicone = $tpicone;
    }

    
    public function salvar() {
        try {

            //gravar arquivo por aqui
            $this->ct->enviarArquivo($this->getTpplano(), "../plano-curso/" .
                    $this->getPlano());

            $this->ct->enviarArquivo($this->getTpmatriz(), "../matriz-curricular/" .
                    $this->getMatriz());
            
            $this->ct->enviarArquivo($this->getTpicone(), "../imagem/icone/" .
                    $this->getIcone());

            $sql = "INSERT INTO curso VALUES (null,?,?,?,?,?,?,?)";

            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getId_eixo(), PDO::PARAM_INT);
            $prepsql->bindParam(2, $this->getNome(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getDescricao(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getPlano(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getMatriz(), PDO::PARAM_STR);
            $prepsql->bindParam(6, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(7, $this->getIcone(), PDO::PARAM_STR);

            $prepsql->execute();

            //aqui dispara o cadastro de imagens
        } catch (PDOException $e) {
            echo "Erro no salvar curso " . $e->getMessage();
        }
    }

    ///tem que mexer neste método
    public function visualizar($caminho, $url) {
        try {
            $sql = "SELECT n.* FROM 
            noticia as n WHERE n.url = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $url, PDO::PARAM_STR);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>CURSO: $linha[1] - " . @date("d/m/Y", strtotime($linha[4])) . "</h3>
                    $linha[3]
                    " . $this->in->visualizar($caminho, $linha[0]) . "
                </div>";
            }
        } catch (PDOException $e) {
            echo "Erro no visualizar notícia " . $e->getMessage();
        }
    }

    public function consultar() {
        try {
            //[curso]id,id_eixo,nome,descricao,plano,matriz [eixo]id,nome
            $sql = "SELECT c.*, e.* FROM curso as c, eixo as e 
                    WHERE c.id_eixo = e.id AND c.id_eixo = ?                 
                    ORDER BY c.nome ";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_eixo(), PDO::PARAM_INT);
            $sqlprep->execute();

            while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<div class='noticia'>
                    <h3>CURSO: $linha[2] | EIXO TECNOLÓGICO: $linha[9]</h3>
                        <a href='?p=curso/excluir&id=$linha[0]' title='excluir'>
                        <img src='../imagem/icone/remove.png'>
                        </a>
                        <a href='?p=curso/editar&id=$linha[0]' title='editar'>
                        <img src='../imagem/icone/accept.png'>
                        </a>
                        <a href='?p=curso/editarPlano&id=$linha[0]' title='$linha[2]'>[editar plano de curso]</a>
                        <a href='?p=curso/editarMatriz&id=$linha[0]' title='$linha[2]'>[editar matriz curricular]</a>
                        <a href='?p=curso/editarIcone&id=$linha[0]' title='$linha[2]'>[editar icone]</a>
                    <br><br><hr>
                    </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar curso " . $exc->getMessage();
        }
    }

    public function carregarSelect($tipo) {
        try {
            //[curso]id,id_eixo,nome,descricao,plano,matriz [eixo]id,nome
            $sql = "SELECT c.* FROM curso as c, eixo as e 
                    WHERE c.id_eixo = e.id                  
                    ORDER BY c.nome ";

            $sqlprep = $this->con->query($sql);

             while ($linha = $sqlprep->fetch(PDO::FETCH_NUM)){
                if($tipo == "tcc"){
                 echo "<option value='$linha[0]'>$linha[2]</option>";
                }else if($tipo == "curso"){
                 echo "<option value='$linha[6]'>$linha[2]</option>";
                }
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar curso " . $exc->getMessage();
        }
    }

    public function mostrar($url, $caminho) {
        try {
            //[calendario]id, id_unidade, ano, arquivo, [unidade]id, nome
            $sql = "SELECT c.*, e.* FROM curso as c, eixo as e 
                    WHERE c.id_eixo = e.id AND c.url = ?";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $url, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo
                "<div class='pgcurso'>
                    <img src='" . $caminho . "imagem/icone/$linha[7]' title='$linha[5] - $linha[2]'>
                
                    <span>Eixo Tecnológico: $linha[9] <br> Curso: $linha[2]<br><br>
                        
                    <span>$linha[3]</span><br><br>
                    <div class='esquerda'>
                        <a href='" . $caminho . "matriz-curricular/" . $linha[5] . "' target='_blank'>
                        <img src='".$caminho."/imagem/icone/pdf.png'>
                        Acesse a Matriz Curricular</a> 
                    </div>
                    <div class='esquerda'>
                        <a href='" . $caminho . "plano-curso/" . $linha[4] . "' target='_blank'>
                        <img src='".$caminho."/imagem/icone/pdf.png'>
                        Acesse o Plano de Curso</a>
                    </div>
                </div>";
            }//fim while
        } catch (PDOException $exc) {
            echo "Erro no consultar curso " . $exc->getMessage();
        }
    }

    public function carregar($id) {
        try {
            $sql = "SELECT c.*, e.*
                FROM curso as c, eixo as e
                WHERE c.id=? AND c.id_eixo = e.id";

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                return $linhas;
            }
            $this->con = null; //desconectar
        } catch (PDOException $exc) {
            echo "Erro ao carregar curso " . $exc->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "UPDATE curso SET id_eixo=?,nome=?,
                descricao=?,url=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getId_eixo(), PDO::PARAM_INT);
            $sqlprep->bindParam(2, $this->getNome(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getDescricao(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(5, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            //echo 'Curso atualizado com sucesso';
        } catch (PDOException $exc) {
            echo "Erro ao editar registros de curso  " . $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {

            $vetor = $this->carregar($id);

            $this->ct->excluirArquivo("../matriz-curricular/" . $vetor[5]);
            $this->ct->excluirArquivo("../plano-curso/" . $vetor[4]);
            $this->ct->excluirArquivo("../imagem/icone/" . $vetor[7]);
            
            $sql = "DELETE FROM curso WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarArquivo($id, $novo, $temporario, $anterior, $tipo) {
        try {

            if ($tipo == "plano") {
                $pasta = "../plano-curso/";
                $sql = "UPDATE curso SET plano=? WHERE id=?";
            } else if ($tipo == "matriz") {
                $pasta = "../matriz-curricular/";
                $sql = "UPDATE curso SET matriz=? WHERE id=?";
            } else if($tipo == "icone"){
                $pasta = "../imagem/icone/";
                $sql = "UPDATE curso SET icone=? WHERE id=?";
            }

            //excluir arquivo anterior na pasta
            $this->ct->excluirArquivo($pasta . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, $pasta . $novo);

            //atualizar registro na table MySQL
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = "";
        $this->id_eixo = "";
        $this->nome = "";
        $this->descricao = "";
        $this->plano = "";
        $this->tpplano = "";
        $this->matriz = "";
        $this->tpmatriz = "";
        $this->icone = "";
        $this->tpicone = "";
        $this->url = "";
        $this->con = "";
        $this->ct = "";
    }

}

?>
