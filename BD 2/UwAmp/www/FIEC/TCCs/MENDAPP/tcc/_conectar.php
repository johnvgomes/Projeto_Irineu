<?php
class Conectar extends PDO {
    private static $instancia;
    private $query;
    private $host = "robb0187.publiccloud.com.br";
    //private $host = "endereco.com.br";
    private $usuario = "ene_s_tcc";
    //private $usuario = "site123456";
    private $senha = "fiec@2014";
    private $db = "ene_sa_tcc_fiec";
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
