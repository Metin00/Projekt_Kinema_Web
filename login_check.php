<?php

//This file will protect other files that require login
//If no user was logged in redirect to mainPage.php
if (!isset($_SESSION['username'])){
	header("location:mainPage.php");
}
?>