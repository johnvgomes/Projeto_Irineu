<?php

class Conectar extends PDO {

    private static $instancia;
    private $query;
    private $host = "localhost";
    //private $host = "182.10.5.4";
    private $usuario = "root";
    //private $usuario = "site123456";
    private $senha = "root";
    private $db = "2tifiec";

    public function __construct() {
        parent::__construct("mysql:host=$this->host;dbname=$this->db", "$this->usuario", "$this->senha");
    }

    public static function getInstance() {
        // Se o a instancia não existe eu faço uma
        if (!isset(self::$instancia)) {
            try {
                self::$instancia = new Conectar;
            } catch (Exception $e) {
                echo 'Erro ao conectar';
                exit();
            }
        }
        // Se já existe instancia na memória eu retorno ela
        return self::$instancia;
    }

    public function sql($query) {
        $this->getInstance();
        $this->query = $query;
        $stmt = $pdo->prepare($this->query);
        $stmt->execute();
        $pdo = null;
    }

}

?>
