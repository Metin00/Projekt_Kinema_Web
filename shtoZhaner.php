<?php
include('teDrejtaAdmin.php');

$_SESSION['message3']="Filmi nuk mund te kete me shume se 3 zhanre. Secili duhet te jete i ndare me hapsire.";

$server = '127.0.0.1';
$username = 'root';
$password = 'corei3ada+';
$database = 'kinema';

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
	die ("Error while connecting to database".mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}
	
	//Ndajme inputin e perdoruesit sipas zhanreve individual
	$zhaner = cleanseData(mysqli_real_escape_string($conn, $_POST['zhan']));
	$zhanra = explode(" ", $zhaner, 3);
	
	//marrim id e filmit
	$sql = "SELECT id FROM movies WHERE titulli ='".$_SESSION['title']."';";
	
	$result = mysqli_query($conn, $sql);
	if (!$result){
		die ("Error while executing query ".mysqli_error($conn));
	}
	
	$row = mysqli_fetch_assoc($result);
	//multi-query to add all the genres
	$sql = "INSERT INTO zhanret (id, zhanri) VALUES (".$row['id'].", '".$zhanra[0]."');";
	if ($zhanra[1]!=""){
		$sql .= "INSERT INTO zhanret (id, zhanri) VALUES (".$row['id'].", '".$zhanra[1]."');";
		if ($zhanra[2] != ""){
			$sql .= "INSERT INTO zhanret (id, zhanri) VALUES (".$row['id'].", '".$zhanra[2]."');";
		}
	}
	
	//Nese ekzekutohet query, zhanerat u shtuan me sukses
	if (mysqli_multi_query($conn, $sql)){
		$_SESSION["message3"] = "Filmi u shtua me sukses";
		mysqli_close($conn);
		header("location: movies_modify.php");
	}else{
		$_SESSION["message3"] = "Nuk mund te ekzekutohej query".mysqli_error($conn);
		mysqli_close($conn);
		header("location: movies_modify.php");
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
		<input type="text" placeholder="genre" name="zhan" required >
		<input type="submit" value="Add Genre"  class="btn">
	</form>
	</div>
</div>

</body>
</html>
