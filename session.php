<?php 

	include("adm/mysqlconfig.inc");
	
	session_start();
	
	if(isset($_SESSION["id"]) && $_SESSION["nivel"] > 0){
		header("location: logout.php");
	}
	
	//if(!isset($_SESSION["id"])){ 
	//	header("Location: index.php"); 
	//}
?> 