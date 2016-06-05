<?php 

	include("mysqlconfig.inc");
	
	session_start(); 

	if(!isset($_SESSION["id"])){ 
		header("Location: index.php"); 
	}
?> 