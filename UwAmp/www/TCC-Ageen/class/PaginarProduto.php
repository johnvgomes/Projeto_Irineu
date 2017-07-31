<?php

include_once 'Conectar.php';
include_once 'Url.php';

class Paginar {

    private $con;
    private $url;

    public function __construct() {
        $this->con = new Conectar();
        $this->url = new Url();
    }

    public function paginacao($numreg, $pg, $table1, $table2, $pasta, $link, $imagem, $nome, $url, $valorunit, $estoque, $class) {

        try {
            // $numreg determina quantos registros por página irão ser mostrados
            // $pg representa em que página está
            // $table1 - > tabela SQL
            // $table2 - > tabela SQL com FK
            // $local é o endereço da página
            // $pasta mostra o diretório da imagem e/ou arquivo
            //link vai ser útil em url amigável

            if (!isset($pg)) {//SE $PG NÃO UTILIZADO, VALE ZERO
                $pg = 1; // então ele assume a página 1
            }
            /*
             * EXEMPLOS BASEADOS EM PAGINAÇÃO COM 4 REGISTROS
             * $inicial = 0 * 4 => 0 (para 1ª pagina com 4 registros)
             * $inicial = 1 * 4 => 4
             * $inicial = 2 * 4 => 8
             */
            $inicial = ($pg - 1) * $numreg;

            // executa o Select que pega o registro inicial até a quantidade de registros para página
            $sql = "SELECT $table1.*, $table2.* FROM $table1,$table2 
            WHERE $table1.id = $table2.id_produto
            GROUP BY $table1.id
            ORDER BY $table1.id DESC LIMIT $inicial, $numreg";

            //$this->montarNumeracao($table1, $pg, $numreg, $link);

            $result = $this->con->query($sql); //executa o SQL
            //aqui montamos o resultado impresso na tela
            $i = 1;

            while ($linha = $result->fetch(PDO::FETCH_NUM)) {
                echo
                "<article class='$class'>"
                . " <br>Nome: "
                . substr($linha[$nome], 0, 80)
                . "<br><span>Valor Unitario: "
                . number_format($linha[$valorunit], 2, ',', '.')
                . "</span>"
               . "<br><span>Estoque: "
                . number_format($linha[$estoque], 2, ',', '.')
                . "</span>"
                . " <br><a href = '" . $this->url->getBase() . "visualizarp/" . $linha[$url] . "' > "
                . "visualizar ficha"
                . " </a>"
                . " </article>";
                $i++;
            }
            echo "<article class = 'numeracao'>";
            $this->montarNumeracao($table1, $pg, $numreg, $link);
            echo "</article>";
        } catch (PDOException $exc) {
            echo $exc->getMessage
            ();
        }
    }

//fim paginação

    public function montarNumeracao($table1, $pg, $numreg, $link) {
        //VAMOS MONTAR A PAGINAÇÃO ANTERIOR 1 2 3 PROXIMA

        $pg = $pg - 1;

        //recuperar número da página
        session_start();
        $_SESSION['pagina'] = $pg + 1;
        //recuperar número da página

        @$res = $this->con->query("SELECT COUNT(*) FROM $table1");
        @$quantreg = $res->fetchColumn();

        /*
         * VAI CALCULAR QTAS PAGINAS SERÃO NECESSÁRIAS NO GERAL CONFORME TOTAL DE REGISTROS
         * NA TABLE $quantreg DIVIDIDO PELO NÚMERO DE REGISTROS INDICADO NO INICIO
         */

        @$quant_pg = ceil($quantreg / $numreg); //ceil arredonda para valor inteiro
        //VAI ACRESCENTAR 1 A CONTAGEM, POIS COMEÇA EM ZERO. PARA NÃO FICAR FEIO!
        @$quant_pg = $quant_pg + 1;

        // Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
        if ($pg > 0) {
            echo "<div class = 'nrpagina'><a href = '" . $link . $pg . "' > <strong>&laquo;
                anterior</strong></a></div>";
        } else {
            echo "<div class = 'nrpagina'>&laquo;
                anterior</div>";
        }

        // Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
        for ($i = 1; $i < $quant_pg; $i++) {
            // Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
            if ($pg == ($i - 1)) {
                echo "<div class = 'nrpagina'>&nbsp;
                <span>$i</span>&nbsp;
                </div>";
            } else {
                //@$i_pg2 = $i-1;
                echo "<div class = 'nrpagina'>&nbsp;
                <a href = '" . $link . $i . "' > <strong>$i</strong></a>&nbsp;
                </div>";
            }
        }

        // Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
        if (($pg + 2) < $quant_pg) {
            echo "<div class = 'nrpagina'><a href = '" . $link . ($pg + 2) . "' > <strong>próximo &raquo;
                </strong></a></div>";
        } else {
            echo "<div class = 'nrpagina'>próximo &raquo;
                </div>";
        }
    }

}
