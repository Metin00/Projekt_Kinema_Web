<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="detajetStyle.css">
<link rel="stylesheet" href="profili.css">
<script src="jquery-3.3.1.js"></script>
<script>
//jQuery function to highlight the table when the user mouseenters
//afterwards it takes it to its original state on mouseleave
$("document").ready(function(){
	$("table").hover(function(){
		$("tr").css("background-color", "rgba(0, 0, 0, 0.2)");
	},
	function(){
		$("tr").css("background-color", "rgba(0, 0, 0, 0)");
	});
});
</script>
</head>
<body>

<?php include("mainBar.php");
session_start();
$server="localhost";
$user="root";
$password="";
$db="kinema";
$connection=mysqli_connect($server,$user,$password, $db);



$id=$_GET['id'];
$sql="SELECT * FROM movies WHERE id='".$id."'"; 
$result=mysqli_query($connection, $sql);

if (mysqli_num_rows($result)>0){
	$row=mysqli_fetch_assoc($result);
}else{
	die("Error executing query ".mysqli_error());
}

$_SESSION['movieID'] = $row['id'];

echo "<div style='position: relative'>";
echo"<h1 style='text-align:center'>".$row['titulli']."</h1>";

echo"<form method = 'post' action = 'forum.php'>
<center><input type = 'submit' value = 'Forum' style='width: 25%;' class = 'btn'></center>
</form>";

echo"<div class='row'>";
echo"<div class='column'>";
echo"<img src='photos/".$row['foto']."' style='width:100%;height:550px'>";
echo"</div>";
echo"<div class='column'>";
$tr=$row['trailer'];
echo"<iframe src='".$tr."' style='width:200%; height:450px'></iframe>";
$des=$row['pershkrim'];
echo "<p style='width:200%'>".$des."</p>";
echo"</div>";
echo"</div>";
echo"<div class='info'>";
echo"<table border='1px' style='width:100%'>";
echo"<tr>";
echo"<td>Salla</td>";
echo"<td>Orari</td>";
echo"<td>Kohezgjatja(min)</td>";
echo"<td>Data e Lancimit(V-M-D)</td>";
echo"<td>IMDB(Rating)</td>";
echo"</tr>";
echo"<tr>";
echo"<td>".$row['salla']."</td>";
echo"<td>".$row['orari']."</td>";
echo"<td>".$row['kohezgjatja']."</td>";
echo"<td>".$row['r_date']."</td>";
echo"<td>".$row['IMDB']."</td>";
echo"</tr>";
?>

</body>
</html>