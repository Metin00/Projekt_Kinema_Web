<?php
//Make sure an admin is logged in
include('teDrejtaAdmin.php');
include('database_conn.php');

$_SESSION['message'] = 'Fut fjalekalimin per te konfirmuar ndryshimet:';
//This message will confirm user modification
$_SESSION['message2']="";



$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '".$username."';";
$result = mysqli_query($conn, $sql);


$row = mysqli_fetch_assoc($result);

//old path of image; if a new one is uploaded it will be replaced
$image_path = $row['avatar'];

$id = $row['id'];

//Modify admin credentials
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}

	if ($_POST['password'] == $_POST['confirmpassword']){
	
		$username = cleanseData(mysqli_real_escape_string($conn, $_POST['username']));
		$email = cleanseData(mysqli_real_escape_string($conn, $_POST['email']));
		$password = cleanseData(mysqli_real_escape_string($conn, $_POST['password']));
		$password = md5($password);
		
		if (!empty($_FILES['avatar']['name'])){
			$image_path = mysqli_real_escape_string($conn, 'images/'.$_FILES['avatar']['name']);
			if (preg_match("!image!", $_FILES['avatar']['type'])){
				
				if (copy($_FILES['avatar']['tmp_name'], $image_path)){
					$image_path = mysqli_real_escape_string($conn, 'images/'.$_FILES['avatar']['name']);
				}else{
					$_SESSION['message']="Deshtoi ngarkimi i fotos";
				}
			}else{
				$_SESSION['message']="Duhen bere upload vetem imazhe GIF, JPG, ose PNG";
			}
		}
		
		$sql = "UPDATE user".
			   " SET username = '".$username."', email= '".$email."', password = '".$password."', avatar = '".$image_path."'".
			   " WHERE id = '".$id."';";
			   
		if (mysqli_query($conn, $sql)){
			$_SESSION['message']="Te dhenat personale u modifikuan me sukses:";
			$_SESSION['foto']=$image_path;
			$_SESSION['username']=$username;
			
			mysqli_close();
			header("location: profile.php");
		}else{
			$MYSQL_CODE_DUPLICATE_KEY = 1062;
			if (mysqli_errno($conn) == $MYSQL_CODE_DUPLICATE_KEY)
				$_SESSION['message'] = "Ndryshimi i te dhenave personale deshtoi. Ato jane te zena nga nje perdorues tjeter. Te lutem perpiquni t'i ndryshoni....";
			else
				$_SESSION['message'] = "Nryshimi i te dhenave personale deshtoi ".mysqli_error($conn);
		}
		
	}else{
		$_SESSION['message']="Fjalekalimet nuk perputhen!";
	}
	mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="profili.css" type="text/css">
<body>

<div class = "body-content">
<div class = "module">
<h1><center>Modifiko te dhenat personale</center></h1>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off" enctype="multipart/form-data">
	<div class = "error"><?php echo $_SESSION['message'];?></div>
	<input type="text" placeholder="User Name" name="username" value = "<?php echo $row['username'];?>" required >
      <input type="email" placeholder="Email" name="email" value = "<?php echo $row['email'];?>" required >
      <input type="password" placeholder="Password" name="password" required >
      <input type="password" placeholder="Confirm Password" name="confirmpassword" required >
      <div class="avatar">Zgjidh nje foto: <input type="file" name="avatar" accept="image/*"></div>
      <input type="submit" value="Modify"  class="btn">
</form>
<form  action = "modifiko_user.php">
<input type = "submit" value = "Modify user account" class = "btn">
</form>
</div>
</div>

</body>
</html>