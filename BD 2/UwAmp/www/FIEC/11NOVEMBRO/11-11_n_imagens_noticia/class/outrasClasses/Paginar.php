<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Paginar{
    private $con;
    private $url;


    public function __construct() {
        $this->con = new Conectar();
        $this->url = new Url();
    }

    public function paginacao($numreg,$pg,$table,$pasta,$link){
        
        
        try {
        // $numreg determina quantos registros por página irão ser mostrados
        // $pg representa em que página está
        // $table - > tabela SQL
        // $local é o endereço da página
        // $pasta mostra o diretório da imagem e/ou arquivo
        //link vai ser útil em url amigável

        if (!isset($pg)) {//SE $PG NÃO UTILIZADO, VALE ZERO
            $pg = 1;// então ele assume a página 1
        }
        /*
         * EXEMPLOS BASEADOS EM PAGINAÇÃO COM 4 REGISTROS
         * $inicial = 0 * 4 => 0 (para 1ª pagina com 4 registros)
         * $inicial = 1 * 4 => 4
         * $inicial = 2 * 4 => 8
         */
        $inicial = ($pg-1) * $numreg;
        
        // executa o Select que pega o registro inicial até a quantidade de registros para página
	$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $inicial, $numreg";
       
        echo "<tr><td colspan='3'>"; 
            $this->montarNumeracao($table,$pg,$numreg,$link);
        echo "</td></tr>";
        
        $result = $this->con->query($sql);//executa o SQL
        
        //aqui montamos o resultado impresso na tela
        while($linha = $result->fetch(PDO::FETCH_NUM)) {
            echo 
            "<tr>
                <td>
                    <img src='$pasta$linha[5]' width='75px' />
                </td>  
                <td>
                    $linha[2]
                </td>
                <td>
                <a href='".$this->url->getBase()."visualizar/".$linha[9]."'>
                    &raquo; Clique aqui</a>
                </td>
            </tr>";
            
        }
        
        echo "<tr><td colspan='3'>"; 
            $this->montarNumeracao($table,$pg,$numreg,$link);
        echo "</td></tr>";
        
        }catch(PDOException $exc) {
            echo $exc->getMessage();
        }
    }//fim paginação
    
    public function montarNumeracao($table,$pg,$numreg,$link){
        //VAMOS MONTAR A PAGINAÇÃO ANTERIOR 1 2 3 PROXIMA
        $pg=$pg-1;
        
        @$res = $this->con->query("SELECT COUNT(*) FROM $table");
        @$quantreg = $res->fetchColumn();
        
        /*
         * VAI CALCULAR QTAS PAGINAS SERÃO NECESSÁRIAS NO GERAL CONFORME TOTAL DE REGISTROS
         * NA TABLE $quantreg DIVIDIDO PELO NÚMERO DE REGISTROS INDICADO NO INICIO
         */
        
        @$quant_pg = ceil($quantreg/$numreg);//ceil arredonda para valor inteiro
        
        //VAI ACRESCENTAR 1 A CONTAGEM, POIS COMEÇA EM ZERO. PARA NÃO FICAR FEIO!
	@$quant_pg=$quant_pg+1;
	
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ($pg>0){ 
            echo "<a href='".$link.$pg."'><strong>&laquo; anterior</strong></a>";
	} else { 
            echo "&laquo; anterior";
	}
	
	// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
	for($i=1;$i<$quant_pg;$i++) { 
            // Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
            if ($pg == ($i-1)) { 
                echo "&nbsp;<span>[$i]</span>&nbsp;";
            } else {
                //@$i_pg2 = $i-1;
                echo "&nbsp;<a href='".$link.$i."'><strong>$i</strong></a>&nbsp;";
            }
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($pg+2) < $quant_pg) { 
            echo "<a href='".$link.($pg+2)."'><strong>próximo &raquo;</strong></a>";
	} else { 
            echo "próximo &raquo;";
	}
    }
   
}