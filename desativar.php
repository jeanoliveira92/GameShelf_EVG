<?php
	// Conex�o com o banco de dados 
	include("adm/mysqlconfig.inc");
	
	// Inicia sess�es 
	session_start();
	
	$id = $_SESSION['id'];
	
				
	$sql = "update assinantes set status='0' where id='$id'";
	
	$result = mysql_query($sql);
	
	if(!$result)
		$msg = "Cadastro n�o encontrado.";
	else{
		$msg = "Cadastro desativado com sucesso!";
	}
	
	echo"<script> alert('$msg'); Location: location.href='logout.php';</script>";

?>