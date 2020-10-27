<?php

session_start();

if(!isset($_SESSION['username']) || $_SESSION['role']!="admin"){
	header("location:index.php");
}

include("welcome.html");

?>
