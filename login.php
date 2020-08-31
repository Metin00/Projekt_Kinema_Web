<?php
session_start();
//The first page that will be opened is mainPage.php. So that, if the user searches 
//for another page it will not open if mainPage.php was not visited first
//If that page hasn't been opened first we will redirect there
//mainPageVisited is a flag variable to check 
if (!isset($_SESSION['mainPageVisited'])){
	header("location: mainPage.php");
}

?>

<?php
if (!isset($_SESSION['message'])){
	$_SESSION['message']='';
}	
//If a user is already loged in
if (isset($_SESSION['username'])){
	header('location:profile.php');
}
include('mainBar.php');
include('database_conn.php');

//If the user entered data and clicked 'login'
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	function cleanseData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		return $data;
	}
	//Validate: 
	//if a username was actually entered we proceed
	//otherwise we will not
	if (!empty($_POST['username'])){
	$username = cleanseData(mysqli_real_escape_string($conn, $_POST['username']));
	$password = cleanseData(mysqli_real_escape_string($conn, $_POST['password']));
	//Provide basic encryption 
	$password = md5($password);
	
	$sql = "SELECT * FROM user WHERE username ='".$username."' AND password = '".$password."';";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result)==1){
		$_SESSION['username'] = $username;
		
		$row = mysqli_fetch_assoc($result);
		$_SESSION['foto'] = $row['avatar'];
		
		mysqli_close($conn);
		$_SESSION['message']="Login u krye me sukses";
		header("location: profile.php");
	}else{
		$_SESSION['message']="Te dhenat qe futet nuk jane te sakta.";
		mysqli_close($conn);
	}
	}
}

?>
<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="profili.css" type="text/css">
<div class = "body-content">
<div class = "module">
<h1>Login</h1>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete = "off" enctype="multipart/form-data">
	<div class = "error"><?php echo $_SESSION['message'];?></div>
	<input type="text" placeholder="User Name" name="username" required autocomplete = "off">
    <input type="password" placeholder="Password" name="password" required autocomplete = "off">
    <input type="submit" value="Login" name="register" class="btn">
</form>

<form action = "register.php">
<center><h1 class = 'error'>Ose</h1></center>
<input type="submit" value="Register" name="register" class="btn" >
</form>
</body>
</html>