<?php
include('teDrejtaAdmin.php');

$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'kinema';

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
	die ("Error while connecting to database".mysqli_connect_error());
}

//Pra nese klikohet buttoni submit!
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}
	
	$title = cleanseData(mysqli_real_escape_string($conn, $_POST['title']));
	$r_date = $_POST['r_date'];
	$description = cleanseData(mysqli_real_escape_string($conn, $_POST['description']));
	$trailer = mysqli_real_escape_string($conn, $_POST['trailer']);
	$imbd = cleanseData(mysqli_real_escape_string($conn, $_POST['imbd']));
	$salla = cleanseData(mysqli_real_escape_string($conn, $_POST['salla']));
	$orari = cleanseData(mysqli_real_escape_string($conn, $_POST['orari']));
	$kohezgjatja = cleanseData(mysqli_real_escape_string($conn, $_POST['kohezgjatja']));
	$image_path = mysqli_real_escape_string($conn, ''.$_FILES['avatar']['name']);
	
	//Kontrollojme a eshte imazh
	if (preg_match("!image!", $_FILES['avatar']['type'])){
		
		//copy the image to our images folder
		if (copy($_FILES['avatar']['tmp_name'], $image_path)){
			
			//Ne kete pike jemi gati te fusim te dhenat e reja ne databaze
			$sql = "INSERT INTO movies (titulli, r_date, pershkrim, trailer, IMDB, salla, foto, orari, kohezgjatja)"
			."VALUES ('".$title."', '".$r_date."', '".$description."', '".$trailer."', ".$imbd.", ".$salla.", '".$image_path."', '".$orari."', '".$kohezgjatja."');";
		
			if (mysqli_query($conn, $sql)){
				$_SESSION['title'] = $title;
				header("location: shtoZhaner.php");
			}else{
				//Nese te dhenat gjenden ne databaze
				$MYSQL_COSE_DUPLICATE_KEY = 1062;
				if (mysqli_errno($conn) == $MYSQL_COSE_DUPLICATE_KEY){
					$_SESSION['message3'] = "Regjistrimi i filmit te ri deshtoi. Ky film gjendet ne databaze";
					mysqli_close($conn);
					header("location: movies_modify.php");
				}
				//Nese ka nje tjeter error
				else{
					$_SESSION['message3'] = "Regjistrimi i filmit te ri deshtoi ".mysqli_error($conn);
					mysqli_close($conn);
					header("location: movies_modify.php");
				}
			}
	}else{
		$_SESSION['message']="Deshtoi ngarkimi i fotos";
	}
}else{
		$_SESSION["message3"] = "Duhen bere upload vetem imazhe GIF, JPG, ose PNG";
}
}

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="profili.css" type="text/css">
<body>

<div class = "body-content">
	<div class = "module">
	<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off" enctype="multipart/form-data">
		<div class = "error"><?php echo $_SESSION['message3'];?></div>
		<input type="text" placeholder="Title" name="title" required >
		<input type="date" placeholder="Release data" name="r_date" required >
		<input type="text" placeholder="Description" name="description" required >
		<input type="text" placeholder="Trailer" name="trailer" required >
		<input type="floatval" placeholder="IMBD" name="imbd" required >
		<input type="intval" placeholder="Hall" name="salla" required >
		<div class="avatar">Zgjidh foton: <input type="file" name="avatar" accept="image/*"></div>
		<input type="text" placeholder="Schedule" name="orari" required >
		<input type="intval" placeholder="Duration" name="kohezgjatja" required >
		<input type="submit" value="Add Movie" class="btn">
	</form>
	</div>
</div>

</body>
</html>
