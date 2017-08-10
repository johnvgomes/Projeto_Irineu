
<?php


if(!isset($_SESSION['sessao'])){
  echo 
    "<div class='precisalogin'>FAÇA LOGIN OU CADASTRE-SE PARA UTILIZAR ESTA FUNCIONALIDADE</div>";
}else{
include_once './class/Conectar.php';
$con = new Conectar();
try {
			$sql = "select profissional.nome, profissional.descricao_servico, email.endereco_email, telefone.numero, endereco.rua, endereco.numero, endereco.cidade,profissional.id_profissional
					 from profissional
					 inner join endereco
					 inner join email
					 inner join telefone
					 on profissional.id_profissional=endereco.id_profissional and profissional.id_profissional=email.id_profissional and profissional.id_profissional=telefone.id_profissional
					 where profissional.id_profissional=".$_POST['id_profissional'];

            $res=$con->query($sql); 
				
				
			$linha = $res->fetch(PDO::FETCH_NUM);
			echo "<div id='dados_profissional'>";
			echo "<h2>".utf8_encode($linha[0])."</h2>";
			echo "<label>".utf8_encode($linha[1])."</label><br>";
			echo "<label>".utf8_encode($linha[2])."</label><br>";
			echo "<label>".utf8_encode($linha[3])."</label><br>";
			echo "<label>".utf8_encode($linha[4]).", </label>";
			echo "<label>".utf8_encode($linha[5]).", </label>";
			echo "<label>".utf8_encode($linha[6])."</label><br>";
			echo "</div>";
			
			
			
        } catch (PDOException $exc) {
            echo "Erro no consultar de profissional " . $exc->getMessage();
        }


?>


<style>
.stars{
	width:20px;
}
</style>

<script type = "text/javascript">
	function mudaEstrela(valor){
		if(valor==0){
			document.getElementById('star1').src="img/emptystar.png";
			document.getElementById('star2').src="img/emptystar.png";
			document.getElementById('star3').src="img/emptystar.png";
			document.getElementById('star4').src="img/emptystar.png";
			document.getElementById('star5').src="img/emptystar.png";
		}
		if(valor == 1){
			document.getElementById('star1').src="img/fullstar.png";
		}
		if(valor == 2){
			document.getElementById('star1').src="img/fullstar.png";
			document.getElementById('star2').src="img/fullstar.png";
		} 
		if(valor == 3){
			document.getElementById('star1').src="img/fullstar.png";
			document.getElementById('star2').src="img/fullstar.png";
			document.getElementById('star3').src="img/fullstar.png";
		} 
		if(valor == 4){
			document.getElementById('star1').src="img/fullstar.png";
			document.getElementById('star2').src="img/fullstar.png";
			document.getElementById('star3').src="img/fullstar.png";
			document.getElementById('star4').src="img/fullstar.png";
		} 
		if(valor == 5){
			document.getElementById('star1').src="img/fullstar.png";
			document.getElementById('star2').src="img/fullstar.png";
			document.getElementById('star3').src="img/fullstar.png";
			document.getElementById('star4').src="img/fullstar.png";
			document.getElementById('star5').src="img/fullstar.png";
		}  

	}
</script>
<div id="estrelas">
<form action="" method="post">
	<input type="image" src="img/emptystar.png" class="stars" name="star1" id="star1" onmouseover="mudaEstrela(1)" onmouseout="mudaEstrela(0)" value=1>
	<input type="image" src="img/emptystar.png" class="stars" name="star2" id="star2" onmouseover="mudaEstrela(2)" onmouseout="mudaEstrela(0)" value=2>
	<input type="image" src="img/emptystar.png" class="stars" name="star3" id="star3" onmouseover="mudaEstrela(3)" onmouseout="mudaEstrela(0)" value=3>
	<input type="image" src="img/emptystar.png" class="stars" name="star4" id="star4" onmouseover="mudaEstrela(4)" onmouseout="mudaEstrela(0)" value=4>
	<input type="image" src="img/emptystar.png" class="stars" name="star5" id="star5" onmouseover="mudaEstrela(5)" onmouseout="mudaEstrela(0)" value=5>
	<input type="hidden" value=<?php echo "'".$_POST['id_profissional']."'"; ?> name="id_profissional">

</form>
</div>
<?php
	$valor = 0;

	if(isset($_POST["star1"])){
	$valor = $_POST["star1"];
	}
	if(isset($_POST["star2"])){
	$valor = $_POST["star2"];
	}
	if(isset($_POST["star3"])){
	$valor = $_POST["star3"];
	}
	if(isset($_POST["star4"])){
	$valor = $_POST["star4"];
	}
	if(isset($_POST["star5"])){
	$valor = $_POST["star5"];
	}

	if($valor != 0){

	try{
	$sql = "select * from avaliacao where usuarionome='".$_SESSION['NomeUsuario']."' and id_profissional=".$_POST['id_profissional'];
	$res = $con->query($sql); 
		if($row = $res->fetch(PDO::FETCH_NUM)){
	    echo "<div class='avaliacaomsg'><label>Você já avaliou esse profissional</label></div>";
		
		}else{

		$sql = "INSERT INTO avaliacao (avaliacao,qtde_votos,usuarionome,id_profissional) values (".$valor.",1, '".$_SESSION['NomeUsuario']."',".$_POST['id_profissional'].")";
	    $con->exec($sql);
	    echo "<div class='avaliacaomsg'><label>Obrigado por avaliar</label></div<";
	    }

		}catch (PDOException $exc) {
        echo "Erro ao avaliar, tente novamente mais tarde" . $exc->getMessage();
	    }
	}
}
?>