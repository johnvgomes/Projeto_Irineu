<style type="text/css">
     <?php include_once './head.php'; ?>
      #map_cadastros { height: 100% }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-34.397, 150.644),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_cadastros"),
            mapOptions);
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_cadastros" style="width: 100%; height: 100%; left: 0%; position: relative; overflow: hidden; -webkit-transform: translateZ(0px); background-color: rgb(229, 227, 223); "></div>
