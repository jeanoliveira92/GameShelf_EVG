<?php include("header.php"); ?>		
					<!-- Modal -->
			<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalLabel">Desativar conta</h4>
				  </div>
				  <div class="modal-body">
					Deseja realmente desativar a conta?
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="remover();">Sim</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
				  </div>
				</div>
			  </div>
			</div> <!-- /.modal -->
		<div class="row nopadding">
			<!-- PART II -->
			<div class="col-md-12 content page1">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-9">
						<h2>Página do Assinante</h2>
					</div>
				</div>
				<div class="row page">
					<div class="col-md-3"></div>
					<div class="col-md-9">
								<form method="post" data-toggle="validator"  id="cadastraAssinante" name="cadastraUsuario" 
								<?php	
										$id = $_SESSION['id'];
										echo "action='cadastraAssinante.php?opt=update&id=$_SESSION[id]'";				
								?>>
								<?php 
								//SETANDO CLIENT NO FORMULARIO				
								
								$sql ="select * from assinantes where id='$id'";		
								$query = mysql_query($sql) or die("Deu erro".mysql_error());

								$dados = mysql_fetch_array($query);	

								
								echo "<fieldset class='form-group'>
										<div class='row'>
											<div class='form-group col-md-5'>
												<label for='nome'>Nome:</label>
												<input type='text' class='form-control' name='nome' value='$dados[nome]' required>
											</div>
										</div>
										<div class='row'>
										<div class='form-group col-md-5'>
											<label for='e-mail'>E-mail:</label>
											<input type='email' class='form-control'  name='email' required>
										</div>
										<div class='form-group col-md-5'>
											<label for='email2'>Repita o e-mail:</label>
											<input type='email' class='form-control' name='email2' required>
										</div>
										</div>
										<div class='row'>
											<div class='form-group col-md-12'>
												<label for='campo1'>Selecione caso deseje alterar a senha:</label>
												<div class='radio' style='display: inline;'>
												  <label class='radio-inline'>
													<input type='checkbox' name='vSenha' > Alterar Senha
												  </label>
												</div>
											</div>
										</div>
										<div class='row'>
											<div class='form-group col-md-5'>
												<label for='senha'>Senha:</label>
												<input type='password' class='form-control' name='senha'>
											</div>
											<div class='form-group col-md-5'>
												<label for='senha2'>Repita a senha:</label>
												<input type='password' class='form-control' name='senha2'>
											</div>
										</div>			
									</fieldset>		

								<div class='col-md-2 nopadding'><button type='submit' class='btn btn-primary sbt'>Alterar</button></div>";		
							?>
								<div class="col-md-2 nopadding"><a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a></div>
								<script language="javascript">
								function remover(){
									Location: location.href='desativar.php';
								}
								</script>
								<div class="col-md-6" style="text-align: right"><a data-toggle="modal" data-target="#delete-modal" class="btn sbt">Desativar conta</a></div>
							</form>
								
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>