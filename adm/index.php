<?php
	// Inicia a sessão 
	session_start(); 

	// Verifica se existe dados de login na sessão  
	if(isset($_SESSION["id"]) && $_SESSION["tipo"] == "usuario"){
		header("Location: main.php"); 
	
	// Verifica se existe dados de login no cookie 
	}else if(isset($_COOKIE["login"])){ 
		header("Location: login.php"); 
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<title>EVG - LOGIN</title>		
		<link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
		<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="../css/style.css" rel="stylesheet">
		<script src="../js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class='col-md-4'></div>
        <div class="col-md-4">
			<div class="row auth-logo"></div>
            <div class="login-box well">
				<form action="login.php" method="post">
					<div class="form-group">
						<label for="username-email">E-mail</label>
						<input id="username-email" value='' placeholder="E-mail" type="text" name="login" class="form-control" />
					</div>
					<div class="form-group">
						<label for="password">Senha</label>
						<input id="password" value='' placeholder="Password" type="password" name="senha"  class="form-control" />
					</div>
					<div class="input-group">
						<div class="checkbox">
							<label>
							  <input id="login-remember" type="checkbox" name="remember"> Lembrar-me
							</label>
							
							<label for="password" style="float:right"><a href="/password_reset" class="label-link">Esqueceu a senha?</a></label>
						</div>
					</div>
					<div class="form-group">
						<input class="btn-login" type="submit" value="Entrar">					
					</div>
                    </form>
            </div>
        </div>
        <div class='col-md-4'></div>
	</body>
</html>