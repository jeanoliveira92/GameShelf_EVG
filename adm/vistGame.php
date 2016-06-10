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
				
				$sql ="select * from games where id='$id'";		
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
							<?php
							if(isset($id)){
								echo "
								<fieldset class='form-group'>
									<h1> Alteração de Games </h1>
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
											</div>";
											
											
											echo "
											<div class='form-group col-md-6'>
												<label for='nome'>Nome:</label>
												<input type='text' class='form-control' name='nome' data-error='Por favor, informe um nome.' value='$dados[nome]' readonly>
													<div class='help-block with-errors'></div>
											</div>
											<div class='form-group col-md-6'>
													<label for='genero'>Selecione os Generos:</label>
												<div class='checkbox'>";
										
											
											$genero ="select id,nome from generos";		
											$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
											
											$vet = explode(",", $dados["generos"]);
											
											while($generos = mysql_fetch_array($queryg)){
											echo " <div class='col-md-3'>
														<label class='checkbox-inline'>
															<input type='checkbox' name='g".trim($generos['id'])."' value='$generos[id]' ";
															
															foreach($vet as $var => $valor){
																if($valor == trim($generos['id'])){
																	echo "checked='checked'";
																}
															}
															echo "readonly>$generos[nome]
														</label>
													</div>
													";
													
											}	
											echo "</div>
											</div>
											
											<div class='form-group col-md-6'>										
												<div class='col-md-6'>
													<label for='e-mail'>Número de Jogadores: </label>
													<div class='radio'>
														<label class='radio-inline'><input type='radio' name='optradio' value='Single Player'";
														if($dados['jogadores'] == 'Single Player') echo "checked";
														
														echo "readonly>Single Player</label>
														<label class='radio-inline'><input type='radio' name='optradio' value='Multiplayer'";
														
														if($dados['jogadores'] == 'Multiplayer') echo "checked";
														echo "readonly>Multiplayer</label>
													</div>
												</div>
												<div class='col-md-6'>										
													<label for='date'>Data de Lançamento:</label>
													<input type='date' class='form-control' name='date' value='$dados[dataLanc]' readonly>
												</div>
											</div>
											
											<div class='form-group col-md-6'>
													<label for='genero'>Selecione as Plataformas:</label>
												<div class='checkbox'>";
											
											$genero ="select * from plataformas";		
											$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
											
											while($plataformas = mysql_fetch_array($queryg)){
											echo " <div class='col-md-4'>
														<label class='checkbox-inline'><input type='checkbox' name='p".trim($plataformas['id'])."' value='$plataformas[id]' readonly>$plataformas[nome]</label>
														</div>
														";
													
											}	
											echo "</div>
											</div>
											
					
											<div class='form-group col-md-6'>
												<label for='nome'>Distribuidora:</label>
												<input type='text' class='form-control' name='distribuidora' data-error='Por favor, informe uma distribuidora.'  value='$dados[distribuidora]' readonly>
													<div class='help-block with-errors'></div>
											</div>
											<div class='form-group col-md-6'>
												<label for='nome'>Criadores:</label>
												<input type='text' class='form-control' name='criadores' data-error='Por favor, informe um criador.'  value='$dados[criadores]' readonly>
													<div class='help-block with-errors'></div>
											</div>
											<div class='form-group col-md-2'>
												<div class='form-group'>
												  <label for='classificacao'>Classificação DJCTQ:</label>
												  <select class='form-control' name='classIdade' id='classIdade' readonly>
													<option "; 
														if($dados['classIdade'] == '1 - Livre'){ echo "checked";} 
													echo ">1 - Livre</option>
													<option "; 
														if($dados['classIdade'] == '2 - 10 anos'){ echo "checked";}
													echo ">2 - 10 anos</option>
													<option "; 
														if($dados['classIdade'] == '3 - 12 anos'){ echo "checked";}
													echo ">3 - 12 anos</option>
													<option "; 
														if($dados['classIdade'] == '4 - 14 anos'){ echo "checked";}
													echo ">4 - 14 anos</option>
													<option ";
														if($dados['classIdade'] == '5 - 16 anos'){ echo "checked";}
													echo ">5 - 16 anos</option>
													<option "; 
														if($dados['classIdade'] == '6 - 18 anos'){ echo "checked>
														";}
													echo ">6 - 18 anos</option>
												  </select>
												</div>
											</div>
											<div class='form-group col-md-2'>
												<div class='form-group'>
												  <label for='classificacao'>Classificação IGN:</label>
												  <input type='number' class='form-control' name='ign' min='0' max='10' step='0.1' value='$dados[ign]' readonly>
												</div>
											</div>
											
											<div class='form-group col-md-10'>
												  <label for='descricao'>Descricao:</label>
												  <textarea class='form-control' rows='10' id='descricao' name ='descricao' readonly>$dados[descricao]</textarea>
											</div>
										</div>
								</fieldset>
								<a href='cadgame.php?opt=update&id=$id' class='btn btn-primary'>Editar</a>";
							}
							?>
							
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
							</form>

						<?php include("footer.php"); ?>
						