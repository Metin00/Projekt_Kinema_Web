<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="zhanriStyle.css"></head>

<?php
session_start();

if (!isset($_SESSION['mainPageVisited'])){
	header("location: mainPage.php");
}
?>
<body>
<?php include("mainBar.php");

$server="localhost";
$user="root";
$password="";
$db="kinema";
$connection=mysqli_connect($server,$user,$password, $db);

if (!$connection){
	die ("Could not connect to database ".mysqli_connect_error());
}


//$query2="Select id,foto,titulli, orari From movies";
//$query3=mysqli_query($connection, $query2);
$sql = "SELECT id, foto, titulli, orari FROM movies;";
$result = mysqli_query($connection, $sql);

$genre=$_GET['zhan'];

if (mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_assoc($result)){
		$sql="SELECT id FROM zhanret WHERE zhanri='".$genre."';";
		$result2 = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result2)>0){
			while ($row2 = mysqli_fetch_assoc($result2)){
				if($row['id']==$row2['id']){
					$id=$row['id'];
					echo"<div class='column'>";
					echo"<a href='detajet.php?id=$id'><img src='photos/".$row['foto']."' style='width:100%;height:450px'>";
					if($row['orari']=='se shpejti'){
						echo"<div class='top-right'>".$row['orari']."</div>"; //Print 'comming soon'
					}
				echo"</a>";
				echo"</div>";
				}
			}
		}else{
			die ("Error executing query ".mysqli_error());
		}
	}
}else{
	die("Error executing query ".mysqli_error());
}

?>

</body>
</html>