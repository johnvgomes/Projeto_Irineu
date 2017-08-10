$(document).ready(function(){
	 $("#cep").on('blur', function() {
          txtCEP = this.value.replace(/[^\d]+/g, '');
        $t = $(this);
        $.ajax({
            url: 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + txtCEP + '&formato=jsonp',
            dataType: 'jsonp',
            crossDomain: true,
            timeout: 5000,
            beforeSend: function() {
               // $t.after('<div class="load-field" />');
            },
            success: function(json) {
                //$('.load-field').remove();
                if (json.resultado == '0')
                    return;
                $("#cidade").val(json.cidade);
                $("#uf option").prop('selected', false);
                $("#uf option[value=" + json.uf + "]").prop('selected', true);
                $("#rua").val($.trim(json.tipo_logradouro + " " + json.logradouro));
                $("#bairro").val(json.bairro);
            getMap('map-field',$("#rua").val() + ", " + $("#bairro").val() + ", " + $("#cidade").val() + $("#uf").val() + ', Brazil',14,updateLatLong);
           //     $("#rua").trigger("change");
            },
            error: function(a, b, c) {
                $('.load-field').remove();
            }
        });
    });

   
    getMap('map-field',null,14,updateLatLong,$("#latitude").val(),$("#longitude").val());

    $("#rua, #bairro, #numero").change(function(){
      getMap('map-field',$("#rua").val() + ", " + $("#bairro").val() + ", " + $("#cidade").val() + $("#uf").val() + ', Brazil',14,updateLatLong);
    });
});

function updateLatLong(event,marker,results){
    $("input:hidden#latitude").val(marker.getPosition().lat());
    $("input:hidden#longitude").val(marker.getPosition().lng());
    /*if(results != null)
        $("#msg-lat-lng").html("<strong>Lat.:</strong> " + marker.getPosition().lat() + " - <strong>Lng.:</strong> " + marker.getPosition().lng() + "<br />" + (results[0].formatted_address));
    else
        $("#msg-lat-lng").html("teeeeeeste");*/

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

        google.maps.event.addListener(marker, 'dragend', function() {
            callbackdragend(arguments, marker, results);
        });
        callbackdragend(null, marker, null);        
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
                        console.log("No results found");
                    }
                } else {
                    console.log("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    }
}