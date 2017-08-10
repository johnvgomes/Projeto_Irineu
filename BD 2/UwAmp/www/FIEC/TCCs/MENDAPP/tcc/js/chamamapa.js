$(document).ready(function(){
	function initialize()
	{
		var mapProp = {
			center:new google.maps.LatLng(-23.0433092,-47.3686041),
			zoom:10,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map=new google.maps.Map(document.getElementById("mapa")
			,mapProp);
		var image ='img/pointer.png';
		var myLatLng = new google.maps.LatLng(-23.0888123,-47.2306531);
		
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon:image,
			title:"FIEC"

		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
});