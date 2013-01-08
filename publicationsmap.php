<?php
session_start();

if (!isset($_SESSION['AccessToken'])) {
	header('Location: redirect.php?op=getauth');
	die();
}

require_once 'Class.Instagram.php';

$instgram  = new Instagram();
$userpublications = json_decode($instgram->getUserPublications(5));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instagram API Intergation With PHP</title>
<link rel="stylesheet" href="maps.css">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

 function initialize() {

	  var mapOptions = {
			  
	    mapTypeId: google.maps.MapTypeId.ROADMAP  
	  }
	  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

	  var LatLongList = [
	                 
	                 <?php 
	                 $counter = 1;
	                 $arraydata = "";
	                 foreach ($userpublications->data as $feeddata) {
	                 
	                 	if($feeddata->location) {
	                 	
	                 		$arraydata.= "['".str_replace("'", "\'", @$feeddata->caption->text)."',".@$feeddata->location->latitude.",".@$feeddata->location->longitude.",".$counter.",'".@$feeddata->images->low_resolution->url."',".@$feeddata->images->low_resolution->width.",".@$feeddata->images->low_resolution->height."],";                                            
	                 		$counter++;	
	                 	}
	                 
	                 }
	                 
	                 if($arraydata) {

	                 	$arraydata = substr($arraydata, 0,strrpos($arraydata, ","));
	                 }
	                 
	                 echo $arraydata;
	                 
	                 ?>

	               ];
	<?php 
		
		if($counter==1) {
			
			echo "alert('You have not tagged location with any of your media.');";
		}
	?>	

	  var image = 'http://googlemaps.googlermania.com/img/google-marker-big.png';
	  var shadow  = 'http://googlemaps.googlermania.com/img/google-marker-big-shadow.png';

	  var bounds = new google.maps.LatLngBounds ();
	  var markersArray = [];
	  
	  for (var i = 0; i < LatLongList.length; i++) {

		    var photolocation = LatLongList[i];

		    bounds.extend (new google.maps.LatLng (photolocation[1],photolocation[2]));
		    
		    var myLatLng = new google.maps.LatLng(photolocation[1], photolocation[2]);

		    var marker = new google.maps.Marker({
		        position: myLatLng,
		        map: map,
		        shadow: shadow,
		        icon: image,
		        title: photolocation[0],
		        zIndex: photolocation[3]
		    });

		    var contentString = '<div id="content">'+
		    '<div id="siteNotice">'+
		    '</div>'+
		    '<h2 id="firstHeading" class="firstHeading">'+photolocation[0]+'</h2>'+
		    '<div id="bodyContent"><img src="'+photolocation[4]+'" width='+photolocation[5]+' height='+photolocation[6]+'></div></div>';

		    marker.html = contentString;

		    markersArray.push(marker);    
	  }

	  var infowindow = null;

	  infowindow = new google.maps.InfoWindow({
	  content: "holding..."
	  });

	  for (var i = 0; i < markersArray.length; i++) {
		  var marker = markersArray[i];
		  google.maps.event.addListener(marker, 'click', function () {
		  infowindow.setContent(this.html);
		  infowindow.open(map, this);
		  });
		  }

	  map.fitBounds (bounds);

	}
 
 </script>
</head>

<body onload="initialize()">

<div id="map_canvas" style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>

</body>
</html>
