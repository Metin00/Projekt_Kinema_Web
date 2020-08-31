<?php 
session_start();

//Nese kjo faqe hapet pa qene vizituar me pare mainPage.php atehere do te bejme
//redirect tek mainPage.php; mainPageVisited variable is set in the mainPage.php
if (!isset($_SESSION['mainPageVisited'])){
	header("location: mainPage.php");
}

?>

<?php
$_SESSION['message']='';
include('mainBar.php');
include('database_conn.php');

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}
	
	//Kontrollo a jane passworded e njejte
	if ($_POST["password"] == $_POST["confirmpassword"]){
		
		//Clean the data
		$username = cleanseData(mysqli_real_escape_string($conn, $_POST['username']));
		$email = cleanseData(mysqli_real_escape_string($conn, $_POST['email']));
		$password = cleanseData(mysqli_real_escape_string($conn, $_POST['password']));
		$password = md5($password);
		$image_path = mysqli_real_escape_string($conn, 'images/'.$_FILES['avatar']['name']);
	
		
		//Check if it is really an image file
		if (preg_match("!image!", $_FILES['avatar']['type'])){
			
			//copy the image to our images folder
			if (copy($_FILES['avatar']['tmp_name'], $image_path)){
				$_SESSION['username'] = $username;
				$_SESSION['foto'] = $image_path;
				
				//Everything ready for us to enter data into db
				$sql = "INSERT INTO user (username, email, password, avatar)"
				."VALUES ('".$username."', '".$email."', '".$password."', '".$image_path."');";
				
				//If the above query is executed then the user was loged in and we redirect to the profile
				if (mysqli_query($conn, $sql)){
					$_SESSION['message']="Llogaria u krijua me sukses";
					mysqli_close($conn);
					header("location: profile.php");
				}else{
					//Then an error happened
					//First we check if the newly created data are actually a duplicate in the database
					$MYSQL_CODE_DUPLICATE_KEY = 1062;
					if (mysqli_errno($conn) == $MYSQL_CODE_DUPLICATE_KEY)
						$_SESSION['message'] = "Regjistrimi deshtoi. Te dhenat e tua jane te zena nga nje perdorues tjeter. Iu lutem perpiquni t'i ndryshoni";
					else
						$_SESSION['message'] = "Regjistrimi deshtoi ".mysqli_error($conn);
				}
			}else{
				$_SESSION['message']="Upload-i i fotos deshtoi";
			}
		}else{
			$_SESSION['message']="Mund te upload-osh vetem GIF, JPG, ose PNG ";
		}
	}else{
		$_SESSION['message']="Fjalekalimet nuk perputhen";
	}
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="profili.css" type="text/css">
<body>
<div class = "body-content">
<div class = "module">
<h1>Krijo nje llogari</h1>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off" enctype="multipart/form-data">
	<div class = "error"><?php echo $_SESSION['message'];?></div>
	<input type="text" placeholder="User Name" name="username" required >
      <input type="email" placeholder="Email" name="email" required >
      <input type="password" placeholder="Password" name="password" required >
      <input type="password" placeholder="Confirm Password" name="confirmpassword" required >
      <div class="avatar">Zgjidh nje foto: <input type="file" name="avatar" accept="image/*"  required ></div>
      <input type="submit" value="Register" name="register" class="btn">
</form>
</div>
</div>
</body>
</html>