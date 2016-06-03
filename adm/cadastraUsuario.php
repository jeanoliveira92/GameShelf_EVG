<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	$nome	= $_POST['nome'];
	$email	= $_POST['email'];
	$senha	= $_POST['senha'];
	$tipo	= $_POST['tipo'];
	
	//variavel que informará a ocorrencia de erros
	$erro = 0;
	
	if(isset($_GET["opt"])){
		$opt 	= $_GET["opt"];
		$id 	= $_GET["id"];
		if(isset($_POST["vSenha"])){
			$pw	= $_POST["vSenha"];
		}
		$sql = "select id from usuarios";
		$query = mysql_query($sql) or die(mysql_error());

		while($ID = mysql_fetch_array($query)){
			$temp = md5(trim($ID['id']));
			
			if($id == $temp){				
				$id = $ID["id"];
				break;
			}
		}
	}else{
		
		$result = mysql_query("select email from usuarios");   
		while ($row = mysql_fetch_array($result)){ 
			if($row['email'] == $email){		
				$erro = 1;
				break;
			}
		}
	}
	if($erro == 1){
		$msg = " E-MAIL JA CONSTA NO SISTEMA";
		
	}else if(empty($nome)){
		$erro = 1;
		$msg = " INFORME O NOME";
		
	}else if(empty($email)){
		$erro = 1;
		$msg = " INFORME SEU E-MAIL";
		
	}else if(empty($email)){
		$erro = 1;
		$msg = " INFORME SEU E-MAIL";
		
	}else if($_POST['email'] != $_POST['email2']){
		$erro = 1;
		$msg = " E-MAILS DIFERENTES";
		
	}else if(strlen($email)<7 || substr_count($email,"@")!=1 || substr_count($email,".")==0){
		//verifica tamanho mínimo do e-mail e se existe "@" e ponto.
		$erro = 1;
		$msg = "E-MAIL NÃO FOI DIGITADO CORRETAMENTE"; 
	
	}else if(!isset($_GET["opt"]) || (isset($_GET["opt"]) && isset($_POST["vSenha"]))){		
		if(empty($senha)){
			$erro = 1;
			$msg = " INFORME A SENHA";
		
		}else if(strlen($senha) < 8){
			$erro = 1;
			$msg = " SENHA DEVE POSSUIR NO MINIMO 8 CARACTERES";
		}			
	}else if($_POST['senha'] !=  $_POST['senha2']){
		$erro = 1;
		$msg = " SENHAS DIFERENTES";
		
	}else if($tipo <= 0 || $tipo >= 3){
		$erro = 1;
		$msg = " INFORME O TIPO DE USUARIO";
		
	}		
	
	//se não há erro, exibe a msg
	if($erro > 0){ echo"<script> alert('$msg'); Location: javascript:history.back(); </script>";
	}else{
		
		$senha = md5(trim($senha));
	
		//aqui podemos realizar o tratamento das informações. ex: gravando em um arquivo ou banco de dados
		if(isset($_GET["opt"])){
			if(isset($_POST["vSenha"])){
				$sql = "update usuarios set nome='$nome', senha='$senha', email='$email', tipo=$tipo where id='$id'";
			}else{
				$sql = "update usuarios set nome='$nome', email='$email', tipo=$tipo where id='$id'";
			}
	
		}else{
			$sql = "insert into usuarios values('NULL','$nome','$senha', '$email', $tipo, '1')";
		}

		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>"); 
		
		$msg = "Cadastro realizado com sucesso";
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";

	}
?>