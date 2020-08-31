<?php
include('teDrejtaAdmin.php');


//Kontrollojme nese faqja eshte aksesuar ashtu sic duhet, pra nga movies_modify.php
if (!isset($_SESSION['moviesModifikim'])){
	header("location: movies_modify.php");
}



$servername = "127.0.0.1";
$username = "root";
$password = "corei3ada+";
$database = "kinema";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn){
	die ("Could not connect to database ".mysqli_connect_error());
}

//Get the movie ID from the superglobal $_GET 
$id = $_GET['id'];
$sql = "DELETE FROM movies WHERE id=".$id.";";

if (mysqli_query($conn, $sql)){
	$_SESSION['message3'] = "Filmi u fshi me sukses";
	//Now we need to delete any possible comments that might be associated with 
	//the movie
	$sql  = "DELETE FROM koment WHERE movieID =".$id.";";
	if (mysqli_query($conn, $sql)){
		//Delete was a success. Redirect
		mysqli_close($conn);
		header("location: movies_modify.php");
	}
	//end the script
	exit;
}else{
	$_SESSION['message3'] = "Could not execute query ".mysqli_error($conn);
	mysqli_close($conn);
	header("location: movies_modify.php");
	exit;
}
?>