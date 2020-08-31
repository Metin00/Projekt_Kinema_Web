<?php
include('teDrejtaAdmin.php');


//Deklarojme nje variabel userModifikim i cili perdoret per te moslejuar aksesimin e faqeve 
//editMovie dhe movie_delete vecse nga faqa modifiko_user
$_SESSION['movieModifikim']="SET";
$_SESSION['movieDelete']="SET";


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="profili.css" type="text/css">
<script src="jquery-3.3.1.js"></script>
<script>
$(document).ready(function(){
	$("tr:even").css("background-color", "rgba(0, 0, 0, 0.2)");
	$("tr:odd").css("background-color", "rgba(0, 0, 0, 0.4)");
});
</script>
</head>
<body>

<div class = "body-content">
	<div class = "module">
	<div class = "error"><?php echo $_SESSION['message3'];?></div>
		<form action = "graphical.php">
			<input type = "submit" value = "Graphical Data" class = "btn">
		</form>
		<form action = "shtoFilm.php">
			<input type="submit" value="Add Movie" class="btn">
		</form>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "kinema";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
	die ("Could not connect to database".mysqli_connect_error());
}

//query: Select all movies
$sql = "SELECT id, titulli, pershkrim FROM movies;";
$result = mysqli_query($conn, $sql);
if (!$result){
	die ("Error while executing query ".mysqli_error($conn));
}


//Ndertohet tabela me te gjithe filmat
if (mysqli_num_rows($result)>0){
	echo "<center>";
	echo "<table border = '1'>";
	echo "<tr><th>Id-ja</th><th>Titulli</th><th>Pershkrimi</th>
	<th>Veprimet <ul><li>Edito</li><li>Fshi</li></ul></th></tr>";
	//Create the table using a while loop with data from the database
	while ($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>".$row['id']."</td><td>".$row['titulli']."</td><td>".$row['pershkrim']."</td><td><ul><li><a href = 'editMovie.php?id="
		.$row['id']."'>Edito</a></li><li><a href = 'movie_delete.php?id=".$row['id']."' class = 'delete'>Fshi</a></li></ul></td></tr>";
	
	echo "</center>";
	}
}else{
	echo "Error executing query ".mysqli_error($conn);
}

mysqli_close($conn);
?>
</div>
</div>
<script>
//Confirm delete
$(document).ready(function(){
	$(".delete").click(function(event){
		event.preventDefault();
		var c = confirm("A je i sigurt qe deshiron t'a heqesh kete film?");
		if (c == true){
			window.location = $(this).attr('href');
		}
	});
});
</script>
</body>
</html>
