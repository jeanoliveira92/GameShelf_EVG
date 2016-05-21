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
		<link href="../css/style.css" rel="stylesheet">
		<script src="../scripts/seu-script.js"></script>
	</head>
	<body>
		<div class="auth auth-logo"></div>
		<div class="auth auth-box">
			<form name="loginform" id="loginform" action="login.php" method="post">
				<div class="auth-form">
					<label for="login_field">Username or email address</label>
					<input class="auth-imput"  autocapitalize="off" autocorrect="off" autofocus="autofocus" class="form-control input-block" id="login_field" name="login" tabindex="1" type="text">

					<label for="password">Password <a href="/password_reset" class="label-link" style="float:right">Forgot password?</a></label>
					<input class="auth-imput" id="password" name="senha" tabindex="2" type="password">
					
					 <div class="checkbox">
						<label><input name="remember" type="checkbox"> Lembrar</label>
					</div>		
					<input class="auth-btn" data-disable-with="Signing in…" name="commit" tabindex="3" type="submit" value="Entrar">
				</div>
			</form>
		</div>
	</body>
</html>