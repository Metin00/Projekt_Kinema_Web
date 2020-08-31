<?php
//lidhjet me databazen

$server = '127.0.0.1';                           // specifikojne : serverin , username,pw ,databaze
$username = 'root';
$password = '';
$database = 'kinema';

$conn = mysqli_connect($server, $username, $password, $database);               // funkioni qe lidh me databazen
if (!$conn){
	die ("Error while connecting to database".mysqli_connect_error());                     // cdo file qe ka nevoje te lidhet me databazen do therrasi kete file , therritet kjo file vazhdimisht qe mos perseritet kodi , 
}

?>   