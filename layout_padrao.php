<?php include("header.php"); 
		if(isset($_SESSION['id'])) 
			echo "<script>Location: location.href='index.php';</script>";	
?>		
		
		<div class="row nopadding">
			<!-- PART II -->
			<div class="col-md-12 content page1">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-9">
						<h2>Crie uma nova conta</h2>
					</div>
				</div>
				<div class="row page">
					<div class="col-md-3"><?php //include("user-sidebar.php"); ?></div>
					<div class="col-md-9">
						<form method="post" data-toggle="validator"  id="cadastraAssinante" name="cadastraAssinante" action="cadastraAssinante.php">
							<fieldset class="form-group">
								<div class="row">
									<div class="form-group col-md-5">
										<label for="nome">Nome:</label>
										<input type="text" class="form-control" name="nome" data-error="Por favor, informe um nome." required>
											<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<label for="e-mail">E-mail:</label>
										<input type="email" class="form-control"  name="email" required>
									</div>
									<div class="col-md-5">
										<label for="email2">Repita o e-mail:</label>
										<input type="email" class="form-control" name="email2" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<label for="senha" required>Senha:</label>
										<input type="password" class="form-control" name="senha" data-error="Mínimo 8 caracteres." required>
											<div class="help-block with-errors"></div>
									</div>
									<div class="form-group col-md-5">
										<label for="senha2" required>Repita a senha:</label>
										<input type="password" class="form-control" name="senha2" data-error="Confirme a senha." required>
											<div class="help-block with-errors"></div>
									</div>
								</div>	
							</fieldset>			
							<button type="submit" class="btn btn-primary sbt">Salvar</button>
							<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
						</form>	
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>