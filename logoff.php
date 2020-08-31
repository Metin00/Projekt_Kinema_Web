<?php
//Destroy the session in order to logout  , logout behet duke fshire variablat e session-it
session_start();
session_unset();
session_destroy();
header("location:profile.php");
?>