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
							<form method="post" data-toggle="validator" enctype="multipart/form-data" id="cadastraUsuario" name="cadastraUsuario" 
							<?php	if(isset($id)){	echo "action='cadastraGame.php?opt=update&id=$_GET[id]'";}
									else{			echo "action='cadastraGame.php' ";}						
							?>>
							<?php
							if(isset($id)){
								echo "
								<fieldset class='form-group'>
									<h1> Alteração de Games </h1>
										<div class='row'>
											<div class='col-md-4 fileinput fileinput-new' data-provides='fileinput'>
												<div class='fileinput-new thumbnail'>
													<img src='../img/gamesCover/".$dados['capa']."'>
												</div>										
												<div>
												<h4>Selecione uma imagem</h4>
													<input type='file' class='' name='foto' placeholder='arquivo'>
												<h4>Selecione um banner</h4>
													<input type='file' class='' name='banner' placeholder='arquivo'>
												</div>
											</div>";
											
											
											echo "
											<div class='form-group col-md-6'>
												<label for='nome'>Nome:</label>
												<input type='text' class='form-control' name='nome' data-error='Por favor, informe um nome.' value='$dados[nome]' required>
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
															echo ">$generos[nome]
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
														
														echo ">Single Player</label>
														<label class='radio-inline'><input type='radio' name='optradio' value='Multiplayer'";
														
														if($dados['jogadores'] == 'Multiplayer') echo "checked";
														echo ">Multiplayer</label>
													</div>
												</div>
												<div class='col-md-6'>										
													<label for='date'>Data de Lançamento:</label>
													<input type='date' class='form-control' name='date' value='$dados[dataLanc]'>
												</div>
											</div>
											
											<div class='form-group col-md-6'>
													<label for='genero'>Selecione as Plataformas:</label>
												<div class='checkbox'>";
											
											$genero ="select * from plataformas";		
											$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
											
											while($plataformas = mysql_fetch_array($queryg)){
											echo " <div class='col-md-4'>
														<label class='checkbox-inline'><input type='checkbox' name='p".trim($plataformas['id'])."' value='$plataformas[id]'>$plataformas[nome]</label>
														</div>
														";
													
											}	
											echo "</div>
											</div>
											
					
											<div class='form-group col-md-4'>
												<label for='nome'>Distribuidora:</label>
												<input type='text' class='form-control' name='distribuidora' data-error='Por favor, informe uma distribuidora.'  value='$dados[distribuidora]' required>
													<div class='help-block with-errors'></div>
											</div>
											
											<div class='form-group col-md-2'>
												<div class='form-group'>
												  <label for='classificacao'>Classificação DJCTQ:</label>
												  <select class='form-control' name='classIdade' id='classIdade' required>
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
											<div class='form-group col-md-4'>
												<label for='nome'>Criadores:</label>
												<input type='text' class='form-control' name='criadores' data-error='Por favor, informe um criador.'  value='$dados[criadores]' required>
													<div class='help-block with-errors'></div>
											</div>
											<div class='form-group col-md-2'>
												<div class='form-group'>
												  <label for='classificacao'>Classificação IGN:</label>
												  <input type='number' class='form-control' name='ign' min='0' max='10' step='0.1' value='$dados[ign]'>
												</div>
											</div>
											
											<div class='form-group col-md-10'>
												  <label for='descricao'>Descricao:</label>
												  <textarea class='form-control' rows='10' id='descricao' name ='descricao'>$dados[descricao]</textarea>
											</div>
										</div>	
								
								
								
								
								</fieldset>			
								<button type='submit' class='btn btn-primary'>Alterar</button>";
								
							}else{
								echo "<fieldset class='form-group inline'>
									<h1> Cadastro de Games </h1>
									<div class='row'>
										<div class='col-md-4 fileinput fileinput-new' data-provides='fileinput'>
											<div class='fileinput-new thumbnail'>
												<img src='..\img\gamesCover\default.JPG'>
											</div>											
											<div>
											<h4>Selecione uma imagem</h4>
												<input type='file' class='' name='foto' placeholder='arquivo'>
											<h4>Selecione um banner</h4>
												<input type='file' class='' name='banner' placeholder='arquivo'>
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
													<label class='checkbox-inline'>
														<input type='checkbox' name='g".trim($generos['id'])."' value='$generos[id]'>$generos[nome]
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
													<label class='radio-inline'><input type='radio' name='optradio' value='Single Player' checked>Single Player</label>
													<label class='radio-inline'><input type='radio' name='optradio' value='Multiplayer'>Multiplayer</label>
												</div>
											</div>
											<div class='col-md-6'>										
												<label for='date'>Data de Lançamento:</label>
												<input type='date' class='form-control' name='date'>
											</div>
										</div>
										
										<div class='form-group col-md-6'>
												<label for='genero'>Selecione as Plataformas:</label>
											<div class='checkbox'>";
										
										$genero ="select * from plataformas";		
										$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
										
										while($plataformas = mysql_fetch_array($queryg)){
										echo " <div class='col-md-4'>
													<label class='checkbox-inline'><input type='checkbox' name='p".trim($plataformas['id'])."' value='$plataformas[id]'>$plataformas[nome]</label>
													</div>
													";
												
										}	
										echo "</div>
										</div>
										
				
										<div class='form-group col-md-4'>
											<label for='nome'>Distribuidora:</label>
											<input type='text' class='form-control' name='distribuidora' data-error='Por favor, informe uma distribuidora.' required>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-2'>
											<div class='form-group'>
											  <label for='classificacao'>Classificação DJCTQ:</label>
											  <select class='form-control' name='classIdade' id='classIdade' required>
												<option cheked>1 - Livre</option>
												<option>2 - 10 anos</option>
												<option>3 - 12 anos</option>
												<option>4 - 14 anos</option>
												<option>5 - 16 anos</option>
												<option>6 - 18 anos</option>
											  </select>
											</div>
										</div>
										<div class='form-group col-md-4'>
											<label for='nome'>Criadores:</label>
											<input type='text' class='form-control' name='criadores' data-error='Por favor, informe um criador.' required>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-2'>
											<div class='form-group'>
											  <label for='classificacao'>Classificação IGN:</label>
											  <input type='number' class='form-control' name='ign' min='0' max='10' step='0.1' value='5.0'>
											</div>
										</div>
										
										<div class='form-group col-md-10'>
											  <label for='descricao'>Descricao:</label>
											  <textarea class='form-control' rows='10' id='descricao' name ='descricao'></textarea>
										</div>
									</div>	
								</fieldset>			
								<button type='submit' class='btn btn-primary'>Salvar</button>";
								
							}
							?>
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
							</form>

						<?php include("footer.php"); ?>
						