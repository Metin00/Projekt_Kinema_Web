<?php
//Take the URL parameter
$q = $_REQUEST['q'];
$hint = "";

$servername = "127.0.0.1";
$username = 'root';
$password = '';
$database = 'kinema';

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
	die ("Unable to connect to server ".mysqli_connect_error());
}
$sql = "SELECT titulli FROM movies WHERE titulli LIKE '$q%';";
$result = mysqli_query($conn, $sql);
 
$tituj_filmash = array();
//We convert the result into an array
if (mysqli_num_rows($result)>=1){
	while ($row = mysqli_fetch_assoc($result)){
		$tituj_filmash[] = $row;
	}
}

mysqli_close($conn);


//if q != "" then search for possible results
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($tituj_filmash as $name) {
            if ($hint === "") {
                $hint = $name['titulli'];
            } else {
                $hint .= ", ".$name['titulli']."";
            }
    }
}

//If nothing was found, create an appropriate message
echo $hint === "" ? "Nga kerkimi nuk u gjet gje!" : $hint;


 
//Ky kusht 'if' hequr nga foreach loop i mesiperm
//if (stristr($q, substr($name['titulli'], 0, $len))) {}
?>

