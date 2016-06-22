<?php 

	include("mysqlconfig.inc");
	
	session_start(); 
	
	if(!isset($_SESSION["id"]) || $_SESSION["nivel"] != 1){ 
		header("Location: index.php"); 
	}
?> 