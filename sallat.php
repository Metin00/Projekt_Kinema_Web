<!DOCTYPE html>
<html>
<?php
session_start();
//mainPage.php needs to be visited first
if (!isset($_SESSION['mainPageVisited'])){
	header("location: mainPage.php");
}
?>
<head><link rel="stylesheet" href="sallatStyle.css"></head>
</style>
<body>
<?php include("mainBar.php");

$server="localhost";
$user="root";
$password="";
$db="kinema";

$conn=mysqli_connect($server,$user,$password, $db);
if(!$conn){
	die("Error while connecting to the database ".mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM movies WHERE salla =".$id.";";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
	while ($row = mysqli_fetch_assoc($result)){
		echo"<div class='column'>";
		echo"<img src='photos/".$row['foto']."' style='width:100%;height:450px'>";
		echo"<div class='top-right' style = 'font-size: 30px;'>Time: ".$row['orari']."</div>";
		echo"</div>";
	}
}
?>

</body>
</html>