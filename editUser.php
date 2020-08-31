<?php
include('teDrejtaAdmin.php');
include('database_conn.php');
if (!isset($_SESSION['userModifikim'])){
	header("location: modifiko_user.php");
}

//Retrieve id from GET superglobal and then query to select the record in the database
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id =".$id.";";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)== 1){
	$row = mysqli_fetch_assoc($result);
}
else{
	echo "Nuk mund te ekzekutohej query".mysqli_error($conn);
}
mysqli_close($conn);
	
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="profili.css" type="text/css">
</head>
<body>
<div class = "body-content">
	<div class = "module">
		<form method = "post" action = "edit.php?id='<?php echo $_GET['id']?>'" autocomplete = "off">
		<input type="text" placeholder="User Name" name="username" value = "<?php echo $row['username'];?>"required>
		<input type="text" placeholder="Status" name = "status" value = "<?php echo $row['status'];?>" required>
		<input type="text" placeholder='foto' name = 'avatar'>
		<input type="submit" value="Edit" class="btn">
		</form>
	</div>
</div>
</body>
</html>