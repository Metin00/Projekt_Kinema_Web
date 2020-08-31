<?php
session_start();
include('mainBar.php');
include('login_check.php');
include('database_conn.php');


if (strcmp($_SESSION['message'], "Fut fjalekalimin per te konfirmuar ndryshimet") == 0){
	$_SESSION['message'] = "Welcome ".$_SESSION['username'];
}

//Check if an admin was logged in. If so, redirect to the admin profile

//'admin' will be a boolean attribute in our user table in the database
//which denotes whether the user is an admin
$sql = "SELECT admin FROM user WHERE username ='".$_SESSION['username']."';";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
	if ($row['admin'] == 1){
		//logged admin
		header("location: admin_profile.php");
	}
}

?>
<!DOCTYPE html>
<html>
<!--This function will redirect the user to two different files, namely logoff.php and u_modifikim.php
depending on the functionality that he chooses -->
<script type = "text/javascript">
function submitForm(action){
	var form = document.getElementById("form1");
	form.action = action;
	form.submit();
}
</script>
<script src="jquery-3.3.1.js"></script>
<!-- Me ane te nje funksioni jQuery do te vendosim vleren e action tek formi sipas rezultatit te kerkimit
Kete rezultat e marrim nga sugjerimet qe do te shfaqen meqenese nese kerkimi eshte i suksesshem atehere ai 
patjeter qe do te shfaqet si sugjerim perndryshe, pra nqs nuk ka sugjerime atehere kerkimi nuk ishte i 
suksesshem-->
<script>
$("document").ready(function(){
	$("#searchId").click(function(){
		var action = $("#txtHint").html();
		$("#sForm").attr('action', "search.php?title="+action);
	});
});
</script>
<script src="searchBoxScript.js"></script>
<body background = 'photos/interstellar.jpg'>
<link rel="stylesheet" href="profili.css" type="text/css">
<div class="body-content profil">
	<div class="welcome">
		<div class="success"><?php echo $_SESSION['message'];?></div>
		
		<form action="" method = "post" id = "sForm"> 
		<input type="text" id="txt1" onkeyup="showHint(this.value)" style="width: 50%;" placeholder = "Search for a movie">
		<input type ="submit" style = "width: 25%; margin-left: 190px;" class = "btn" value = "Search" id = "searchId">
		<p>Sugjerime: <span id="txtHint"></span></p> 
		</form>
	
		<img src = "<?php echo $_SESSION['foto']?>" style = "width: 200px; height:200px" alt = "Here would be your profile picture. If it isn't an 
		administrator might have deleted it because it was not suitable" onerror="if (this.src != 'images/error.png') this.src = 'images/error.png';">
		<iframe src="https://www.youtube.com/embed/w8HdOHrc3OQ" class = "frame" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<br>
		<span class = "success">Mireserdhe <?php echo $_SESSION['username'];?></span>
		<h2 class = "headerStyle" >Nuk ka asgje te pamundur per njeriun; le te jete kjo parrulla jone<center>qe tani e tutje<center></h2>
		<br/><br/><br/>
		<!-- This from will either allow the user to logout or to modify his personal data-->
		<form id = "form1">
		<input onclick ="submitForm('logoff.php')" class = 'btn' type = "button" value = "Logout" style="width:25%">
		<input onclick ="submitForm('u_self_modify.php')" class = 'btn btn-modifikim' type = "button" value = "Modify personal data" style="width:25%" >
		</form>
		
	</div>
</div>
</body>
</html>