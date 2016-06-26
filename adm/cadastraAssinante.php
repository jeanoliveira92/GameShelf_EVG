<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	$nome	= $_POST['nome'];
	$email	= $_POST['email'];
	$senha	= $_POST['senha'];
	
	//variavel que informará a ocorrencia de erros
	$erro = 0;
	
	if(isset($_GET["opt"])){
		$opt 	= $_GET["opt"];
		$id 	= $_GET["id"];
		if(isset($_POST["vSenha"])){
			$pw	= $_POST["vSenha"];
		}
		$sql = "select id from assinantes";
		$query = mysql_query($sql) or die(mysql_error());

		while($ID = mysql_fetch_array($query)){
			$temp = md5(trim($ID['id']));
			
			if($id == $temp){				
				$id = $ID["id"];
				break;
			}
		}
	}
	if($erro == 1){ echo"<script> alert('$msg'); Location: javascript:history.back(); </script>";
	//se não há erro, exibe a msg
	}else{
		
		$senha = md5(trim($senha));
	
		//aqui podemos realizar o tratamento das informações. ex: gravando em um arquivo ou banco de dados
		if(isset($_GET["opt"])){
			
			if(isset($_POST["status"])){
				$status = ", status='1'";				
			}else{
				$status = "";
			}	
			
			if(isset($_POST["vSenha"])){
				$sql = "update assinantes set nome='$nome', senha='$senha', email='$email'  $status where id='$id'";
				$msg = "Cadastro atualizado com sucesso";
			}else{
				$sql = "update assinantes set nome='$nome', email='$email' $status where id='$id'";
				$msg = "Cadastro atualizado com sucesso";
			}
	
		}else{
			$sql = "insert into assinantes values('NULL','$nome','$senha', '$email', now(), '1')";
				$msg = "Cadastro realizado com sucesso";
		}

		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>"); 
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";
	}
?>