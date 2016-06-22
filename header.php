<?php

	include("session.php");
	ini_set('default_charset','UTF-8');
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- <meta charset="UTF-8"> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Game Shelf. Sua estante pessoal de games">
		<meta charset="utf-8">	
		<title>GAME SHELF</title>	
		<link rel="icon" href="img/favicon.png" type="image/png"/>
		<link rel="shortcut icon" href="img/favicon.png" type="image/png">
		<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
		<script src="js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="js/validator.js"></script>
		<script src="js/jquery.flexslider.js"></script>


	</head>
	<body>
		<div class="container nopadding">
			<header>
				<div class="row nopadding">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<!-- login area -->
						<div class="row nopadding">
							<div class="col-md-12 autor">					
								<ul class="nav navbar-nav navbar-right">
								<?php
								if(!isset($_SESSION["id"])){
									echo "<li>
									<li><p class='navbar-text'>Faça o <a href='signup.php'>registro</a> ou </p></li>
									<li class='dropdown'>
									  <a href='#' class='dropdown-toggle' data-toggle='dropdown'><b>Login</b> <span class='caret'></span></a>
										<ul id='login-dp' class='dropdown-menu'>
												 <div class='row'>
														<div class='col-md-12'>
															Login
															 <form class='form' role='form' method='post' action='login.php'>
																	<div class='form-group'>
																		 <label class='sr-only' for='email'>Email</label>
																		 <input type='email' class='form-control' id='login' name='login' placeholder='Email address' required>
																	</div>
																	<div class='form-group'>
																		 <label class='sr-only' for='exampleInputPassword2'>Senha</label>
																		 <input type='password' class='form-control' id='exampleInputPassword2' name='senha' placeholder='Password' required>
																		 <div class='help-block text-right'><a href=''>Esqueceu a senha ?</a></div>
																	</div>
																	<div class='form-group'>
																		 <button type='submit' class='btn btn-primary btn-block'>Conectar</button>
																	</div>
																	<div class='checkbox'>
																		 <label>
																		 <input type='checkbox' name='remember'> Manter conectado
																		 </label>
																	</div>
															 </form>
														</div>														
														<div class='bottom text-center'>
															<a href='signup.php'><b>Faça o registro</b></a>
														</div>
												 </div>
											</li>";
										}else{
											echo "<li class='dropdown'>
												<a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>$_SESSION[nome]<b class='caret'></b></a>
												<ul class='dropdown-menu'>
													<li><a href='perfil.php'>Perfil</a></li>
													<li class='divider'></li>
													<li><a href='lista.php'>Meus Games</a></li>
													<li class='divider'></li>
													<li><a href='favoritos.php'>Favoritos</a></li>
													<li class='divider'></li>
													<li><a href='logout.php'>Logout</a></li>i
												</ul>
											</li>";
										}
											?>
										</ul>
									</li>
								  </ul>
							</div>
						</div>
						
						<!-- logo and search area -->
						<div class="row head_mid nopadding">
							<div class="col-md-8 nopadding">
								<h1 class="nopadding"><a indepth="true" href="index.php">
										<img src="img/logo.png" alt="Game Shelf">
									</a>
								</h1>
							</div>
							<div class="col-md-4">
								<form class="form" id="userlistform" name="userlistform" action="search.php" method="get">
									<div class="input-group">
										<input name="nome" class="form-control" id="search" type="text" placeholder="Pesquisar Itens">
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">
												<span class="glyphicon glyphicon-search"></span>
											</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						
						<!-- menu area -->						
						<div class="row menu_block nopadding">
							<nav class="navbar nopadding">
								<div class="navbar-header navbar-inverse">
									<button type="button " class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>                        
									</button>
								</div>
								<div class="collapse navbar-collapse nopadding" id="myNavbar">
									<ul class="nav navbar-nav sf-menu sf-js-enabled nopadding">
									   <li class="current"><a indepth="true" href="index.php">Home </a></li>
									   <li><a indepth="true" href="search.php">Games</a></li>
									   <li><a indepth="true" href="index.php">REVIEWS</a></li>
									   <li><a indepth="true" href="index.php">Videos</a></li>
									   <li><a indepth="true" href="index.php">Contacts </a></li>
									 </ul>
								</div>
							</nav>
						</div>
					</div>
				</div>		
			</header>		
				<div class="row nopadding">
					<div class="col-md-1"></div>
					<div class="col-md-10">