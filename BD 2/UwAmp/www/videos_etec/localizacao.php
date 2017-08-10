
<body onload="getLocation()">

    <div id="mapholder"></div>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
    var x = document.getElementById("demo");
    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition, showError);

        }
        else {
            x.innerHTML = "Geolocalização não é suportada nesse browser.";
        }
    }

    function showPosition(position)
    {
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        document.cookie = "latitude=" + lat;
        document.cookie = "longitude=" + lon;

        latlon = new google.maps.LatLng(lat, lon)
        mapholder = document.getElementById('mapholder')
        mapholder.style.height = '320px';
        mapholder.style.width = '100%';



        var myOptions = {
            center: latlon, zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL}
        };
        var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
        var marker = new google.maps.Marker({position: latlon, map: map, title: "Você está Aqui!"});
    }

    function showError(error)
    {
        switch (error.code)
        {
            case error.PERMISSION_DENIED:
                x.innerHTML = "Usuário rejeitou a solicitação de Geolocalização."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Localização indisponível."
                break;
            case error.TIMEOUT:
                x.innerHTML = "O tempo da requisição expirou."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "Algum erro desconhecido aconteceu."
                break;
        }
    }
    </script>

</body>

<?php
echo "Latitude: "
 . @$_COOKIE['latitude']
 . "<br>"
 . "Longitude: "
 . @$_COOKIE['longitude']
 . "<br><br>"
 . "habilite os cookies do seu navegador";
?>

