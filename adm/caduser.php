		<?php include("header.php"); 
		
			if($_SESSION["tipo"] > 1){ 
				//se não há erro, exibe a msg
				echo"<script> alert('Você não possui permissões para esta ação.'); Location: javascript:history.back(); </script>";
			}
		?>
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
				<?php include("left-sidebar.php"); ?>
					<div class="col-md-9">
						<div class="col-md-12">
							<form id="cadastraUsuario" name="cadastraUsuario" action="cadastraUsuario.php" method="post">
								<fieldset class="form-group">
									<h1> Cadastro de Usuários </h1>
									<div class="row">
										<div class="form-group col-md-5">
											<label for="nome">Nome:</label>
											<input type="text" class="form-control" name="nome">
										</div>
										<div class="form-group col-md-4">
											<label for="campo1">Tipo da Conta:</label>
											<div class="radio" >
											  <label class="radio-inline">
												<input type="radio" name="tipo" value="2" checked> Moderador
											  </label>
											  <label class="radio-inline">
												<input type="radio" name="tipo"  value="1"> Adminstrador
											  </label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-5">
											<label for="e-mail">E-mail:</label>
											<input type="email" class="form-control"  name="email">
										</div>
										<div class="form-group col-md-5">
											<label for="email2">Repita o e-mail:</label>
											<input type="email" class="form-control" name="email2">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-5">
											<label for="senha">Senha:</label>
											<input type="password" class="form-control" name="senha">
										</div>
										<div class="form-group col-md-5">
											<label for="senha2">Repita a senha:</label>
											<input type="password" class="form-control" name="senha2">
										</div>
									</div>	
								</fieldset>			
								<button type="submit" class="btn btn-primary">Salvar</button>
								<a href="main.php" class="btn btn-default">Cancelar</a>
							</form>

						<?php include("footer.php"); ?>