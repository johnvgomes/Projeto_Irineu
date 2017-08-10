function setMapPoints(mapa,points,zoom){
	//var mapa;
	var geocoder = new google.maps.Geocoder();

	google.maps.visualRefresh = true;

	function init() {

		latLongCenter = (points.length == 1 ? (new google.maps.LatLng(points[0].latitude,points[0].longitude)) : (new google.maps.LatLng(-23.085841,-47.20217)));


		mapa = new google.maps.Map(document.getElementById(mapa), {
			scrollwheel: false, // disable scroll zoom
			center: latLongCenter,
			zoom: (isNaN(zoom) ? 14 : Number(zoom)),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		
		var markers = [];
		var infoWindow = new google.maps.InfoWindow;

		var onMarkerClick = function() {
			//var latLng = this.getPosition(); latLng.lat() / latLng.lng()
			infoWindow.setContent(this.imovelToolTip);
			infoWindow.open(mapa, this);
		};
		google.maps.event.addListener(mapa, 'click', function() {
		  infoWindow.close(); // fecha a janelinha quando clicar no mapa
		});
		
		var markersToolTip = [];
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
				/*google.maps.event.addListener(markers[i], 'mouseup', function(){
					m = this;
					m.setAnimation(google.maps.Animation.j);
					setTimeout(function(){
						m.setAnimation(null);
					},600);
				});*/
			};
			if(points.length == 1) {
				setTimeout(function(){ new google.maps.event.trigger(markers[0], 'click'); } , 1000);
			}
		}
	}
	google.maps.event.addDomListener(window, 'load', init);

}

function getLatLong(address, geocoder){
	if (geocoder != null) {
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {

					return results[0];

					map.setCenter(results[0].geometry.location);

					var infowindow = new google.maps.InfoWindow(
						{ content: '<b>'+address+'</b>',
						size: new google.maps.Size(150,50)
					});

					var marker = new google.maps.Marker({
						position: results[0].geometry.location,
						map: map, 
						title:address
					}); 
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					});

				} else {
					cout("No results found");
				}
			} else {
				cout("Geocode was not successful for the following reason: " + status);
			}
		});
	}
}

function getMap(mapid,address,zoom,callbackdragend,lat,lng){

	var k = function(lat,lng,results){
		google.maps.visualRefresh = true;

		map = new google.maps.Map(document.getElementById(mapid), {
			zoom: (isNaN(zoom) ? 14 : Number(zoom)),
			center: new google.maps.LatLng(lat,lng),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		//map.setCenter(results[0].geometry.location);
		
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat, lng),
			map: map, 
			title:address,
			draggable: true
		}); 

		var infowindow = new google.maps.InfoWindow({
			content: '<b>'+address+'</b>'/*,
			size : new google.maps.Size(150,50)*/
		});

		//google.maps.event.addListener(marker, 'dragstart', function() {});
		//google.maps.event.addListener(marker, 'drag', function() {});
		//google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});

		if(typeof callbackdragend == 'function')
			google.maps.event.addListener(marker, 'dragend', function() {
				callbackdragend(arguments, marker, results);
			});
		
	}

	var geocoder = new google.maps.Geocoder();
	if (geocoder != null) {
		if(lat != undefined && lng != undefined){

			k(lat, lng, null);

		}else{
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {

						k(results[0].geometry.location.lat(), results[0].geometry.location.lng(),results);

					} else {
						cout("No results found");
					}
				} else {
					cout("Geocode was not successful for the following reason: " + status);
				}
			});
		}
	}
}
/**
  * @function loadFullMap
  * @description Carrega um mapa com todos os imóveis
  */
function loadFullMap(mapid,url){
	$.ajax({
		url : url + "json/imoveis",
		dataType: 'json',
		success : function(data){
			setMapPoints(mapid,data,8);
		},
		error : function(){
			setMapPoints(mapid,null,8);
		}

	})
}