<form method="post" name="fcli" id="fcli">
    <label>ID</label>
    <input type="number" name="txtid" id="txtid">
    <br>
    <label>Nome</label>
    <input type="text" name="txtnome" id="txtnome">
    <br>
    <label>Salário</label>
    <input type="text" name="txtsalario" 
           id="txtsalario">
    <br>
    <input type="submit" name="btnenviar" 
           id="btnenviar">      
</form>


<?php
if(isset($_POST['btnenviar'])){
    extract($_POST,EXTR_OVERWRITE);
    
    //incluir a class
    include_once 'class/Cliente.php';
    
    //cria copia/objeto da class
    $cli = new Cliente();
    
    $cli->setId($txtid);
    $cli->setNome($txtnome);
    $cli->setSalario($txtsalario);
    
    echo "ID ".$cli->getId()."<br>".
            "Nome ".$cli->getNome()."<br>".
            "Salário ".$cli->getSalario();
}


?>
