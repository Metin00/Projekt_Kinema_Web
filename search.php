<?php
session_start();
include('database_conn.php');
if (strcmp($_GET['title'], "")==0){
	//Nothing was entered
	header("location: profile.php");
}

$title = $_GET['title'];
//If the search didn't come up with anything
if (strcmp($title, "The search didn't find anything") == 0){
	$_SESSION["message"]=$title;
	header("location: profile.php");
}else{
//If the user didn't type the full name and let us suppose two or three 
//suggestions pop up then only the first suggestion will be taken into account
$titujt = explode(", ", $title);



//The title is a unique attribute in the database
$sql = "SELECT id FROM movies WHERE titulli= '".$titujt[0]."';";
$result = mysqli_query($conn, $sql);
$id = mysqli_fetch_assoc($result);

if($result){
	$_SESSION['message']="Kerkimi ishte i sukseshem";
	header("location: detajet.php?id=".$id["id"]);
}else{
	die ("Unable to execute query".mysqli_error($conn));
}
}
?>