<?php
 include_once '../dbh.inc.php';
?>



<!DOCTYPE html>
<html>

<title>Bones Tech</title>
<head>
  <link rel="stylesheet" type="text/css" href="../layout.css">
  <script src="JS.js"></script>
  <link rel="stylesheet" type="text/css" href="../Icons/font-awesome.css"/>
</head>


<body>
<?php
 include_once '../Menu.php';
?>

<!--GOOGLE MAP PLACEHOLDER-->
<div id="googleMap" style="width:600px;height:600px; position:absolute; top:35%; left: 50%;" ></div>



<script>
function myMap() {
var myCenter = new google.maps.LatLng(51.0143554, 4.480169);
var mapProp = {center:myCenter, zoom:14, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({position:myCenter});
marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyASay_YWn-LsuIFTVg-K4lLdrvuQJrcVTE &callback=myMap"></script> 





<!--MAIL PLACEHOLDER-->

<form class="Mailus" method="post" name="myemailform" action="emailform.php"><br>
<h1 style="position: absolute; top: -80%;">Contacteer ons via mail: </h1>
<input class="Mailus" Placeholder="Naam" type="text" name="naam"><br>

<input class="Mailus" Placeholder="Email" type="text" name="email"><br>

<textarea class="Mailemail" Placeholder="Bericht" name="bericht"></textarea><br>
<a href="http://www.google.com/">
<input  class="Mailus" type="submit" value="Verstuur Mail" action="http://www.google.com/"><br>
</a>
</form>

<!--MAIL PLACEHOLDER-->


<div class="col-sm-5" style="position: absolute; top: 0%; border: none; font-size: 20px; background-color: #212121; color: white; border-radius: 10px;">
      <p></i>04 83 66 79 40</p>
      <p></span>Mechelen, België</p>
      <p></span>contact@boneshardware.be</p>
    </div>



</body>
</html>