<?php

include_once '../class/Conectar.php';
class consulta{
    private $con;

    public function __construct() {
          $this->con = new Conectar();
    }

public function consultar(){

        try {
            $sql = "select id_categoria from categoria where nome_categoria = '".$_POST['txtcategoria']."'";
            
            $res = $this->con->query($sql);
            
           $linha = $res->fetch(PDO::FETCH_NUM);
           //     echo  $linha[0];
				
			$sql = "select endereco.rua, endereco.numero, endereco.cidade, profissional.nome, profissional.descricao_servico,email.endereco_email, telefone.numero, profissional.id_profissional from profissional inner join endereco inner join email inner join telefone on profissional.id_profissional=endereco.id_profissional and profissional.id_profissional=email.id_profissional and profissional.id_profissional=telefone.id_profissional where profissional.id_categoria=".$linha[0]." and status='ATIVO'";

            $res = $this->con->query($sql); 
				if(empty($res)){
					echo"empty";
				}else{
				
			echo 'var profissional = [';
            while($linha = $res->fetch(PDO::FETCH_NUM)){

		 $sql = "select round(sum(avaliacao)/sum(qtde_votos)) as media,sum(qtde_votos) from avaliacao where id_profissional = ".$linha[7];
            $result = $this->con->query($sql);
           $row = $result->fetch(PDO::FETCH_NUM);
           if($row[0]==null){
           	$row[0]=0;
           	$row[1]=0;
           }

			echo '["'.utf8_encode($linha[0]).', '.utf8_encode($linha[1]).', '.utf8_encode($linha[2]).'", "'.utf8_encode($linha[3]).'", "'.utf8_encode($linha[4]).'", "'.utf8_encode($linha[5]).'", "'.utf8_encode($linha[6]).'", "'.utf8_encode($linha[7]).'", "'.utf8_encode($row[0]).'", "'.utf8_encode($row[1]).'"], ';
            }
			echo "];";
			}
			
			
			
			
        } catch (PDOException $exc) {
            echo "Erro no consultar de profissional " . $exc->getMessage();
        }
    }
		public function __destruct() {
			 $this->con = "";
		}
	}
		$consulta = new consulta();
		
 
?>
<!DOCTYPE HTML>
<html>

<head>
	<style>
	.stars{
		width:20px;
	}
	.myAss{
		font-weight: bold;
		font-size: 18px;
	}
	#btFormMap{
	 font-size: 21px;
        font-family:arial;
        font-weight:bold;
        color:white;
        
	 background: #3C454A;
        border-radius:4px;
        
	 border-color: #FFFFFF; 
        
	 width: 273px;
        
	 height: 41px;

}
	</style>
<link rel="stylesheet" type="text/css" href="../css/mapa.css">
<meta charset="utf-8">
<script type="text/javascript">
						function mudaEstrela(valor){
						if(valor==0){
							document.getElementById('star1').src="../img/emptystar.png";
							document.getElementById('star2').src="../img/emptystar.png";
							document.getElementById('star3').src="../img/emptystar.png";
							document.getElementById('star4').src="../img/emptystar.png";
							document.getElementById('star5').src="../img/emptystar.png";
						}
						if(valor == 1){
							document.getElementById('star1').src="../img/fullstar.png";
						}
						if(valor == 2){
							document.getElementById('star1').src="../img/fullstar.png";
							document.getElementById('star2').src="../img/fullstar.png";
						} 
						if(valor == 3){
							document.getElementById('star1').src="../img/fullstar.png";
							document.getElementById('star2').src="../img/fullstar.png";
							document.getElementById('star3').src="../img/fullstar.png";
						} 
						if(valor == 4){
							document.getElementById('star1').src="../img/fullstar.png";
							document.getElementById('star2').src="../img/fullstar.png";
							document.getElementById('star3').src="../img/fullstar.png";
							document.getElementById('star4').src="../img/fullstar.png";
						} 
						if(valor == 5){
							document.getElementById('star1').src="../img/fullstar.png";
							document.getElementById('star2').src="../img/fullstar.png";
							document.getElementById('star3').src="../img/fullstar.png";
							document.getElementById('star4').src="../img/fullstar.png";
							document.getElementById('star5').src="../img/fullstar.png";
						}  

	}
</script>
		
<title>Find your closest solution</title>
<!--fuck-->
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript">
    function initGeolocation()
    {
            if( navigator.geolocation )
            {

              // Call getCurrentPosition with success and failure callbacks
              navigator.geolocation.getCurrentPosition( success, fail);
        }
        else
        {
              alert("ESTE NAVEGADOR NAO SUPORTA O SERVICO DE GEOPOSICIONAMENTO");
        }
    }

	var map;
     function success(position)
     {
           // Define the coordinates as a Google Maps LatLng Object
           var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

           // Prepare the map options
           var mapOptions =
          {
                      zoom: 15,
                      center: coords,
                      mapTypeControl: true,
                      navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                      mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            // Create the map, and place it in the map_canvas div
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
			
			var image='../img/marker.png';
			// Place the initial marker
            var marker = new google.maps.Marker({
                      position: coords,
                      map: map,
                      title: "Your current location!",
					  icon:image
					  });

				var geocoder;
				geocoder = new google.maps.Geocoder();
					
				var infowindow;
					function markThatShit(address,nome_profissional,descricao_servico,email, telefone,id_profissional,media,total){
						geocoder.geocode({'address':address}, function(results,status){
						if(status==google.maps.GeocoderStatus.OK){
							var marker = new google.maps.Marker({
							map:map,
							position:results[0].geometry.location,
 							icon:'../img/markerP.png'
							});

							google.maps.event.addListener(marker, 'click', function() {
							  if(infowindow){
							  	infowindow.close();
							  }else{


							  }
							  });
							
							google.maps.event.addListener(marker, 'click', function() {
								infowindow = new google.maps.InfoWindow({
							  content:"<form method='post' action='../FormAvaliacao.php'><h1 id='nome_profissional' style='margin-top:0px'>"+nome_profissional+"</h1> "
							   +"<label class = 'myAss' id='descricao_servico'>"+descricao_servico+"</label><br>"
							   +"<label class = 'myAss' id='Email' style='padding-right:30px;padding-left:30px;'>"+email+" - </label><br><label class = 'myAss' id ='telefone'>"+telefone+"</label><br>"
							   +"<img src='../img/emptystar.png' class='stars' id='star1' onload='mudaEstrela("+media+")'>"
							   +"<img src='../img/emptystar.png' class='stars' id='star2' >"
							   +"<img src='../img/emptystar.png' class='stars' id='star3' >"
							   +"<img src='../img/emptystar.png' class='stars' id='star4' >"
							   +"<img src='../img/emptystar.png' class='stars' id='star5' >"
							   +"<br><label class = 'myAss'>"+total+" Avaliações</label>"
							   +"<input type='hidden' name='id_profissional' value='"+id_profissional+"'>"
							   +"<br><input type = 'submit' name='btFormMap' value ='Entre em contato!' id = 'btFormMap' style='margin-bottom:20px;'>"
							  });
							  infowindow.open(map,marker);
							  });	
							
						}else{
						}
						});
						
						
					}
					  
					  
					  
					  //fuck
					  	<?php	$consulta->consultar(); ?>

						for(i=0;i<profissional.length;i++){
							markThatShit(profissional[i][0], profissional[i][1],profissional[i][2],profissional[i][3],profissional[i][4],profissional[i][5],profissional[i][6],profissional[i][7]);
						}

			}

        function fail()
        {
              alert("Could not obtain location");
        }
		
		
		
		
        </script>

</head>

<div>
    <body onload="initGeolocation()" >
	<center><form method="post" action="map.php">	
                <input  id="busca" type="button" onclick="location.href='../index.php'" value= "Inicio">
		<input style="height: 40px; width: 500px; margin-bottom: 40px;" id="crap" type="text" name="txtcategoria">
                
		<input  id="busca" type="submit" value= "Busca">
	</form></div></center>

<center><div id="map_canvas" style="border-right: 1px solid #666666; border-bottom: 1px solid #666666; border-top: 1px solid #AAAAAA; border-left: 1px solid #AAAAAA;"></div></center>



</body>
</html>

