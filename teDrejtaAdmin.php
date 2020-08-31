<?php
session_start();
include('mainBar.php');

//if no admin logged in then riderect
if (!isset($_SESSION['adminMode'])){
	header("location: profile.php");
}
?>