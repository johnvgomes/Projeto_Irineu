<?php
include_once "conectar.php";
$con = new Conectar;

ini_set("display_errors", 1);

$sttm = $con->prepare("SELECT id_queixas, concat(txt_rua, txt_bairro, txt_cidade,'/',txt_uf) as end, txt_categoria, txt_cep, latitude, longitude, o.icon from queixas q INNER JOIN orgao o on q.txt_categoria=o.sigla;");

$sttm->execute();

$points = array();
while($row = $sttm->fetch(PDO::FETCH_ASSOC)){


	$toolTip = '<div class="shops-list transition-all">'.
					'<div class="item ct">'.
						'<div class="title ct"><strong>'.$row['id_queixas'].'</strong></div>'.
						'<div class="text">'.$row['end'].'<br />CEP: '.$row['txt_cep'].
							'<br /><em><u>' . $row['txt_categoria'].'</u></em> <br /> '.
						'</div>'.
					'</div>'.
				'</div>';

	$points[] = array("toolTip"=> $toolTip,
		"title"=> $row['id_queixas'],
		"icon"=>"img/icons/tipos/".$row['icon'],
		"latitude"=>$row['latitude'],
		"longitude"=>$row['longitude']);
}



$sttm = NULL;

session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php include "meta.php" ?>
	<script src="js/maps.js"> </script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCl5x3OyYEBu_6SoGsre74TmfzibsmoXCQ&sensor=false&language=pt"></script>
</head>
<body>	
	<?php include "modalLogin.php";?>
	<?php include "topo.php"; ?>
	<?php include "slider.php"; ?>	
	<div id="conteudo">
		<div  class="centralizador">
			<div id="mapa" class="onlymap">
			</div>					
		</div>
	</div>

	<br class="clear"/>
</div>
<?php include "rodape.php"; ?>

<script type="text/javascript">
		$(document).ready(function(){
			//$(".form-1").simpleValidator();
			setMapPoints('mapa',<?php

					echo json_encode($points);

				?>,4);
		});

		function setMapPoints(mapa,points,zoom){
			if(points.length == 0) return;
			var geocoder = new google.maps.Geocoder();
			google.maps.visualRefresh = true;
			function init() {
				latLongCenter = new google.maps.LatLng(points[0].latitude,points[0].longitude);
				mapa = new google.maps.Map(document.getElementById(mapa), {
					//scrollwheel: true, disable scroll zoom
					center: latLongCenter,
					zoom: (isNaN(zoom) ? 14 : Number(zoom)),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				var markers = [], infoWindow = new google.maps.InfoWindow, markersToolTip = [];
				var onMarkerClick = function() {
					infoWindow.setContent(this.imovelToolTip);
					infoWindow.open(mapa, this);
				};
				google.maps.event.addListener(mapa, 'click', function() {
				  infoWindow.close(); // fecha a janelinha quando clicar no mapa
				});
				if(points != null){
					for (var i = 0; i < points.length; i++) {
						point = points[i];
						markersToolTip[i] = point.toolTip;
						markers[i] = new google.maps.Marker({
								map: mapa, 
								position: new google.maps.LatLng(point.latitude, point.longitude),
		    					animation: google.maps.Animation.DROP
							});
						markers[i].setTitle(point.title);
						markers[i].setOptions({imovelToolTip:point.toolTip});
						markers[i].setIcon(point.icon);
						google.maps.event.addListener(markers[i], 'click', onMarkerClick);
					};
					if(points.length == 1)
						setTimeout(function(){ new google.maps.event.trigger(markers[0], 'click'); } , 1000);
				}
			}
			google.maps.event.addDomListener(window, 'load', init);
		}

	</script>

</body>
</html>
