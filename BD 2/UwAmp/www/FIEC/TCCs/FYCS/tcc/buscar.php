<?php
include_once './head.php';

include_once 'class/Conectar.php';

class consultaCat {

    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }

    public function consultarCat() {

        try {

            $sql = "select nome_categoria from categoria";

            $res = $this->con->query($sql);

            while ($linha = $res->fetch(PDO::FETCH_NUM)) {
                echo utf8_encode('"' . $linha[0] . '", ');
            }
        } catch (PDOException $exc) {
            echo "Erro no consultar de categoria " . $exc->getMessage();
        }
    }

    public function __destruct() {
        $this->con = "";
    }

}

$consulta = new consultaCat();
?>


<div class="posPesquisa">
    <div id='search-box'>
        <form action='pages/map.php' id='search-form' method='post' target='_top'>
            <div class="search">
                <input id='search-text' name='txtcategoria'  placeholder='Digite o serviço ou profissional desejado' type='text'required/>
                <input id ="botaobusca" type="submit" value="BUSCAR"/>
            </div>
            <style type="text/css">
                .ui-autocomplete {
                    max-height: 200px;
                    overflow-y: auto;
                    overflow-x: hidden;
                    padding-right: 20px;
                }
            </style>
            <script>
                $(document).ready(function() {
                    $(function() {
                        var categoria = [
<?php
$consulta->consultarCat();
?>

                        ];
                        $("#search-text").autocomplete({source: categoria});
                    });
                });

            </script>
        </form>
    </div>
</div>