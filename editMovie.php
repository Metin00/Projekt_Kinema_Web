<?php
include('teDrejtaAdmin.php');
include('database_conn.php');

//The variable movieModifikim will check if the page is being accesed from moves_modify.php
//If it is not we cannot continue because we do not have a valid id so we will redirect
if (!isset($_SESSION['movieModifikim'])){
	header("location: movies_modify.php");
}

//If the admin just deleted a movie and he goes on to edit another we will get the same message
//that confirms delete because we are using the same global variable. Here we avoid such a 
//confusion
if (isset($_SESSION['message3'])){
	if (strcmp($_SESSION['message3'], 'Filmi u fshi me sukses')==0){
		$_SESSION['message3']='';
	}
}

//id of the movie
$id = $_GET["id"];


$sql = "SELECT * FROM movies WHERE id =".$id.";";
$result = mysqli_query($conn, $sql);

//Convert the result into a associative array
if (mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
}else{
	die("Could not execute query".mysqli_error($conn));
}
//Get the 'zhanri'(genre) of the movie
$sql2 = "SELECT zhanri FROM zhanret WHERE id=".$id.";";
$result2 = mysqli_query($conn, $sql2);

//E konvertojme rezultatin ne nje array associative
if (mysqli_num_rows($result2) > 0){
	
	//Deklarojme nje array ku do te fusim zhanret e filmave
	$filma_zhaner = array();
	while ($row2 = mysqli_fetch_assoc($result2)){
		$filma_zhaner[] = $row2;
	}
}else{
	die("Could not execute query".mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="profili.css" type="text/css">
<body>

<div class = "body-content">
	<div class = "module">
	<form method = "post" action = "editM.php?id='<?php echo $_GET["id"];?>'" autocomplete = "off" enctype="multipart/form-data">
		<div class = "error"><?php echo $_SESSION['message3'];?></div>
		<input type="text" placeholder="Titulli" name="title" value = "<?php echo $row['titulli'];?>" required >
		<input type="date" placeholder="Release data" name="r_date" value = "<?php echo $row['r_date'];?>" required >
		<input type="text" placeholder="Pershkrimi" name="description" value = "<?php echo $row['pershkrim'];?>" required >
		<input type="text" placeholder="Trailer" name="trailer" value = "<?php echo $row['trailer'];?>" required>
		<input type="floatval" placeholder="IMBD" name="imbd" value = "<?php echo $row['IMDB'];?>" required >
		<input type="intval" placeholder="Salla" name="salla" value = "<?php echo $row['salla'];?>" required>
		<div class="avatar">Choose a picture: <input type="file" name="avatar" accept="image/*"></div>
		<input type="text" placeholder="Orari" name="orari" value = "<?php echo $row['orari'];?>" required >
		<input type="intval" placeholder="Kohezgjatja" name="kohezgjatja" value = "<?php echo $row['kohezgjatja'];?>" required >
		<input type="text" placeholder="Zhanri" name = "zhan" value = "<?php foreach($filma_zhaner as $zhaner) echo $zhaner['zhanri']." ";?>" required>
		<input type="submit" value="Edit Movie"  class="btn">
	</form>
	</div>
</div>

</body>
</html>
