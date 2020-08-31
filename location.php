<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>

      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	   #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
  </head>
  <body>
   
<?php


$server="localhost";
$user="root";
$password="";
$db="kinema";
$password = "";

$connection=mysqli_connect($server,$user,$password, $db);
if (!$connection){
	die ("Could not connect to database".mysqli_connect_error());
}


$query2="Select * From user";
$query3=mysqli_query($connection, $query2);



$nr1=mysqli_num_rows($query3);?>
<div id="floating-panel">
      <a href="mainPage.php"><input id="submit" type="button" value="The Globe Theatre"></a>
    </div>
 <div id="map"></div>
 
<script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 41.1533, lng: 20.1683},
        });

       <?php
        for ($i=0;$i<$nr1;$i++) {
			$v=mysqli_fetch_assoc($query3);
	$la=$v['lat'];
	$ln=$v['Lng'];
	echo"var marker = new google.maps.Marker({
    position: {lat: ".$la.", lng: ".$ln."},
    map: map,
   
  });
   marker.setMap(map);";
  
   
      }?>
	  }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk_8X9u4r4umLOG20VFmoI8-QLmU8Lyik&callback=initMap">				
    </script>
  </body>
</html>
