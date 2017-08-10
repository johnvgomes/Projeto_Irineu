<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagina
 *
 * @author Ferraz
 */
include_once 'Conectar.php';
include_once 'Controles.php';

class Pagina {

    //put your code here
    private $id;
    private $url;
    private $titulo;
    private $conteudo;
    private $icone;
    private $temp_icone;
    private $imagem;
    private $temp_imagem;
    private $ct;
    private $con;

    public function __construct($id = "", $url = "", $titulo = "", $conteudo = "", $icone = "", $temp_icone = "", $imagem = "", $temp_imagem = "") {
        $this->id = $id;
        $this->url = $url;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        $this->icone = $icone;
        $this->temp_icone = $temp_icone;
        $this->imagem = $imagem;
        $this->temp_imagem = $temp_imagem;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getConteudo() {
        return $this->conteudo;
    }

    public function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    public function getIcone() {
        return $this->icone;
    }

    public function setIcone($icone) {
        $this->icone = $icone;
    }

    public function getTemp_icone() {
        return $this->temp_icone;
    }

    public function setTemp_icone($temp_icone) {
        $this->temp_icone = $temp_icone;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function getTemp_imagem() {
        return $this->temp_imagem;
    }

    public function setTemp_imagem($temp_imagem) {
        $this->temp_imagem = $temp_imagem;
    }

    public function salvar() {
        try {
            $this->ct = new Controles();
            $this->ct->enviarArquivo($this->getTemp_icone(), "../imagem_pagina/icone/" . $this->getIcone());

            $this->ct->enviarArquivo($this->getTemp_imagem(), "../imagem_pagina/" . $this->getImagem());

            $sql = "INSERT INTO pagina VALUES (null,?,?,?,?,?)";

            $this->con = new Conectar();
            $prepsql = $this->con->prepare($sql);

            $prepsql->bindParam(1, $this->getUrl(), PDO::PARAM_STR);
            $prepsql->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $prepsql->bindParam(3, $this->getConteudo(), PDO::PARAM_STR);
            $prepsql->bindParam(4, $this->getIcone(), PDO::PARAM_STR);
            $prepsql->bindParam(5, $this->getImagem(), PDO::PARAM_STR);

            $prepsql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//fim salvar

    public function consultar($id) {
        try {
            $sql = "SELECT * FROM pagina WHERE id = ?";

            $this->con = new Conectar();

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();

            echo "<table>";
            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "
                    
                    <tr>
                    <td><a href='?p=pagina/excluir&id=$linhas[0]'>
                        <img src='../imagem/excluir.png' alt='excluir pagina' />
                    </a>
                    <a href='?p=pagina/editar&id=$linhas[0]'>
                        <img src='../imagem/editar.png' alt='editar pagina' />
                    </a>
                    
                    Para alterar o icone e/ou imagem, clique sobre a miniatura
                    </td>
                    </tr>
                    <tr><td><hr /><td></tr>
                    
                    <tr><td>
                    <a href='?p=pagina/editarIcone&id=$linhas[0]'>
                    <img src=../imagem_pagina/icone/$linhas[4] 
                        width=100 border=0 />
                    </a>
                    <a href='?p=pagina/editarImagem&id=$linhas[0]'>
                    <img src=../imagem_pagina/$linhas[5] 
                        width=100 border=0 />
                    </a>
                    </td></tr> 
                        
                    <tr><td>$linhas[0] - $linhas[1] | <h3>$linhas[2]</h3></td><tr>
                    <tr><td>$linhas[3]</td></tr>
                    <tr><td><hr /><td></tr>
                    <tr>
                    <td><a href='?p=pagina/excluir&id=$linhas[0]'>
                        <img src='../imagem/excluir.png' alt='excluir pagina' />
                    </a>
                    <a href='?p=pagina/editar&id=$linhas[0]'>
                        <img src='../imagem/editar.png' alt='editar pagina' />
                    </a>
                    </td>
                    </tr>";
            }
            echo "</table>";
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

//fim consultar
    //carregar será útil para os métodos excluir, editar, editarimagem e editaricone
    public function carregar($id) {
        try {
            $sql = "SELECT * FROM pagina WHERE id = ?;";

            $this->con = new Conectar();
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
            $sql = "UPDATE pagina SET url=?, titulo=?, 
                conteudo=? WHERE id=?";

            $this->con = new Conectar();
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $this->getUrl(), PDO::PARAM_STR);
            $sqlprep->bindParam(2, $this->getTitulo(), PDO::PARAM_STR);
            $sqlprep->bindParam(3, $this->getConteudo(), PDO::PARAM_STR);
            $sqlprep->bindParam(4, $this->getId(), PDO::PARAM_INT);

            $sqlprep->execute();
            echo "teste";
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $vetor = $this->carregar($id);

            $this->ct = new Controles();
            $this->ct->excluirArquivo("../imagem_pagina/icone/" . $vetor[4]);
            $this->ct->excluirArquivo("../imagem_pagina/" . $vetor[5]);

            $this->con = new Conectar();

            $sql = "DELETE FROM pagina WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarImagem($id, $novo, $temporario, $anterior) {
        try {
            $this->ct = new Controles();
            //excluir arquivo anterior na pasta
            $this->ct->excluirArquivo("../imagem_pagina/" . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, "../imagem_pagina/" . $novo);

            $this->con = new Conectar();
            //atualizar registro na table MySQL
            $sql = "UPDATE pagina SET imagem=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function editarIcone($id, $novo, $temporario, $anterior) {
        try {
            $this->ct = new Controles();
            //excluir arquivo anterior na pasta
            $this->ct->excluirArquivo("../imagem_pagina/icone/" . $anterior);

            //inserir novo arquivo na pasta
            $this->ct->enviarArquivo($temporario, "../imagem_pagina/icone/" . $novo);

            $this->con = new Conectar();
            //atualizar registro na table MySQL
            $sql = "UPDATE pagina SET icone=? WHERE id=?";
            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $novo, PDO::PARAM_STR);
            $sqlprep->bindParam(2, $id, PDO::PARAM_INT);
            $sqlprep->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarCombo() {
        try {
            $sql = "SELECT * FROM pagina";
            $this->con = new Conectar();
            $result = $this->con->query($sql);

            while ($linhas = $result->fetch(PDO::FETCH_NUM)) {
                echo "<option value='$linhas[0]'>
                        $linhas[2]
                        </option>";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function carregarPDF($tipo) {
        try {
            $sql = "select * from pagina";
            $this->con = new Conectar();
            $r = $this->con->query($sql);

            if ($tipo == "adm") {
                include '../../pdf/mpdf.php';
            } else {
                include 'pdf/mpdf.php';
            }
            $pdf = new mPDF();

            $html = "<table>";

            while ($l = $r->fetch(PDO::FETCH_NUM)) {
                $html .= "<tr><td>$l[3]</td></tr>
                    <tr><td></td></tr>
                    <tr><td>&nbsp;</td></tr>";
            }

            $html .= "</table>";

            $pdf->WriteHTML($html);
            $pdf->Output();
            exit();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function mostrar($url,$base) {
        try {
            $sql = "SELECT * FROM pagina WHERE url = ?";

            $this->con = new Conectar();

            $sqlprep = $this->con->prepare($sql);
            $sqlprep->bindParam(1, $url, PDO::PARAM_INT);
            $sqlprep->execute();

            if ($linhas = $sqlprep->fetch(PDO::FETCH_NUM)) {
                echo "                    
                    <div class='esquerda'>
                        <img src=".$base."imagem_pagina/$linhas[5] 
                        width=100 border=0 />
                    </div>
                    <div class='esquerda'>
                        <h3>$linhas[2]</h3>
                    </div>
                    <div class='esquerda'>
                        $linhas[3]
                    </div>";
            }
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

//fim consultar

    public function __destruct() {
        $this->id = "";
        $this->url = "";
        $this->titulo = "";
        $this->conteudo = "";
        $this->icone = "";
        $this->temp_icone = "";
        $this->imagem = "";
        $this->temp_imagem = "";
        $this->ct = "";
    }

}

?>
