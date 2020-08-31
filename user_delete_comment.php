<?php
session_start();
include('database_conn.php');

//To delete the comment we need the movieID of the comment and 
//the comment id
$mid = $_SESSION['movieID'];
$kid = $_GET['id'];

$sql = "DELETE FROM koment WHERE movieID = $mid AND id = $kid ";

if(mysqli_query($conn, $sql)){
	mysqli_close();
	header("location: forum.php");
}

?>