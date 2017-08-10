<!DOCTYPE html>
<html>
 
<?php include_once "head.php" ?>
    
<body>
	<!-- Aqui é DIV tudo -->
	<div class="tudo">
		
		<!-- DIV header, onde contém a imagem logo e o texto "FYCS" -->
		<?php include_once "header.php" ?>
                <!-- Menu -->
		
                <!-- DIV Conteúdo começa aqui -->
                <?php

if(!isset($_SESSION['sessao'])){
    echo 
       "<div class='precisalogin'>FAÇA LOGIN OU CADASTRE-SE PARA UTILIZAR ESTA FUNCIONALIDADE</div>";
    header("Location: FormUsuario.php");
}else{

?>
		<div class="conteudo">
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
	#divjanela{
		text-align:center;
	}
	</style>
                <?php include_once "class/EdFisicoForm.php" ?> 
                    <div name="mapaC" id="mapaC" >
                        
				<script type="text/javascript"
				      src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true">
				    </script>
				    <script type="text/javascript">
				    var map;
				    var geocoder;
				      function initialize(address) {
					      geocoder = new google.maps.Geocoder();
					      geocoder.geocode({'address':address}, function(results,status){

					      	if(status==google.maps.GeocoderStatus.OK){
								var mapOptions = {
						          center: results[0].geometry.location,
						          zoom: 15,
						          mapTypeId: google.maps.MapTypeId.ROADMAP
					        	};
					      	}else{
					      		var mapOptions = {
						          center: new google.maps.LatLng(-34.397, 150.644),
						          zoom: 8,
						          mapTypeId: google.maps.MapTypeId.ROADMAP
					        	};
					      	}
					        
					        map = new google.maps.Map(document.getElementById("map_cadastros"),
					            mapOptions);
							      });
						 }


				var infowindow;
				var marker;

					function markThatShit(address,nome_profissional,descricao_servico,email, telefone){

					geocoder = new google.maps.Geocoder();
					if(infowindow){
						infowindow.close();
					}
					
						geocoder.geocode({'address':address}, function(results,status){
						if(status==google.maps.GeocoderStatus.OK){
							marker = new google.maps.Marker({
							map:map,
							position:results[0].geometry.location
							});

							
							
								infowindow = new google.maps.InfoWindow({
							  content:"<div id='divjanela'><h1 id='nome_profissional' style='margin-top:0px'>"+nome_profissional+"</h1> "
							   +"<label class = 'myAss' id='descricao_servico'>"+descricao_servico+"</label><br>"
							   +"<label class = 'myAss' id='Email' style='padding-right:30px;padding-left:30px;'>"+email+" - </label><br><label class = 'myAss' id ='telefone'>"+telefone+"</label><br>"
							   +"<img src='img/emptystar.png' class='stars' id='star1' >"
							   +"<img src='img/emptystar.png' class='stars' id='star2' >"
							   +"<img src='img/emptystar.png' class='stars' id='star3' >"
							   +"<img src='img/emptystar.png' class='stars' id='star4' >"
							   +"<img src='img/emptystar.png' class='stars' id='star5' >"
							   +"<br><label class = 'myAss'>0 Avaliações</label>"
							   +"<br><input type = 'button' name='btFormMap' value ='Entre em contato!' id = 'btFormMap' style='margin-bottom:20px;'></div>"
							  });
							infowindow.open(map,marker);


						}else{
							alert("O endereço fornecido não pode ser localizado");
						}
						});
					}
					atualiza();
					mark();

				    </script>
				    <div id="map_cadastros" style="width: 100%; height: 100%; left: 0%; position: relative; overflow: hidden; -webkit-transform: translateZ(0px); background-color: rgb(229, 227, 223); "></div>

				                   
						</div>
				                
<?php
}
?>
		<!-- DIV Rodapé aqui -->
		 <?php include_once "rodape.php" ?>
	</div>

</body>
</html>