<?php

	$servidor = 'sql112.gratisphphost.info';
	$user = 'phpgr_18081095';
	$senha = 'swatte';
	$banco = 'phpgr_18081095_gameshelf';
	
	$con = mysql_connect($servidor,$user,$senha) or die("Não foi possível conectar ao MYSQL host");
	mysql_select_db($banco) or die("Não foi possível conectar ao DATABASE");
?>