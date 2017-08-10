<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doce Feitiço</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



    <!-- ===== HEADER ===== -->
    <header>
        <div class="wrap">            
            <img src="img/logo.png" alt="" class="logo">

            <nav>
                <a href="index.php" class="act">Home</a>
                <a href="sobre.php">Sobre</a>
                <a href="faleconosco.php">Fale Conosco</a>
            </nav>
            
        </div>
    </header>


    <?php
	
		 // Conexão
        $con = new PDO("mysql:host=localhost;dbname=doce_feitico", "root", "root"); 
        $con->exec("set names utf8");

    ?>





    <!-- ===== CONTENT ===== -->

    <div class="all-content">

        <div class="wrap">

            <div class="content">
               
                <h2>AÇAÍ | CUPUAÇU</h2>
                <img src="img/acai/1.jpg" alt="">
                <img src="img/acai/2.jpg" alt="">
                <img src="img/acai/3.jpg" alt="">
                <img src="img/acai/4.jpg" alt="">

                <div class="internal-content">
                    <h3>PREÇOS</h3>    
                    <table>
                            <?php
                                
                                $rs = $con->query('select produtos.name, acai.valor FROM produtos INNER JOIN acai ON produtos.id=acai.id_produto'); 

                                // Array value and Name
                                $val = array();
                                $name = array();
                                
                                while($row = $rs->fetch(PDO::FETCH_OBJ)){
                                    $val[] = '<td class="val-bold">'.$row->valor.'</td>';
                                    $name[] = '<td>'.$row->name.'</td>';
                                }

                            ?>
                        <tr>
                            <?php                                
                                print implode('</td>', $name);
                            ?>                            
                        </tr> 
                        <tr>
                            <?php                                
                                print implode('</td>', $val);
                            ?>
                        </tr>                       
                    </table>
                </div>
            </div>



            <div class="content">
                <h2>SALADA DE FRUTAS</h2>
                <img src="img/salada-de-frutas/1.jpg" alt="">
                <img src="img/salada-de-frutas/2.jpg" alt="">
                <img src="img/salada-de-frutas/3.jpg" alt="">
                <img src="img/salada-de-frutas/4.jpg" alt="">

                <div class="internal-content">
                    <h3>PREÇOS</h3>    
                    <table>
                            <?php
                                
                                $rs = $con->query('select produtos.name, salada_de_frutas.valor FROM produtos INNER JOIN salada_de_frutas ON produtos.id=salada_de_frutas.id_produto'); 

                                // Array value and Name
                                $val = array();
                                $name = array();
                                
                                while($row = $rs->fetch(PDO::FETCH_OBJ)){
                                    $val[] = '<td class="val-bold">'.$row->valor.'</td>';
                                    $name[] = '<td>'.$row->name.'</td>';
                                }

                            ?>
                        <tr>
                            <?php                                
                                print implode('</td>', $name);
                            ?>                            
                        </tr> 
                        <tr>
                            <?php                                
                                print implode('</td>', $val);
                            ?>
                        </tr>                       
                    </table>
                </div>
            </div>
    

        </div>

    </div>

</body>
</html>