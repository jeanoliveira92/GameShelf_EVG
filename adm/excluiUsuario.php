<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
					
		$sql = "update usuarios set status='0' where id='$id'";
		
		$result = mysql_query($sql);
		
		if(!$result)
			$msg = "Cadastro não encontrado.";
		else{
			$msg = "Cadastro desativado com sucesso!";
		}
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";

	}echo"<script> alert('Id inválido'); Location: location.href='main.php';</script>";
?>