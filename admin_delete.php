<?php
include('teDrejtaAdmin.php');
include('database_conn.php');

if (!isset($_SESSION['userDelete'])){
	header("location: modifiko_user.php");
}


//Marrim id e userit qe do te fshihet
$id = $_GET["id"];

//First, delete any comments that the user might have
$sql = "DELETE FROM koment WHERE userID =".$id.";";

if (mysqli_query($conn, $sql)){
	//now delete the user
	$sql = "DELETE FROM user WHERE id =".$id.";";
	if (mysqli_query($conn, $sql)){
		$_SESSION['message2'] = "Fshirja u krye me sukses!";
		header("location: modifiko_user.php");
	}
}else{
	$_SESSION['message2'] = "Error nderkohe qe po fshihej rekordi: ".mysqli_error($conn);
	header("location: modifiko_user.php");
}

mysqli_close($conn);
?>