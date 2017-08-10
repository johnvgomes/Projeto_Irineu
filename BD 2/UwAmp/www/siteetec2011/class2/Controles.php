<?php
require_once 'Conectar.php';

class Controles {
    
    private $con;
    
    public function __construct(){
                $this->con = new Conectar();
	}


    public function limparTexto($texto){
		$texto=str_replace(array("<", ">", "\\", "/", "=", "'", "?"), "", $texto);
		return $texto;
	}

    public function enviarArquivo($temporario, $endereco){
            if(!move_uploaded_file($temporario, $endereco)) { 
                    echo '<p>Erro no envio do arquivo</p>'; 
            } else { 
                    echo '<p>Arquivo enviado com sucesso!</p>'; 
            } 
    }

    public function excluirArquivo($arquivo){
            if(!unlink($arquivo)){
                    echo '<p>Erro ao apagar arquivo!</p>';
                    }else{
                            echo '<p>Arquivo excluído com sucesso!</p>';
                            }	
    }
    
    public function paginacao2($numreg, $tipo, $table){
        // $numreg determina quantos registros por página irão ser mostrados
        
        // $tipo para adm ou livre do site
        
        if (!isset($pg)) {//SE $PG NÃO UTILIZADO, VALE ZERO
            $pg = 0;
        }
        /*
         * EXEMPLOS BASEADOS EM PAGINAÇÃO COM 4 REGISTROS
         * $inicial = 0 * 4 => 0
         * $inicial = 1 * 4 => 4
         * $inicial = 2 * 4 => 8
         */
        $inicial = $pg * $numreg;
        
        // executa o Select que pega o registro inicial até a quantidade de registros para página
	$sql = $this->con->executar("SELECT * FROM $table ORDER BY id DESC LIMIT $inicial, $numreg");
	
        //VAMOS CONTAR O NUMERO DE REGISTROS DA TABLE TODA
        $quantreg = mysql_num_rows($this->con->executar("SELECT * FROM $table")); 
        
        $this->montarNumeracao($table,$numreg);
        echo "<br /><br />"; //só para pular linha

        while (list($i,$titulo,$conteudo,$data,$img) = mysql_fetch_array($sql)) {
            echo '<div class="direita"><img src="'.$img.'" width="75px" height="50px"  /></div>
                    <div>
                <strong>'.$titulo.'</strong> | publicado em: '.$data.'<br />
                <a href="?p=abrir.php&id='.$i.'" 
                    target="_self" title="'.$titulo.'">'.substr($conteudo,0,150).'</a>
                    </div>
                        <hr />
            ';
	}
        
        echo "<br />"; //só para pular linha
        $this->montarNumeracao($table,$numreg);

    }
    
    public function montarNumeracao($table,$numreg){
        //VAMOS MONTAR A PAGINAÇÃO ANTERIOR 1 2 3 PROXIMA
        
        $quantreg = mysql_num_rows($this->con->executar("SELECT * FROM $table"));
        
        /*
         * VAI CALCULAR QTAS PAGINAS SERÃO NECESSÁRIAS NO GERAL CONFORME TOTAL DE REGISTROS
         * NA TABLE $quantreg DIVIDIDO PELO NÚMERO DE REGISTROS INDICADO NO INICIO
         */
        
        $quant_pg = ceil($quantreg/$numreg);
        
        //VAI ACRESCENTAR 1 A CONTAGEM, POIS COMEÇA EM ZERO. PARA NÃO FICAR FEIO!
	$quant_pg++;
	
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ($pg>0){ 
            echo "<a href=".$PHP_SELF."?np=".($pg-1) ."class=pg><strong>&laquo; anterior</strong></a>";
	} else { 
            echo "&laquo; anterior";
	}
	
	// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
	for($i=1;$i<$quant_pg;$i++) { 
            // Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
            if ($pg == ($i-1)) { 
                echo "&nbsp;<span class=pgoff>[$i]</span>&nbsp;";
            } else {
                $i_pg2 = $i-1;
                echo "&nbsp;<a href=".$PHP_SELF."?np=$i_pg2 class=pg><b>$i</b></a>&nbsp;";
            }
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($pg+2) < $quant_pg) { 
            echo "<a href=".$PHP_SELF."?pg=".($pg+1)." class=pg><strong>próximo &raquo;</strong></a>";
	} else { 
            echo "próximo &raquo;";
	}
    }

    public function paginacao($num_por_pagina,$pagina,$tabela,$id,$pasta,$tipo) {
        //$tipo indica se é para mostrar no adm ou livre do site
        
        //se não houve clique nas páginas o primeiro registro é 0
        if(!$pagina){//GET capturar 0
            $primeiro_registro = 0; //nenhum registro mostrado
            $pagina = 1; //ficar na página 1
        }else{
            //$num_por_pagina indica qtos registros erão mostrados por página
            $primeiro_registro = ($pagina - 1) * $num_por_pagina;
        }

        // executar query
        $res = $this->con->executar("SELECT * FROM $tabela ORDER BY $id DESC LIMIT $primeiro_registro,$num_por_pagina");

        // exiba os registros na tela  
        //echo "<table>"; 

        while (list($i,$titulo,$conteudo,$data,$img) = mysql_fetch_array($res)) {
            if ($tipo === "adm"){
                echo '<tr><td rowspan="2"><img src="'.$pasta.$img.'" width="75px" height="50px"  /></td>
                <td><strong>'.$titulo.' </strong>| publicado em: '.$data.'</td></tr>
                    <tr><td><a href="?p=noticia/abrir.php&id='.$i.'" 
                        target="_self" title="'.$titulo.'">'.substr($conteudo,0,250).'</a><br /></td></tr>
                            <tr><td colspan="2"><hr /></td></tr>
                ';
            }else{
                echo '<tr><td rowspan="2"><img src="'.$pasta.$img.'" width="75px" height="50px"  /></td>
                <td><strong>'.$titulo.' </strong>| publicado em: '.$data.'</td></tr>
                    <tr><td><a href="?p=abrir.php&id='.$i.'" 
                        target="_self" title="'.$titulo.'">'.substr($conteudo,0,250).'</a><br /></td></tr>
                            <tr><td colspan="2"><hr /></td></tr>
                ';
            }
         }

        // construa e exiba um painel de navegabilidade entre as páginas
        $sql = $this->con->executar("SELECT COUNT(*) FROM $tabela");
        list($total_usuarios) = mysql_fetch_array($sql);

        $total_paginas = $total_usuarios/$num_por_pagina;

        $prev = $pagina - 1;
        $next = $pagina + 1;
        // se página maior que 1 (um), então temos link para a página anterior

        if ($pagina > 1) {
            if ($tipo === "adm"){    
                $prev_link = "<a href='?p=noticia/mostrar.php&np=".$prev."'>Anterior</a>";
            }else{
                $prev_link = "<a href='?p=noticia.php&np=".$prev."'>Anterior</a>";
            }
          } else { // senão não há link para a página anterior
                $prev_link = "Anterior";
          }

        if ($pagina < $total_paginas) {
            if ($tipo === "adm"){ 
                $next_link = "<a href='?p=noticia.php&np=".$next."'>Pr&oacute;xima</a>";
            }else{
                $next_link = "<a href='?p=noticia.php&np=".$next."'>Pr&oacute;xima</a>";
            }
        }else{ 
        // senão não há link para a próxima página
                $next_link = "Pr&oacute;xima";
        }

        $total_paginas = ceil($total_paginas);//arredondar ceil
          $painel = "";
          for ($x=1; $x<=$total_paginas; $x++) {
                if ($x==$pagina) { 
        // se estivermos na página corrente, não exibir o link para visualização desta página 
                  $painel .= " [$x] ";
                } else {
                     if ($tipo === "adm"){ 
                        $painel .= " <a href='?p=noticia/mostrar.php&np=".$x."'>[$x]</a>";
                     }else{
                         $painel .= " <a href='?p=noticia.php&np=".$x."'>[$x]</a>";
                     }
                }
        }
        // exibir painel na tela
        echo "<tr><td colspan='2' class='legenda'>".$prev_link." | ".$painel." | ".$next_link."<td></tr>";
        echo "<tr><td colspan='2' class='legenda'>Voc&ecirc; est&aacute; na p&aacute;gina ".$pagina." de ".$total_paginas."<td></tr>";
        echo "</table>";
    }

    public function geraColunas($pNumColunas, $pQuery) {
            //Comando::executar
            $resultado = $pQuery;
            echo ("<table cellspacing='15'>");

                    for($i = 0; $i <= mysql_num_rows($resultado); ++$i) {
                            for ($intCont = 0; $intCont < $pNumColunas; $intCont++) {
                                    $linha = mysql_fetch_array($resultado);
                                    if ($i > $linha) {
                                            if ( $intCont < $pNumColunas-1) 
                                                    echo "</tr>\n";
                                    break;
                                    }
                            $img = $linha[3];
                            $legenda = $linha[1];
                            $descricao = $linha[2];

                            if ( $intCont == 0 ) 
                                    echo "<tr>\n";

                            echo "<td>

                                    <img src='img/". $img ."' alt='".$legenda."' width='250px' height='275px' border='0' />
                                    <strong>".$legenda."</strong><br />
                                    ".$descricao."<br /><br />

                                    </td>";

                            if ( $intCont == $pNumColunas-1 ) {
                                    echo "</tr>\n";
                            } else {
                                    $i++;
                            }
                    }

            }
            echo ('</table>');
    }

}
