<?php
session_start();
include('mainBar.php');
include('login_check.php');
include('database_conn.php');

$_SESSION['message'] = 'Fut fjalekalimin per te vazhduar ndryshimet....';


$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '".$username."';";
$result = mysqli_query($conn, $sql);

//We need not check if the query executed or if the $row variable actually
//has any results because we are sure that it will have since this is a logged user
$row = mysqli_fetch_assoc($result);

//the old image path; if a new one is uploaded it will be overwritten
$image_path = $row['avatar'];

//the id of the user in the database
$id = $row['id'];

//modify results
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}
	
	//Check if the passwords match
	if ($_POST['password'] == $_POST['confirmpassword']){
		
		//Sanitize data
		$username = cleanseData(mysqli_real_escape_string($conn, $_POST['username']));
		$email = cleanseData(mysqli_real_escape_string($conn, $_POST['email']));
		$password = cleanseData(mysqli_real_escape_string($conn, $_POST['password']));
		$password = md5($password);
		
		//If the user did change the photo(changing the photo was not required)
		//then we will update the path
		if (!empty($_FILES['avatar']['name'])){
			$image_path = mysqli_real_escape_string($conn, 'images/'.$_FILES['avatar']['name']);
			if (preg_match("!image!", $_FILES['avatar']['type'])){
				
				//copy the image to the images folder
				if (copy($_FILES['avatar']['tmp_name'], $image_path)){
					
					//actually its do nothing so we just confirm the path
					$image_path = mysqli_real_escape_string($conn, 'images/'.$_FILES['avatar']['name']);
				}else{
					$_SESSION['message']="Ngarkimi i imazhit deshtoi";
				}
			}else{
				$_SESSION['message']="Mund te besh upload vetem JPEG,GIF ose PNG.";
			}
		}
		
		//Now we can update the data
		$sql = "UPDATE user".
			   " SET username = '".$username."', email= '".$email."', password = '".$password."', avatar = '".$image_path."'".
			   " WHERE id = '".$id."';";
			   
		if (mysqli_query($conn, $sql)){
			$_SESSION['message']="Te dhenat personale u ndryshuan me sukses";
			$_SESSION['foto']=$image_path;
			$_SESSION['username']=$username;
			
			mysqli_close();
			header("location: profile.php");
		}else{
			//If the desired new data are already in the database then we cannot modify them
			$MYSQL_CODE_DUPLICATE_KEY = 1062;
			if (mysqli_errno($conn) == $MYSQL_CODE_DUPLICATE_KEY)
				$_SESSION['message'] = "Modifikimi i te dhenave deshtoi. Te dhenat jane te zena nga nje perdorues tjeter.";
			else
				$_SESSION['message'] = "Ndryshimi i te dhenave deshtoi".mysqli_error($conn);
		}
		
	}else{
		$_SESSION['message']="Fjalekalimet nuk perputhen";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="profili.css" type="text/css">
<script src="jquery-3.3.1.js"></script>
<script>
//Confirm delete
$(document).ready(function(){
	$("#delete").submit(function(){
		var c = confirm("Are you sure you want to delete your account?");
		return c; //return c: true or false
	});
});
</script>
</head>
<body>

<div class = "body-content">
<div class = "module">
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off" enctype="multipart/form-data">
	<div class = "error"><?php echo $_SESSION['message'];?></div>
	<input type="text" placeholder="User Name" name="username" value = "<?php echo $row['username'];?>" required >
      <input type="email" placeholder="Email" name="email" value = "<?php echo $row['email'];?>" required >
      <input type="password" placeholder="Password" name="password" required >
      <input type="password" placeholder="Confirm Password" name="confirmpassword" required >
      <div class="avatar">Zgjidh nje foto profili: <input type="file" name="avatar" accept="image/*"></div>
      <input type="submit" value="Modify"  class="btn">
</form>

<form action = "delete.php" id = "delete">
<input type = "submit" value = "Delete profile" class = "btn" id = "delete" >
</form>

</div>
</div>

</body>
</html>