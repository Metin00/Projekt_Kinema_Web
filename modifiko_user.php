<?php
include('teDrejtaAdmin.php');
include('database_conn.php');
//Deklarojme nje variabel userModifikim i cili perdoret per te moslejuar aksesimin 
//e faqeve editUser dhe admin_delete  vecse nga faqa modifiko_user
$_SESSION['userModifikim']="SET";
$_SESSION['userDelete']="SET";


//query: zgjedhim te gjithe te dhenat e perdoruesve
$sql = "SELECT * FROM user;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
	echo "<center>";
	echo $_SESSION['message2'];
	echo "<table border = '1'>";
	echo "<tr><th>Id</th><th>Emri i Perdoruesit</th><th>email</th><th>Statusi</th>
	<th>Actions <ul><li>Edito</li><li>Fshi</li></ul></th></tr>";
	while ($row = mysqli_fetch_assoc($result)){
		echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>".$row['status']."</td><td><ul><li><a href = 'editUser.php?id="
		.$row['id']."'>Edit</a></li><li><a class = 'delete' href = 'admin_delete.php?id=".$row['id']."'>Fshi</a></li></ul></td></tr>";
	
	echo "</center>";
	}
}else{
	echo "Error executing query ".mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<head>
<script src="jquery-3.3.1.js"></script>
<script>

$(document).ready(function(){
	$("tr:even").css("background-color", "rgba(0, 0, 0, 0.2)");
	$("tr:odd").css("background-color", "rgba(0, 0, 0, 0.4)");
});

</script>
<script>
//Confirm delete
$(document).ready(function(){
	$(".delete").click(function(event){
		event.preventDefault();
		var c = confirm("A je i sigurt qe do t'a fshish kete?");
		if (c == true){
			window.location = $(this).attr('href');
		}
	});
});
</script>
</head>
<html>
</html>