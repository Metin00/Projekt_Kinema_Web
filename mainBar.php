<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="mainPageStyle.css">

<script src="mainPscript.js"></script>
<script src="clickScript.js">
</script>

</head>
<body bgcolor='#CD853F' >
<div>
<a href = "mainPage.php"><span id="left"><img src="photos/globe.png"></span></a>
 <span id="logo"> E gjithe bota <br />ne nje ekran</span>
 </br>
 <div class="bar">
  <a href="mainPage.php">Shtepia</a>
  <form method="POST">
  <div class="dropdown">
   <button class="dbutton">Auditori 
    </button>
    <div class="dropdown-content" >
      <a href="sallat.php?id=1">Teatri 1</a>
      <a href="sallat.php?id=2">Teatri 2</a>
      <a href="sallat.php?id=3">Teatri 3</a>
	  </div>
  </div> 
  </form>
  <form method="POST">
  <div class="dropdown">
   <button class="dbutton">Filma	 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" >
      <a href="genre.php?zhan=komedi">Komedi</a>
      <a href="genre.php?zhan=aksion">Aksion</a>
      <a href="genre.php?zhan=fantasy">Fantazi</a>
	  <a href="genre.php?zhan=aventure">Aventure</a>
	  <a href="genre.php?zhan=horror">Horror</a>
	  <a href="genre.php?zhan=sci-fi">Sci-Fi</a>
	  <a href="genre.php?zhan=drama">Drame</a>
	  <a href="genre.php?zhan=animated">I Animuar</a>
    </div>
  </div> 
  </form>
  
  <div class="dropdown">
	<button class="dbutton">Profili
    </button>
    <div class="dropdown-content" >
  <a href="login.php" id="ddd">Profili</a>
  <a href="location.php">Adresa</a>
  </div>
  </div>  <!--If we were putting profile.php as the actual link we would be continually redirecting 
											to mainPage.php because of the login_check.php file which is included in profile.php-->
  <a href="contact.php">Kontakt</a> 
  </div>
  

</br>
</body>

</html>