<form name="formget" id="frm" method="get">
    <input type="hidden" name="p" value="formGet">
    <label>Nome</label><br>
    <input type="text" size="50" maxlength="60"
           name="txtnome">
    <br><br>
    <label>E-mail</label><br>
    <input type="email" size="50" name="txtemail">
    <br><br>
    <label>Sexo</label><br>
    <input type="radio" name="rdbsexo" 
           value="Masculino" id="rdbsexo" 
           checked> Masculino
    <br>
    <input type="radio" name="rdbsexo" 
           value="Feminino" id="rdbsexo"> Feminino
    <br><br>
    <input type="submit" value="Enviar" name="btn"
           id="btn">    
</form>
<?php
if (isset($_GET['btn'])) {
    //echo "Você clicou";
    echo "<div class='resultado'>"
    . "Nome: " . $_GET['txtnome']
    . "<br>E-mail: " . $_GET['txtemail']
    . "<br>Sexo: " . $_GET['rdbsexo']
    . "</div>";
}
?>