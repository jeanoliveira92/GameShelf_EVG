<?php include("header.php"); 
		///if(isset($_SESSION['id'])) 
			//echo "<script>Location: location.href='index.php';</script>";	
?>		
		
		<div class="row nopadding">
			<!-- PART II -->
			<div class="col-md-12 content page1">
				<div class="row page">
					<div class="col-md-12">
						 <?php
								$inicio = 0;
								$limite = 9	; // NUMERO DE ELEMENTOS
								$pag = 1;
								$nome = "";
																
								// pegar a pagina atual									
									$sqlUser = "";
									if(isset($_GET['nome'])){
										if(!empty($_GET['nome'])){
											$nome = trim($_GET['nome']);
											$sqlUser = " where nome LIKE '%$nome%'";
										}else
											$nome = "";
									}
									
									if(isset($_GET['pag'])){
										if($_GET['pag'] == '' || $_GET['pag'] != 0 && !is_nan($_GET['pag']) ){
											$pag = $_GET['pag'];
											$pag = filter_var($pag, FILTER_VALIDATE_INT);
										}
									}

									$inicio = ($pag * $limite) - $limite;
									
									echo "<div id='list' class='row'>";
										
									$result = mysql_query("select * from games".$sqlUser." ORDER BY nome LIMIT $inicio, $limite");   
									
									while ($row = mysql_fetch_array($result)){
										
								echo " <div class='col-sm-6 col-md-3'>
											<div class='thumbnail'>
											  <a href='game.php?id=$row[id]'><h3 class='nopadding'>".$row['nome']."</h3>
											  <img src='img/gamesCover/assassins.jpg' alt='...'></a>
											  <div class='caption'>
												<p>".substr($row['descricao'], 0, 146)."...</p>";
												echo " </div>
											</div>
										  </div>";										
									}
										echo "</div> <!-- /#list -->
										 <div id='bottom' class='row'>
												<div class='col-md-10 col-md-offset-2'>
									
									<div class='row'>	
										<div class='col-md-12>
										<ul class='pagination'>";
											
										$sql = "SELECT id FROM games".$sqlUser;
										$query = mysql_query($sql);
										$total = mysql_num_rows($query); 
										
										// O comando ceil() arredonda "para cima" o valor
										$pags = ceil($total/$limite);
										
										// Número máximos de botões de paginação
										$max_links = 3;
										
										echo "<nav><ul class='pagination pagination-sm'>	
												<li>
													<a ";
													
										if($pag != 1){
											echo "href='consulgenero.php?pag=1&nome=$nome'";
										}

										echo " aria-label='Previous'><span aria-hidden='true'>&laquo;</span> Início</a></li>
											<li><a ";
												
										if($pag != 1){
											echo "href='consulgenero.php?pag=".($pag-1)."&nome=$nome'";
										}
										
										echo " aria-label='Previous'> 
													<span aria-hidden='true'>&laquo;</span> Anterior</a>
												 </li>";
										
										$ini = 0;
										$fim = 0;
										
										for($i = $pag+1; $i <= $pag+$max_links; $i++) {
											if($i > $pags) {  
											}else { 
												$fim++;
											} 
										}
										
										//for($i = $pag-$max_links; $i <= $pag-1+($max_links-$fim); $i++) { 
										for($i = $pag-($max_links+($max_links-$fim)); $i <= $pag-1; $i++) { 
											if($i <=0) { //faz nada 
											}else{
												$ini++;
												echo "<li><a href='consulgenero.php?pag=$i&nome=$nome'>$i</a></li>";		
											}
										}
										
										$fim = 0;
										
										echo "<li class='active'><a>$pag</a></li>";
										
										for($i = $pag+1; 	$i <= $pag+$max_links+($max_links-$ini); $i++) {
											// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
											if($i > $pags) { 
											} else{
												$fim++;
												echo "<li><a href='consulgenero.php?pag=$i&nome=$nome'>$i</a></li> "; 
											}
										}
										
										echo "<li class='next'><a ";
										if($pag < $pags){
											echo "href='consulgenero.php?pag=".($pag+1)."&nome=$nome'";
										}

										echo " aria-label='Next' rel='next'>Próximo &raquo;</a></li>";
										echo "<li class='next'><a ";
										
										if($pag < $pags){
											echo "href='consulgenero.php?pag=".$pags."&nome=$nome'";
										}	
										
										echo "aria-label='Next' rel='end'>Fim
												<span aria-hidden='true'>&raquo;</span></a>
												</li>
												</ul>

										</div>
											<nav><!-- /.pagination -->
										</div>
								</div>
							</div> <!-- /#bottom -->
						</div> <!-- /#bottom -->";
								?>
					
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php"); ?>