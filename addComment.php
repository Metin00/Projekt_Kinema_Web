<?php
session_start();
include('database_conn.php');

function cleanseData($data){
	$data = htmlspecialchars($data);
	$data = trim($data);
	return $data;
}

$text = cleanseData(mysqli_real_escape_string($conn, $_POST['message']));

if (strlen($text) <= 0){
	?> <script> alert('Empty comment!'); </script><?php
	header("location: forum.php");
}else{

$mID = $_SESSION['movieID'];

$sql = "SELECT id, avatar, status FROM user WHERE username ='".$_SESSION['username']."';";
$result = mysqli_query($conn, $sql);
$uID = mysqli_fetch_assoc($result);

if ($uID['status'] == 0){
	$_SESSION['message'] = "Administratori iu ka ndaluar per te shkruajtur projekte.";
	header("location: profile.php");
}else{

// Check if a new comment is being added or an existing one edited.
if (isset($_SESSION['editComment'])){
	$sql = "UPDATE koment
			SET text = '".$text."'  
			WHERE id=".$_SESSION['editComment'].";";
}else{
	$sql = "INSERT INTO koment (movieID, userID, text, foto) "
			."VALUES(".$mID.", ".$uID['id'].", '".$text."', '".$uID['avatar']."');";
}

$result = mysqli_query($conn, $sql);
if($result){
	unset($_SESSION['editComment']);
	header("location: forum.php");
}else{
	die ("Could not execute query ".mysqli_error($conn));
}
}
}
?>