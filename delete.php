<?php
session_start();
include('database_conn.php');

$sql = "SELECT * FROM user WHERE username = '".$_SESSION['username']."';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id']; 
 
//Delete any comments that the user might have had 
//Delete the user
$sql = "DELETE FROM koment WHERE userID =".$id.";";
$sql.= "DELETE FROM user WHERE id = ".$id."";

if (mysqli_multi_query($conn, $sql)){
	session_unset();
	session_destroy();
	
	session_start();
	$_SESSION['message']="Llogaria u krijua me sukses";
}else{
	$_SESSION['message']="Nuk mund te fshihej llogaria. ".mysqli_error($conn);
}
header("location: profile.php");
?>