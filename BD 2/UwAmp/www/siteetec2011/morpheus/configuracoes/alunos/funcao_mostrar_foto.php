<?php
/**
    * Função para mostrar a foto de um aluno
    * @author João Carlos Lima
    * @param RM $rm Registro do aluno no banco de dados. A foto do aluno é gravada com o nome igual ao rm dele.
    * @return tag HTML que exibe a foto do aluno ou uma foto padrão se ele não foi enviada ainda
*/
function mostrarFoto($rm){
    if(isset($rm)){
        $arquivo = 0;
        if(file_exists("fotos/".$rm.".png")) $arquivo = $rm.".png";
        if(file_exists("fotos/".$rm.".gif")) $arquivo = $rm.".gif";
        if(file_exists("fotos/".$rm.".jpg")) $arquivo = $rm.".jpg";
        if(file_exists("fotos/".$rm.".jpeg")) $arquivo= $rm.".jpeg";
        if(file_exists("fotos/".$rm.".bmp")) $arquivo = $rm.".bmp";
        if ($arquivo==0) $arquivo = "sem_foto.gif";
        $agora = time(); //Jogada para evitar que navegador pegue uma foto antiga do cache
        $retorno = "<img src='fotos/$arquivo?$agora' class='img-polaroid'>";
    }
    else{
        $retorno = "<img src='fotos/sem_foto.gif' class='img-polaroid'>";
    }
    return $retorno;
}