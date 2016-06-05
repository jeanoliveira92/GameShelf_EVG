		<?php include("header.php"); 
		
			if($_SESSION["tipo"] > 1){ 
				//se não há erro, exibe a msg
				echo"<script> alert('Você não possui permissões para esta ação.'); Location: javascript:history.back(); </script>";
			}
			
			if(isset($_GET['id'])){			
				$id = $_GET['id'];

				$sql = "select id from usuarios";
				// implementar depois o select id from usuario where id='$id';
				
				$query = mysql_query($sql) or die(mysql_error());

				while($ID = mysql_fetch_array($query)){
					$temp = md5(trim($ID['id']));
					
					if($id == $temp){				
						$id = $ID["id"];
						break;
					}
				}
				
				// SETANDO CLIENT NO FORMULARIO
				
				$sql ="select * from usuarios where id='$id'";		
				$query = mysql_query($sql) or die("Deu erro".mysql_error());

				$dados = mysql_fetch_array($query);	
			}
		?>
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
				<?php include("left-sidebar.php"); ?>
					<div class="col-md-9">
						<div class="col-md-12">
							<form method="post" data-toggle="validator"  id="cadastraUsuario" name="cadastraUsuario" 
							<?php	if(isset($id)){	echo "action='cadastraGame.php?opt=update&id=$_GET[id]'";}
									else{			echo "action='cadastraGame.php'";}						
							?>>
							<?php
							if(isset($id)){
								echo "
								<fieldset class='form-group'>
									<h1> Alteração de Games </h1>
									
								</fieldset>			
								<button type='submit' class='btn btn-primary'>Alterar</button>";
								
							}else{
								echo "<fieldset class='form-group inline'>
									<h1> Cadastro de Games </h1>
									<div class='row'>
										<div class='col-md-4 fileinput fileinput-new' data-provides='fileinput'>
											<div class='fileinput-new thumbnail'>
												<img src='https://s3-sa-east-1.amazonaws.com/metroca/13/conversions/thumb.jpg'>
											</div>											
											<div>
												<span class='btn btn-primary btn-file'>
													<span class='fileinput-new'>Selecionar imagem</span>
													<input type='file' name='profile_picture' style='display:none;'>
												</span>
												<a href='#' class='btn btn-primary fileinput-exists' data-dismiss='fileinput'>Remover imagem</a>
											</div>
										</div>
										
										<div class='form-group col-md-6'>
											<label for='nome'>Nome:</label>
											<input type='text' class='form-control' name='nome' data-error='Por favor, informe um nome.' required>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-6'>
												<label for='genero'>Selecione os Generos:</label>
											<div class='checkbox'>";
										
										$genero ="select * from generos";		
										$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
										
										while($generos = mysql_fetch_array($queryg)){
										echo " <div class='col-md-3'>
													<label class='checkbox-inline'><input type='checkbox' name='".trim($generos['nome'])."' value='$generos[id]'>$generos[nome]</label>
													</div>
													";
												
										}	
										echo "</div>
										</div>
										
										<div class='form-group col-md-6'>										
											<div class='col-md-6'>
												<label for='e-mail'>Número de Jogadores: </label>
												<div class='radio'>
													<label class='radio-inline'><input type='radio' name='optradio' checked>Single Player</label>
													<label class='radio-inline'><input type='radio' name='optradio'>Multiplayer</label>
												</div>
											</div>
											<div class='col-md-6'>										
												<label for='date'>Data de Lançamento:</label>
												<input type='date' class='form-control' name='date'>
											</div>
										</div>
										
										<div class='form-group col-md-5'>
											<label for='senha' required>Senha:</label>
											<input type='password' class='form-control' name='senha' data-error='Mínimo 8 caracteres.' required>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-5'>
											<label for='senha2' required>Repita a senha:</label>
											<input type='password' class='form-control' name='senha2' data-error='Confirme a senha.' required>
												<div class='help-block with-errors'></div>
										</div>
									</div>	
								</fieldset>			
								<button type='submit' class='btn btn-primary'>Salvar</button>";
								
							}
							?>
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
							</form>

						<?php include("footer.php"); ?>
						