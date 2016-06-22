<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	$nome	= $_POST['nome'];
	$descricao	= $_POST['descricao'];
	
	
	//variavel que informará a ocorrencia de erros
	$erro = 0;
	
	if(isset($_GET["opt"])){
		$opt 	= $_GET["opt"];
		$id 	= $_GET["id"];
		
		$sql = "select id from generos";
		$query = mysql_query($sql) or die(mysql_error());

		while($ID = mysql_fetch_array($query)){
			$temp = md5(trim($ID['id']));
			
			if($id == $temp){				
				$id = $ID["id"];
				break;
			}
		}
	}else{
		
		$result = mysql_query("select nome from generos");   
		while ($row = mysql_fetch_array($result)){ 
			if($row['nome'] == $nome){
				$erro = 1;
				break;
			}
		}
	}

	if($erro == 1){ echo"<script> alert('Gênero já cadastrado!'); Location: javascript:history.back(); </script>";
	//se não há erro, exibe a msg
	}else{
	
		//aqui podemos realizar o tratamento das informações. ex: gravando em um arquivo ou banco de dados
		if(isset($_GET["opt"])){
			
				$sql = "update generos set nome='$nome', descricao='$descricao' where id='$id'";
				$msg = "Cadastro atualizado com sucesso";	
		}else{
			$sql = "insert into generos values('NULL','$nome','$descricao', '0')";
				$msg = "Cadastro realizado com sucesso";
		}

		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>"); 
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";
	}
?>