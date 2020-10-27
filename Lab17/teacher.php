<?php

session_start();

if(!isset($_SESSION['username']) || $_SESSION['role']!="teacher"){
	header("location:index.php");
}

include("welcome.html");

?>
