<?php

class Controles {

    public function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if (empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = ereg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
                $cpf == '11111111111' ||
                $cpf == '22222222222' ||
                $cpf == '33333333333' ||
                $cpf == '44444444444' ||
                $cpf == '55555555555' ||
                $cpf == '66666666666' ||
                $cpf == '77777777777' ||
                $cpf == '88888888888' ||
                $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

//havij
    public function limparTexto($texto) {
        $texto = str_replace(
                array("<", ">", "\\", "/", "=", "'", "?","!","\""), "", $texto
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
    
    public function moeda($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        //remove os pontos e substitui a virgula pelo ponto
        $valor = str_replace($source, $replace, $get_valor);
        return $valor;
    }

}
