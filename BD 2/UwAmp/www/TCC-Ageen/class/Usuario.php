<link href="../css/novaconta.css" type="text/css" rel="stylesheet">

<?php
include_once 'Conectar.php';
include_once 'Controles.php';

class Usuario {

    private $id;
    private $acesso;
    private $imagem_user;
    private $nome;
    private $sobrenome;
    private $num_celular;
    private $uf;
    private $cidade;
    private $email;
    private $senha;
    private $dia_nasc;
    private $mes_nasc;
    private $ano_nasc;
    private $sexo;
    private $empresa;
    private $temp_imguser;
    private $ct;
    private $con;
   
    function __construct($id = "", $acesso = "",  $imagem_user = "", $nome = "", $sobrenome = "", $num_celular = "", $uf = "", $cidade = "" ,$email = "", $senha = "", $dia_nasc = "", $mes_nasc = "", $ano_nasc = "", $sexo = "", $empresa = "", $temp_imguser = "") {
        $this->id = $id;
        $this->acesso = $acesso;
        $this->imagem_user = $imagem_user;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->num_celular = $num_celular;
        $this->uf = $uf;
        $this->cidade = $cidade;
        $this->email = $email;
        $this->senha = $senha;
        $this->dia_nasc = $dia_nasc;
        $this->mes_nasc = $mes_nasc;
        $this->ano_nasc = $ano_nasc;
        $this->sexo = $sexo;
        $this->empresa = $empresa;
        $this->temp_imguser = $temp_imguser;
        $this->ct = new Controles();
        $this->con = new Conectar();
    }
    public function getId() {
        return $this->id;
    }

    public function getAcesso() {
        return $this->acesso;
    }

    public function getImagem_user() {
        return $this->imagem_user;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function getNum_celular() {
        return $this->num_celular;
    }

    public function getUf() {
        return $this->uf;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getDia_nasc() {
        return $this->dia_nasc;
    }

    public function getMes_nasc() {
        return $this->mes_nasc;
    }

    public function getAno_nasc() {
        return $this->ano_nasc;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function getTemp_imguser() {
        return $this->temp_imguser;
    }

    public function getCt() {
        return $this->ct;
    }

    public function getCon() {
        return $this->con;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAcesso($acesso) {
        $this->acesso = $acesso;
    }

    public function setImagem_user($imagem_user) {
        $this->imagem_user = $imagem_user;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function setNum_celular($num_celular) {
        $this->num_celular = $num_celular;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setDia_nasc($dia_nasc) {
        $this->dia_nasc = $dia_nasc;
    }

    public function setMes_nasc($mes_nasc) {
        $this->mes_nasc = $mes_nasc;
    }

    public function setAno_nasc($ano_nasc) {
        $this->ano_nasc = $ano_nasc;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function setTemp_imguser($temp_imguser) {
        $this->temp_imguser = $temp_imguser;
    }

    public function setCt($ct) {
        $this->ct = $ct;
    }

    public function setCon($con) {
        $this->con = $con;
    }

        
    public function salvar() {
        try {
            
            $sql = "INSERT INTO usuario VALUES (null,0,null,?,?,?,?,?,?,?,?,?,?,?,?)";
            
         
            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getSobrenome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getNum_celular(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getUf(), PDO::PARAM_STR);
            @$sqlprep->bindParam(5, $this->getCidade(), PDO::PARAM_STR);
            @$sqlprep->bindParam(6, $this->getEmail(), PDO::PARAM_STR);
            @$sqlprep->bindParam(7, sha1($this->getSenha()), PDO::PARAM_STR);
            @$sqlprep->bindParam(8, $this->getDia_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(9, $this->getMes_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(10, $this->getAno_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(11, $this->getSexo(), PDO::PARAM_STR);
            @$sqlprep->bindParam(12, $this->getEmpresa(), PDO::PARAM_STR);
                        
            if ($sqlprep->execute() == 1) {
                echo ' <div id="cadastro_sucess">'
                . '<h3 class="cadastro_sucess_parabens">Parab&eacute;ns!</h3>'
                . '<h3 class="cadastro_sucess">Cadastro efetuado com sucesso</h3>'
                . '</div>';
                
            echo "<script language='javaScript'>window.location.href='../login.php'</script>";
        
                
            }
        } catch (PDOException $exc) {
              echo ' <div id="cadastro_fail">'
            . '<h3 class="cadastro_fail_sorry">Desculpe.</h3>'
            . '<h3 class="cadastro_fail">Cadastro n&atilde;o efetuado</h3>'
            . '</div>'
            . '<br>'
            . $exc->getMessage();
        }
    }

    public function editarSenha() {
        try {
            $sql = "UPDATE login SET senha=? WHERE email=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, sha1($this->getSenha()), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getEmail(), PDO::PARAM_STR);

            if ($sqlprep->execute() == 1) {
                echo "senha atualizada com sucesso";
            } else {
                echo "Problemas ao editar senha";
            }
        } catch (Exception $exc) {
            echo "Erro no editar senha " . $exc->getMessage();
        }
    }

    public function consultarEmail() {

        try {

            $sql = "select email from usuario WHERE email = ?";

            @$sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getEmail(), PDO::PARAM_STR);
            @$sqlprep->execute();

            if ($linha = $sqlprep->fetch(PDO::FETCH_NUM)) {
                //caso já exista no cadastro
                return 1;
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar de email " . $exc->getMessage();
        }
    }

    public function editarperfil() {
        try {
            $email_user= $_SESSION["usuario"];
            
            $sql = "UPDATE usuario SET "
                    . "nome = ?, "
                    . "sobrenome = ?,"
                    . "num_celular  = ?,"
                    . "uf = ?, "
                    . "cidade = ?, "
                    . "dia_nasc = ?, "
                    . "mes_nasc = ?, "
                    . "ano_nasc = ?, "
                    . "sexo = ?, "
                    . "empresa = ? "
                    . "WHERE email = '$email_user'";
        
               
            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getSobrenome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getNum_celular(), PDO::PARAM_INT);
            @$sqlprep->bindParam(4, $this->getUf(), PDO::PARAM_STR);
            @$sqlprep->bindParam(5, $this->getCidade(), PDO::PARAM_STR);
            @$sqlprep->bindParam(6, $this->getDia_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(7, $this->getMes_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(8, $this->getAno_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(9, $this->getSexo(), PDO::PARAM_STR);
            @$sqlprep->bindParam(10, $this->getEmpresa(), PDO::PARAM_STR);
         
                  
            if ($sqlprep->execute() == 1) {
                echo "Alteração efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar perfil "
            . $exc->getMessage();
        }
    }
    
     public function editarperfilcomimagem() {
        try {
            $email_user= $_SESSION["usuario"];
            $this->ct->enviarArquivo($this->getTemp_imguser(), "../foto_usuario/" . $this->getImagem_user());

            $sql = "UPDATE usuario SET "
                    . "imagem_user  = ?, "
                    . "nome = ?, "
                    . "sobrenome = ?,"
                    . "num_celular  = ?,"
                    . "uf = ?, "
                    . "cidade = ?, "
                    . "dia_nasc = ?, "
                    . "mes_nasc = ?, "
                    . "ano_nasc = ?, "
                    . "sexo = ?, "
                    . "empresa = ? "
                    . "WHERE email = '$email_user'";
        
               
            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getImagem_user(), PDO::PARAM_STR);
            @$sqlprep->bindParam(2, $this->getNome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(3, $this->getSobrenome(), PDO::PARAM_STR);
            @$sqlprep->bindParam(4, $this->getNum_celular(), PDO::PARAM_STR);
            @$sqlprep->bindParam(5, $this->getUf(), PDO::PARAM_STR);
            @$sqlprep->bindParam(6, $this->getCidade(), PDO::PARAM_STR);
            @$sqlprep->bindParam(7, $this->getDia_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(8, $this->getMes_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(9, $this->getAno_nasc(), PDO::PARAM_INT);
            @$sqlprep->bindParam(10, $this->getSexo(), PDO::PARAM_STR);
            @$sqlprep->bindParam(11, $this->getEmpresa(), PDO::PARAM_STR);
         
                  
            if ($sqlprep->execute() == 1) {
                echo "Alteração efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao editar perfil "
            . $exc->getMessage();
        }
    }
    
    public function consultar() {
        try {
            $sql = "SELECT * FROM funcionario";

            $sqlprep = $this->con->query($sql);

            while ($vetor = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<article>
                    $vetor[0]<br>
                    Funcionário: $vetor[1]<br>
                    Salário: $vetor[2]<br>
                    ID Departamento: $vetor[3]<br>   
                     <a href='?p=funcionario/excluir&id=$vetor[0]' title='Exclusão funcionário'>
                        <img src='../imagem/icone_deletar.png' alt='Excluir'>
                    </a> 
                    <a href='?p=funcionario/editar&id=$vetor[0]'
                        title='Editar Funcionario'>
                        <img src='../imagem/icone_editar.png' alt='Edição'>
                        </a>
                </article>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar depto "
            . $exc->getMessage();
        }
    }

    public function excluir() {
        try {
            $registro = $this->carregar();
            $this->ct->excluirArquivo("../Logomarca/" . $registro[3]);


            $sql = "DELETE FROM fabricante WHERE id = ?";

            $sqlprep = $this->con->prepare($sql);
            @$sqlprep->bindParam(1, $this->getId(), PDO::PARAM_INT);

            if ($sqlprep->execute() == 1) {
                echo "Exclusão efetuada com sucesso";
            }
        } catch (PDOException $exc) {
            echo "Erro ao excluir fabricante"
            . $exc->getMessage();
        }
    }

    public function carregar() {
        try {

            $sql = "SELECT * FROM usuario WHERE id_usuario =?";

            $ps = $this->con->prepare($sql);
            $ps->bindParam(1, $this->getId(), PDO::PARAM_INT);
            $ps->execute();

            if ($registro = $ps->fetch(PDO::FETCH_NUM)) {
                return $registro;
            }
        } catch (PDOException $exc) {
            echo "Erro ao carregar perfil" . $exc->getTraceAsString();
        }
    }
    
    public function carregarSelect() {
        try {
            $sql = "SELECT * FROM usuario ORDER BY nome";

           $sqlprep = $this->con->query($sql);

            while ($registro = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$registro[0]'>$registro[3] $registro[4] <br> ($registro[8])</option>";
            }
        } catch (PDOException $exc) {
            echo "Erro ao consultar usuario "
            . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->id = null;
        $this->nome = null;
        $this->sobrenome = null;
        $this->num_celular = null;
        $this->dia_nasc = null;
        $this->mes_nasc = null;
        $this->ano_nasc = null;
        $this->sexo = null;
        $this->email = null;
        $this->senha = null;
        $this->con = null;
    }

}
?>
