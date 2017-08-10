<?php
header('Content-type: text/html; charset=utf-8');
require_once 'Conectar.php';
require_once 'Entity.php';

class Menu extends Entity{
	
    private $titulo;
    private $link;
    private $destino;
    private $tipo;
    private $ordem;  
    private $categoria;  
    private $eixo;  
    private $con;
    
    public function __construct($t="",$l="",$d="",$tp="",$o="",$c="",$eixo=""){
        $this->titulo = $t;    
        $this->link = $l;
        $this->destino = $d;
        $this->tipo = $tp;
        $this->ordem = $o;
        $this->categoria = $c;
        $this->eixo = $eixo;
        $this->con = new Conectar();
    }
    
    public function cadastrar(){
        $this->con->executar("INSERT INTO menu
            VALUES (null, 
            '".$this->getTitulo()."','".$this->getLink()."','".$this->getDestino()."',
            '".$this->getTipo()."','".$this->getOrdem()."','".$this->getCategoria()."'
            ,'".$this->getEixo()."')");
    }
    
    public function carregarID($id){
        $sql = $this->con->executar("SELECT * FROM menu WHERE id = '$id'");
        while($linhas = mysql_fetch_row($sql)){
                return array((int)$linhas[0],$linhas[1]
                        ,$linhas[2],$linhas[3],$linhas[4]
                        ,$linhas[5],$linhas[6],$linhas[7]);
        }
    }

    public function consultarAdm(){
        $sql = $this->con->executar("SELECT * FROM menu ORDER BY ordem");
        echo "<ul>";
        while ($linhas = mysql_fetch_row($sql)){
            if ($linhas[4] == "adm"){
                if ($linhas[6] == "titulo"){
                    echo ("<li><h3>".$linhas[1]."</h3></li>");
                } else if ($linhas[6] == "comum"){	
                    echo ("<li><a href=".$linhas[2]." 
                        target=".$linhas[3]." 
                            title=".$linhas[1].">".$linhas[1]."
                                </a></li>");
                }//fim if para analisar categoria - titulo ou comum
            }//fim if tipo - adm ou lim
        }//loop para carregar menu
        echo "</ul>";
    }

    public function consultarLivre(){
        $sql = $this->con->executar("SELECT * FROM menu ORDER BY ordem");
        echo "<ul>";
        while ($linhas = mysql_fetch_row($sql)){
            if ($linhas[4] == "lim"){
                if ($linhas[6] == "titulo"){
                    echo ("<li><h3>".$linhas[1]."</h3></li>");
                } else if ($linhas[6] == "comum"){	
                    echo ("<li><a href=".$linhas[2]." 
                        target=".$linhas[3]." 
                            title=".$linhas[1].">".$linhas[1]."
                                </a></li>");
                }//fim if para analisar categoria - titulo ou comum
            }//fim if tipo - adm ou lim
        }//loop para carregar menu
        echo "</ul>";
    }

    public function consultar(){
             echo "<tr>
                 <td><h3>Menu</h3></td>
                 <td>Tipo</td></td>
                 <td>Ordem</td></td>
                 <td>Excluir?</td><td>Alterar?</td>
            </tr>";
            $sql = $this->con->executar("SELECT * FROM menu ORDER BY ordem");

            while($linhas = mysql_fetch_row($sql)){
                    echo "<tr>";
                    echo "<td>".$linhas[1]."</td>";
                    echo "<td>".$linhas[4]."</td>";
                    echo "<td>".$linhas[5]."</td>";
                    echo "<td><a href='?p=menu/excluir.php&id=".$linhas[0]."' target=_self>[Excluir]</a></td>";
                    echo "<td><a href='?p=menu/editar.php&id=".$linhas[0]."' target=_self>[Editar]</a></td>";
                    echo "</tr>";
            }
    }

    public function excluir($id){
            $this->con->executar("DELETE FROM menu WHERE id = '$id'")
                    or die ("N&atilde;o foi poss&iacute;vel excluir!"); 
            echo "<h2>Item exclu&iacute;do com sucesso!</h2>";
            echo "<meta http-equiv='refresh' content='1;URL=?page=controlarMenu.php'>";
    }

    public function consultarAlterar($id){
        $sql = $this->con->executar("SELECT * FROM menu WHERE id = '$id'");

        while($linhas = mysql_fetch_row($sql)){
            $id = $linhas[0];
            $titulo = $linhas[1];
            $link = $linhas[2];
            $destino = $linhas[3];
            $ordem = $linhas[5];
            $eixo = $linhas[7];

            echo "<form action='?p=alterartbMenu.php&id=$id' method='post'>";
            echo "<table border='0' cellspacing='1' cellpadding='1'>";
            echo "<tr><td colspan='2'><h3>Atualizando Menu</h3><br /></td></tr>";
            echo "<tr><td>T&iacute;tulo:</td><td><input name='titulo' type='text' size=10 value='$titulo' /></td></tr>";
            echo "<tr><td>Link:</td><td><input name='link' type='text' size=50 value='$link' maxlength=50 /></td></tr>";
            echo "<tr><td>Destino:</td><td><input name='destino' type='text' size=10 value='$destino' maxlength=7 /></td></tr>";
            
            echo "<tr><td>Tipo:</td><td><select name='tipo'>
                    <option value='adm'>Administrador</option>
                    <option value='lim'>Limitado</option>				
            <select></td></tr>";
            
            echo "<tr><td>Ordem:</td><td><input name='ordem' type='text' size=10 value='$ordem' maxlength=4 /></td></tr>";
           
            echo "<tr><td>Categoria:</td><td><select name='categoria'>
                    <option value='titulo'>Titulo</option>
                    <option value='comum'>Comum</option>				
            <select></td></tr>";
            
            echo "<tr><td>Eixo:</td><td><input name='eixo' type='text' size=50 value='$eixo' /></td></tr>";

            echo "<tr><td colspan='2'><center><input type='submit' value='Alterar' id='botao'></center></td></tr>";
            echo "</table>";
            echo "</form>";
        }

    }

    public function editar($id, $titulo, $link, $destino, $tipo, $ordem, $categoria, $eixo){
            $this->con->executar("UPDATE menu SET titulo = '$titulo',
                link = '$link',destino = '$destino',tipo = '$tipo',
                ordem = '$ordem',categoria = '$categoria',eixo = '$eixo'
                WHERE id = '$id'");
    }		

    public function __destruct(){
        $this->titulo = "";    
        $this->link = "";
        $this->destino = "";
        $this->tipo = "";
        $this->ordem = "";
        $this->categoria = "";
        $this->eixo = "";
        $this->con = "";
    }
	
}
