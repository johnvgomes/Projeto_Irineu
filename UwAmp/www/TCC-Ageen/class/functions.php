<?php 

function getusername($id,$nome,$sobrenome){
    
   $query = mysql_query("SELECT $nome, $sobrenome FROM usuario Where id_usuario='$id'");
   $run = mysql_fetch_array($query);
   return $run[$nome];
   
    
}



function getuser($id,$fild){
    
   $query = mysql_query("SELECT $fild FROM usuario Where id_usuario='$id'");
   $run = mysql_fetch_array($query);
   return $run[$fild];
    
}

        ?>