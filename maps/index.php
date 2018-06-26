<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 600px;
		width:600px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script language="javascript" src="js/jquery-1.7.2.min.js"></script>
    <script language="javascript" src="js/fancywebsocket.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

    <script>


var map;
var marker;

function initialize() 
{
  var mapOptions = {
    zoom: 16,
  };
  
  	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

	var pos = new google.maps.LatLng(60, 105);//Mi pocision
	 
	 var goldStar = {
		path: google.maps.SymbolPath.CIRCLE,
	    strokeColor: '#276ED0',
		fillColor: '#276ED0',
		fillOpacity: .9,
		strokeWeight: 1,
		scale: 6,
  	};
 	var marker = new google.maps.Marker({
			position: pos,
			icon: goldStar,
			draggable: true,
			animation: google.maps.Animation.DROP,
			map: map,
  	});
	
	map.setCenter(pos);
	 
}

function animar(newpocision)//pasamos la nueva ubicacion del cliente
{

	var pedazo = newpocision.split(",");
	var pos = new google.maps.LatLng(pedazo[0], pedazo[1]);//Mi pocision
	var pos = pos;//otro lugar -> donde el usuario se localiza
		
 		var goldStar = {
			path: google.maps.SymbolPath.CIRCLE,
			strokeColor: '#FF4E51',
			fillColor: '#FF4E51',
			fillOpacity: .9,
			strokeWeight: 1,
			scale: 5,
  		};
		 var marker = new google.maps.Marker({
			position: pos,
			icon: goldStar,
			draggable: true,
			map: map
		  });		
		
	 var options = {//opciones de la nueva pocision
			map: map,
			position: pos,
		  };
		  
  map.setCenter(options.position);//pocisionamos el mapa al centro de la nueva locacion
}

function handleNoGeolocation(errorFlag) 
{
	  if (errorFlag) 
	  {
		var content = 'Error: The Geolocation service failed.';
	  } 
	  else 
	  {
		var content = 'Error: Your browser doesn\'t support geolocation.';
	  }
	
	  var infowindow = new google.maps.InfoWindow(options);
	  map.setCenter(options.position);
}


google.maps.event.addDomListener(window, 'load', initialize);

function pocision(newpocision)//recibimos la nueva pocision del socket
{
	animar(newpocision);//ejecutamos la funcion 
}


</script>
  </head>
  <body>
    <div id="map-canvas"> </div>
  </body>
</html>