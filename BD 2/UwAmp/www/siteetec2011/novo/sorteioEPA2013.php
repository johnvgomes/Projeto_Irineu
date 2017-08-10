<form id="frm" name="frm" method="post" action="">
  <table>
    <tr>
      <td colspan="2"><h3>Sorteio - EPA ETEC Itu 2013</h3></td>
    </tr>
    
    <tr>
      <td colspan="2">
          <input name="btnsorteio" type="submit" 
                 id="sorteio" value="sorteio"   />
      </td>
    </tr>
  </table>
</form>

<?php
if(isset($_POST['btnsorteio']) ){
    require_once 'class/Epa.php';
    $e = new Epa();
    $e->sorteio();
    
    echo "<h2>Data do sorteio: ".date('d/m/Y')."<br />
        Horário: ".date('h:i:s A')."</h2>";
}

?>