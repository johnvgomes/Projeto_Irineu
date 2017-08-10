<?php

require_once 'Conectar.php';

class Controles {

    //put your code here
    private $con;

    public function __construct() {
        $this->con = new Conectar();
    }

    //havij
    public function limparTexto($texto) {
        $texto = str_replace(
                array("<", ">", "\\", "/", "=", "'", "?", "!"), "", $texto
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
    
    public function enviarArquivo($temporario, $endereco){
        if(!move_uploaded_file($temporario, $endereco)) { 
            echo '<br /><p>Erro no envio do arquivo</p>'; 
        } else { 
            echo '<br /><p>Arquivo enviado com sucesso!</p>'; 
        } 
    }
    
    public function excluirArquivo($arquivo){
        if(!unlink($arquivo)){
            echo '<p>Erro ao apagar arquivo!</p>';
        }else{
            echo '<p>Arquivo excluído com sucesso!</p>';
        }	
    }

}
