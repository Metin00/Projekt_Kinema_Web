<?php
include('teDrejtaAdmin.php');
include('database_conn.php');


if (!$conn){
	die ("Could not connect to database".mysqli_connect_error());
}

$u = $_POST["username"];
$s = $_POST["status"];


$sql = "UPDATE user SET username = '".$u."', status = ".$s." WHERE id = ".$_GET['id'].";";
//Of course, an email is supposed to be send to the user since he then could
//no longer loging (if a new username was provided for him)

if (mysqli_query($conn, $sql)){
		$_SESSION['message2'] = "Edit was successful";
		//If the admin has placed a value then he wanted to remove the profile picture of the user.(The picture cannot be removed, only changed)
		if (isset($_POST['avatar'])){
			$sql2 = "UPDATE user SET avatar = NULL WHERE id =".$_GET['id'].";";
				if (mysqli_query($conn, $sql2)){
						header("location: modifiko_user.php");
				}else{
					$_SESSION['message2'] = "Edit was unsuccessful ".mysqli_error($conn);
					header("location: modifiko_user.php");
				}
		}
		header("location: modifiko_user.php");
}
else{
		$_SESSION['message2'] = " Edit failed ".mysqli_error($conn);
		header("location: modifiko_user.php");
}

mysqli_close($conn);
?>