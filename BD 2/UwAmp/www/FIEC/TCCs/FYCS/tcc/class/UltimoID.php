<?php
include_once 'Conectar.php';
$con = new Conectar();

class UltimoID {
    public function capturarId(){
        try{
            $sql = "SELECT id_profissional FROM profissional ORDER BY id_profissional DESC LIMIT 1";
            $res = $con->query($sql);

            if ($linha = $res->fetch(PDO::FETCH_NUM)) { 
                return $linha[0];
            }
        } catch (PDOException $exc) {
     echo "Erro no consultar moto último ID " . $exc->getMessage();
        
        }
    }
}
