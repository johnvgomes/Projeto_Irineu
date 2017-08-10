<?php
session_start();
?>                                                                                        
<!DOCTYPE html>                                                            
<html lang="pt-br">
<head>
  <?php include "meta.php" ?>
   <script type="text/javascript" src="./js/jquery-1.3.2.js"></script> 
  <?php include "meta_pagination.php" ?>
</head>
<body><?php include "loaderscreen.php"; 
  include "slider.php"; 
  include "topo.php";?>
  <div id="conteudo">
    <div  class="centralizador">
      <div id="form">
      <div align="center" class="titulo">Queixas</div>
      <div id="loading"></div>
      <div id="container">
        <div class="data"></div>
        <div class="pagination"></div>
      </div>
    </div>
  </div>
  <br class="clear"/>
</div>    
<?php include "rodape.php" ?>
</body>
</html>
