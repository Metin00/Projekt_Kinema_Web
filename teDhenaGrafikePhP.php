<?php

include('database_conn.php');

$sql = "SELECT titulli, IMDB FROM movies;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0){
	$array = array();
	while ($row = mysqli_fetch_assoc($result)){
		$array[] = $row;
	}
}else{
	die ("Could not execute query ".mysqli_error($conn));
}

print json_encode($array);

?>
