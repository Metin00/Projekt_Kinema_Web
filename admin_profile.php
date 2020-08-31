<?php
session_start();
include('mainBar.php');
include('login_check.php');
include('database_conn.php');

//Confirming mesage for adding/removing/modifying movies
$_SESSION['message3']='';

//Make sure that an admin is actually wanting to connect

$sql = "SELECT admin FROM user WHERE username ='".$_SESSION['username']."';";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
	if ($row['admin'] == 0){
		//No admin loged in, redirect
		mysqli_close($conn);
		header("location: profili.php");
	}else{
		//Set admin mode which will be hereafter used to distinguish an admin
		$_SESSION['adminMode'] = "set";
		mysqli_close($conn);
	}
}else{
	die("Could not execute query".mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="profili.css" type="text/css">
<script src="jquery-3.3.1.js"></script>
<script>
$("document").ready(function(){
	$("#searchId").click(function(){
		var action = $("#txtHint").html();
		$("#sForm").attr('action', "search.php?title="+action);
	});
});
</script>
<script src="searchBoxScript.js"></script>
</head>
<body background = 'photos/interstellar.jpg'>

<script type = "text/javascript">
function submitForm(action){
	var form = document.getElementById("form1");
	form.action = action;
	form.submit();
}
</script>

<div class="body-content profil">
	<div class="welcome">
		<div class="success"><?php echo $_SESSION['message'];?></div>
		
		<form action="" method = "post" id = "sForm"> 
		<input type="text" id="txt1" onkeyup="showHint(this.value)" style="width: 50%;" placeholder = "Kerko per nje film">
		<input type ="submit" style = "width: 25%; margin-left: 190px;" class = "btn" value = "Kerko" id = "searchId">
		<p>Sugjerime: <span id="txtHint"></span></p> 
		</form>

	    <img src = "<?php echo $_SESSION['foto']?>" style = "width: 200px; height:200px" onerror="if (this.src != 'images/error.png') this.src = 'images/error.png';">
		<iframe src="https://www.youtube.com/embed/w8HdOHrc3OQ" class = "frame" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		<br>
		<span class = "success">Mireserdhe <?php echo $_SESSION['username'];?></span>
		<h2 class = "headerStyle" >Nuk ka asgje te pamundur per njeriun; let te jete kjo parrulla jone <center><center></h2>
		<br/>
		<form id = "form1">
		<input onclick = "submitForm('logoff.php')" class = "btn" type = "button" value = "Logout" style="width:25%">
		<input onclick = "submitForm('admin_modify.php')" class = 'btn' type = "button" value = "Modifiko Perdoruesit" style="width:25%; margin-left: 100px;">
		<input onclick = "submitForm('movies_modify.php')" class = "btn" type = "button" value = "Modifiko Filmat" style="width:25%; margin-left: 59px;">
		</form>
	<div>
</div>
</body>
</html>