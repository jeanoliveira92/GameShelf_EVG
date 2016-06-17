<?php

	include("session.php");
	
	$userId = $_SESSION['id'];
	$gameId = $_GET['id'];
	
	$sql = "select * from favoritos where userId=$userId AND gamesId=$gameId";
	$result_id = mysql_query($sql);
	$total = mysql_num_rows($result_id); 
	
	if($total == 0){
		$sql = "insert into favoritos values($userId, $gameId)";
		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>");
		
		echo"<script> alert('Sucesso ao adicionar aos favoritos'); Location: location.href='search.php';</script>";
	}

		echo"<script> alert('Jogo já favoritado'); Location: location.href='index.php';</script>";
?>