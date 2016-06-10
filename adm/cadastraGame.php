<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	$nome = $_POST['nome'];	
	
	//variavel que informará a ocorrencia de erros
	$erro = 0;
	
	if(isset($_GET["opt"])){
		$opt 	= $_GET["opt"];
		$id 	= $_GET["id"];
		
		$sql = "select id from games";
		$query = mysql_query($sql) or die(mysql_error());

		while($ID = mysql_fetch_array($query)){
			$temp = md5(trim($ID['id']));
			
			if($id == $temp){				
				$id = $ID["id"];
				break;
			}
		}
	}else{
		
		$result = mysql_query("select nome from games");   
		while ($row = mysql_fetch_array($result)){ 
			if($row['nome'] == $nome){
				$erro = 1;
				break;
			}
		}
	}

	if($erro == 1){ echo"<script> alert('Game já cadastrado!'); Location: javascript:history.back(); </script>";
	//se não há erro, exibe a msg
	}else{
	
		$result = mysql_query("select id from generos");   
		$generos = "";
		
		while ($row = mysql_fetch_array($result)){ 
			$key = "g".$row['id'];
			if(isset($_POST[$key]) && $_POST[$key] == $row['id']){
				$generos .= $row['id'].",";
			}
		}
		
		$generos = substr($generos,0,-1);
		
		$numPlayers = $_POST['optradio'];
		$data_lanc = $_POST['date'];
		
		$result = mysql_query("select id from plataformas");   
		$plataformas = "";
		
		while ($row = mysql_fetch_array($result)){ 
			$key = "p".$row['id'];
			if(isset($_POST[$key]) && $_POST[$key] == $row['id']){
				$plataformas .= $row['id'].",";
			}
		}
		
		$plataformas = substr($plataformas,0,-1);
		
		$distribuidora 	= $_POST['distribuidora'];
		$criadores 		= $_POST['criadores'];
		$classIdade 	= $_POST['classIdade'];
		$ign 			= $_POST['ign'];
		$descricao 		= $_POST['descricao'];
		
	
		//aqui podemos realizar o tratamento das informações. ex: gravando em um arquivo ou banco de dados
		if(isset($_GET["opt"])){
			$sql = "update games set nome='$nome', generos='$generos', jogadores='$numPlayers', dataLanc='$data_lanc', plataformas='$plataformas', distribuidora='$distribuidora', criadores='$criadores', classIdade='$classIdade', ign='$ign', descricao='$descricao'  where id='$id'";
			$msg = "Cadastro atualizado com sucesso";
			echo $generos;			
			echo "update";
		}else{
			$sql = "insert into games values('NULL','$nome','$generos', '$numPlayers', '$data_lanc', '$plataformas', '$distribuidora', '$criadores', '$classIdade', '$ign', '$descricao', 'NULL')";
			$msg = "Cadastro realizado com sucesso";
		}

		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>"); 
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";
	}
?>