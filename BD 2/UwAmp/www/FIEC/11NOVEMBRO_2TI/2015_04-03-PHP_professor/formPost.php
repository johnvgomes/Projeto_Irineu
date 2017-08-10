<form name="formpost" id="frm" method="post">
    <label>Nome</label><br>
    <input type="text" size="50" maxlength="60"
           name="txtnome">
    <br><br>
    <label>E-mail</label><br>
    <input type="email" size="50" name="txtemail">
    <br><br>
    <input type="submit" value="Enviar" name="btn"
           id="btn">    
</form>
<?php
if (isset($_POST['btn'])) {
    //echo "Você clicou";
    echo "<div class='resultado'>"
    . "Nome: " . $_POST['txtnome']
    . "<br>E-mail: " . $_POST['txtemail']
    . "</div>";
}
?>