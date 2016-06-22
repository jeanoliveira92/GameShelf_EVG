<?php include("header.php"); 
		//if(isset($_SESSION['id'])) 
			//echo "<script>Location: location.href='index.php';</script>";	
?>		

			
		<div class="row nopadding content page1">
			<div class="row banner">
				<div class="col-md-12 banner" style="background-image: url(img/gamesCover/assassinsCover.jpg)">
				</div>
			</div>
			<div class="col-md-12">	
				<div class="row page">
					<div class="col-md-12">							
						<?php
						
							$id = $_GET['id'];
							
							$sql = "select id from games";
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
							echo "<h1 style='padding-top: 20px'>$dados[nome]</h1>	
							</div>
						</div>
						<div class='row'>
								<div class='row nopadding form-inline'>
								
									<div class='col-md-4 fileinput' style='background-image: URL(img/gamesCover/assassinsCoverMini.jpg)'>
									</div>

									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='nome'>Nome:</label>
										</div>
										<div class='form-group col-md-9'>
											<input type='text' class='form-control' name='nome' value='$dados[nome]' readonly>	
										</div>
									</div>
									
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='genero'>Generos:</label>
										</div>";
									
									$genero ="select id,nome from generos";		
									$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
									
									$vet = explode(",", $dados["generos"]);
									$var = "";
									while($generos = mysql_fetch_array($queryg)){
										$var .= $generos['nome'].", ";											
									}	
									echo "
										<div class='form-group col-md-9'>
											<textarea class='form-control' rows='4' id='generos' name='generos' style='text-align: justify;' readonly>$var</textarea>
										</div>
									</div>
									
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='e-mail'>Número de Jogadores: </label>
										</div>
										<div class='form-group col-md-9'>";
											echo "<input type='text' class='form-control' name='nome' value='";
											if($dados['jogadores'] == 'Single Player') echo "Single Player' readonly>'";
											
											if($dados['jogadores'] == 'Multiplayer') echo "Multiplayer' readonly>";
										
										echo "</div>
										</div>
										<div class='form-group col-md-8 spacing'>
											<div class='form-group col-md-2'>										
												<label for='date'>Data de Lançamento:</label>
											</div>
											
										<div class='form-group col-md-9'>
											<input type='date' class='form-control' name='date' value='$dados[dataLanc]' readonly>
										</div>
									</div>
									
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='genero'>Plataformas:</label>
										</div>
										<div class='col-md-9'>";
									
										$genero ="select * from plataformas";		
										$queryg = mysql_query($genero) or die("Deu erro".mysql_error());
										$var = "";
										while($plataformas = mysql_fetch_array($queryg)){
											$var .= $plataformas['nome'].", ";
										}
										echo "<input type='text' class='form-control' name='date' value='$var' readonly> 
										</div>
									</div>
									<div class='col-md-4'></div>
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='nome'>Distribuidora:</label>
										</div>
										<div class='col-md-9'>
											<input type='text' class='form-control' name='distribuidora'  value='$dados[distribuidora]' readonly>
										</div>
									</div>
									<div class='col-md-4' style='text-align: center;'>";
									if(isset($_SESSION['id'])){
										echo "<div class='col-md-12'><a href='addFavoritos.php?id=$id'>
										<button type='button' class='btn btn-default' aria-label='Left Align'>
										  <span class='glyphicon glyphicon-heart' aria-hidden='true'></span> Adicionar aos favoritos
										</button></a>
										</div>";
									}
									echo "
									</div>
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
											<label for='nome'>Criadores:</label>
										</div>
										<div class='col-md-9'>
											<input type='text' class='form-control' name='criadores' data-error='Por favor, informe um criador.'  value='$dados[criadores]' readonly>
										</div>
									</div>
									<div class='col-md-4' style='text-align: center;'>";
									if(isset($_SESSION['id'])){
									echo  "	<div class='col-md-12'><a href='addListaGames.php?id=$id'>
										<button type='button' class='btn btn-default' aria-label='Left Align>
										  <span class='glyphicon glyphicon-star' aria-hidden='true'></span> Adicionar a lista de jogos
										</button></a>
										</div>";
									}
									echo "
									</div>
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-2'>
										  <label for='classificacao'>Classificação DJCTQ:</label>
										</div>
										<div class='col-md-4'>
											<input type='text' class='form-control' name='criadores' value='$dados[classIdade]' readonly>
										</div>
										<div class='form-group col-md-2'>
										  <label for='classificacao'>Classificação IGN:</label>
										</div>
										<div class='col-md-3'>
										  <input type='number' class='form-control' name='ign' min='0' max='10' step='0.1' value='$dados[ign]' readonly>
										</div>
									</div>
									
									<div class='col-md-4'></div>
									<div class='form-group col-md-8 spacing'>
										<div class='form-group col-md-11'>
										  <label for='descricao'>Descricao:</label>
										  <textarea class='form-control' rows='10' id='descricao' name ='descricao' readonly>$dados[descricao]</textarea>
									</div>
								</div>";
								?>
							
				</div>
				<div class="row nopadding">
					<div class="col-md-10"></div>
					<div class="col-md-2" style="padding-bottom: 30px;">
						<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>