<?php
	// Conex�o com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sess�es 
	session_start();
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
					
		$sql = "update usuarios set status='0' where id='$id'";
		
		$result = mysql_query($sql);
		
		if(!$result)
			$msg = "Cadastro n�o encontrado.";
		else{
			$msg = "Cadastro desativado com sucesso!";
		}
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";

	}echo"<script> alert('Id inv�lido'); Location: location.href='main.php';</script>";
?>