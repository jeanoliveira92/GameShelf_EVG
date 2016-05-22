<?php

	include("session.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>EVG - ADMINISTRATIVO</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="../css/style.css" rel="stylesheet">
		<script src="../js/jquery-1.12.3.min.js"></script>
		<script src="../js/script.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<img alt="logo" src="../img/logo_35p.png">
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a><?php
								setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
								date_default_timezone_set('America/Sao_Paulo');
								echo strftime('%A, %d de %B de %Y', strtotime('today'));
						?></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["nome"]; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Perfil</a></li>
								<li class="divider"></li>
								<li><a href="#">Confirgurações</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav> <!-- final do navbar -->	