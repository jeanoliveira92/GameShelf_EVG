<?php
	// Conex�o com o banco de dados 
	include("adm/mysqlconfig.inc");
	
	// Inicia sess�es 
	session_start();
	
	$id = $_GET['id'];
				
	$sql = "delete from lista where userId='$_SESSION[id]' AND gamesId='$id'";

	$result = mysql_query($sql);
	
	if(!$result)
		$msg = "Game n�o encontrado.";
	else{
		$msg = "Game removido com sucesso!";
	}
	
	echo"<script> alert('$msg'); Location: javascript:history.back();</script>";

?>