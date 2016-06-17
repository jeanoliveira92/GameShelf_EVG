<?php include("header.php"); ?>		
		
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
								<?php 
								//SETANDO CLIENT NO FORMULARIO				
										
								$id = $_SESSION['id'];
								
								$sql ="select * from assinantes where id='$id'";		
								$query = mysql_query($sql) or die("Deu erro".mysql_error());

								$dados = mysql_fetch_array($query);	

								
								echo "<fieldset class='form-group'>
										<div class='row'>
											<div class='form-group col-md-5'>
												<label for='nome'>Nome:</label>
												<input type='text' class='form-control' name='nome' value='$dados[nome]' readonly>
											</div>
											<div class='form-group col-md-5'>
												<label for='nome'>Data do cadastro:</label>
												<input type='text' class='form-control' name='nome' value='".$dados['registro']."' readonly>
											</div>
										</div>
										<div class='row'>
											<div class='form-group col-md-5'>
												<label for='e-mail'>E-mail:</label>
												<input type='email' class='form-control'  name='email' value='$dados[email]' readonly>
											</div>
										</div>	
									</fieldset>					
								<div class='col-md-2 nopadding'><a class='btn btn-primary sbt' href='edit.php'>Alterar</a></div>";
							?>
								<div class="col-md-2 nopadding"><a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a></div>
							</form>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>