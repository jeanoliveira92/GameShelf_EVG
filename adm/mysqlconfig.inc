<?php

	$servidor = 'localhost';
	$user = 'root';
	$senha = '';
	$banco = 'gameshelf';
	
	$con = mysql_connect($servidor,$user,$senha) or die("Não foi possível conectar ao MYSQL host");
	mysql_select_db($banco) or die("Não foi possível conectar ao DATABASE");
?>