<?php

require_once 'Conectar.php';

class Controles {

    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }

    //anti-havij
    public function limparTexto($texto) {
        $texto = str_replace(
                array("<", ">", "\\", "/", "=", "'", "?"), "", $texto
        );
        return $texto;
    }

    public function retirarAcentos($texto) {
        $url = $texto;
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
        return $url;
    }

    public function enviarArquivo($temporario, $endereco) {
        if (!move_uploaded_file($temporario, $endereco)) {
            return false;
        } else {
            return true;
        }
    }

    public function excluirArquivo($arquivo) {
        if (!unlink($arquivo)) {
            return false;
        } else {
            return true;
        }
    }

}
