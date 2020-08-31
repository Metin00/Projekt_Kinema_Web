<!DOCTYPE html>
<html>
<?php
session_start();
//Deklarojme nje variabel sessioni
//Faqet e tjera do te behen riderect nese perdoruesi nuk ka hyre me pare ne faqen kryesore
$_SESSION['mainPageVisited'] = "SET";
?>
<head>
<link rel="stylesheet" href="mainPageStyle.css">
<script src="mainPscript.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
}
.container {
  position: relative;
  width: 20%;
  padding:10px;
  float:left;
}

.image {
  display: block;
  width: 100%;
  height: 300px;
}

.overlay {
  padding:10px;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: rgba(0, 0, 255, 0.6);
}

.container:hover .overlay {
  opacity: 0.4;
  
}

.text {
  color: rgb(255, 255, 0);
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
</style>
</head>
<body>
<?php include("mainBar.php");?>  <!-- Some characteristics which will be the same for every page -->

<div class="w3-content w3-display-container" style="max-width:1200px">

  <img class="posterat" src="photos/f1.jpg" style="width:100%; height:550px">
  <img class="posterat" src="photos/avengers_infinity.jpeg" style="width:100%; height:550px">
  <img class="posterat" src="photos/mazeRunner2.jpg" style="width:100%; height:550px">
  <img class="posterat" src="photos/it1.jpg" style="width:100%; height:550px">
  <img class="posterat" src="photos/thor.jpg" style="width:100%; height:550px">
  
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="shigjetat(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="shigjetat(1)">&#10095;</div>
    <span class="w3-badge pikat w3-border w3-transparent w3-hover-white" onclick="rrathet(1)"></span>
    <span class="w3-badge pikat w3-border w3-transparent w3-hover-white" onclick="rrathet(2)"></span>
    <span class="w3-badge pikat w3-border w3-transparent w3-hover-white" onclick="rrathet(3)"></span>
	<span class="w3-badge pikat w3-border w3-transparent w3-hover-white" onclick="rrathet(4)"></span>
	<span class="w3-badge pikat w3-border w3-transparent w3-hover-white" onclick="rrathet(5)"></span>
  </div>
</div>

<br /> <br /><br /><br />
<h1 style="text-align:center">Se Shpejti</h1>
<br />


<?php 


include('database_conn.php');

$sql="SELECT * FROM movies WHERE orari = 'se shpejti'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_assoc($result)){
		$id = $row['id'];

		echo"<div class='container'>";
		echo"<a href='detajet.php?id=$id'><img src='photos/".$row['foto']."' style='width:100%;height:400px'>";
		echo"<div class='overlay'>";
		echo"<div class='text'>".$row['titulli']."<br />".$row['r_date']."</div>";
		echo"</div>";
		echo"</div>";
	}
}else{
	die("Error".mysqli_error);
}
?>
  
  




<script>	
	
var poz = 1;
pozicionim(poz);
var counter = 0;
animacion();
</script>

</body>
</html>