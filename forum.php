<?php
session_start();
include("mainBar.php");
include("database_conn.php");

//only registered users may comment
if (!isset($_SESSION['username'])){
	header("location:register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="forum.css" type="text/css">
<script src="jquery-3.3.1.js"></script>
<script>
//confirm delete
$(document).ready(function(){
	$(".delete").click(function(event){
		event.preventDefault();
		var c = confirm("Are you sure you want to delete this comment?");
		if (c == true){
			window.location = $(this).attr('href');
		}
	});
});

// confirm edit
$(document).ready(function(){
	$(".edit").click(function(event){
		window.location = $(this).attr("href");
	});
});
</script>
<style>
a:link {
    text-decoration: none;
	color: rgba(0, 0, 0, 0.5)
}

a:visited {
    text-decoration: none;
	color: rgba(0, 0, 0, 0.5)
}

a:hover {
    color: rgba(0, 0, 0, 0.7);
    text-decoration: underline;
}

a:active {
	color: rgba(0, 0, 0, 0.7);
    text-decoration: underline;
}
</style>
</head>
<body>

<center>
<form method = "post" action = "addComment.php">
	<textarea name = 'message' rows = '3' cols = '40' >
	<?php 
		// This is used for editing purposes. If a user edits his own comments he gets redirected
		// to forum.php again and this code section is executed.
		if (isset($_GET['comment_id'])){
			// Initialize a variable to store the comment id
			$cid = $_GET['comment_id'];
			
			// Make a query to fetch the comment from the database
			$sql = "SELECT * FROM koment WHERE id = '".$cid."';";
			$query_result = mysqli_query($conn, $sql);
		
			// There will be exactly one result to this
			if (mysqli_num_rows($query_result) == 1){
				$row = mysqli_fetch_assoc($query_result);
				echo "".$row['text'];
				
				// Set a editKomment session variable so that we can discern when a comment
				// is being edited and a new comment is being added.
				$_SESSION['editComment'] = $cid;
			}else{
				echo "Error executing query ".mysqli_error($conn);
			}
		}
	?></textarea><br>
	<input type = 'submit' value = 'Comment' class = 'btn' style = 'width: 29.5%' />
</form>

	<?php		
		
		$sql = "SELECT k.text, u.avatar, u.username, k.id FROM koment k INNER JOIN user u "
		."ON k.userID = u.id WHERE movieID ='".$_SESSION['movieID']."';";
		
		$result = mysqli_query($conn, $sql);
		
		while ($row = mysqli_fetch_assoc($result)){
			echo "<div class = 'container'>";
			echo "<img style = 'height: 30px; width: 50px;' src = '".$row['avatar']."'></img>";
			echo "<div class = 'comment '>";
			echo "<div class = 'name'>";
			echo nl2br($row['username'])."<br>";
			echo "</div>";
			echo "<p>";
			echo $row['text'];
			echo "</p></div>";
			echo "</div>";
			$id =$row['id'];
			if (isset($_SESSION['adminMode'])){
				echo "<a href = 'user_delete_comment.php?id=$id' class = 'delete' style='font-family:Book Antiqua;'>Delete</a>&nbsp;&nbsp;&nbsp;
				<a style='font-family:Book Antiqua;' class = 'edit' href = 'forum.php?comment_id=$id'>Edit</a>";
			}
			else if ($_SESSION['username'] === strtolower($row['username'])){
				echo "<a href = 'user_delete_comment.php?id=$id' class = 'delete' style='font-family:Book Antiqua;'>Delete</a>&nbsp;&nbsp;&nbsp;
				<a style='font-family:Book Antiqua;' class = 'edit' href = 'forum.php?comment_id=$id'>Edit</a>";
			}
		}
		mysqli_close($conn);
	?>
</center>
</body>
</html>