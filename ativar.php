<?php		
	// Inicia sessões 
	session_start(); 

	// Conexão com o banco de dados 
	include("adm/mysqlconfig.inc");
	
	$sql = "update assinantes set status='1' where id='$_GET[id];'";
	mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>");
	echo "<script> alert('Cadastro ativado com sucesso! Volte e relog com a conta.'); Location: location.href='index.php'; </script>"; 		
?>