<?php include("header.php"); 

	//if(isset($_SESSION['id'])) 
		//echo "<script>Location: location.href='index.php';</script>";	
?>			
		<div class="row nopadding content page1">
			<div class="col-md-12">	
				<div class="row nopadding">						
					<div id="top" class="row nopadding">
							<h2 style="margin-top: 50px;">Meus Games</h2>
					</div> <!-- /#top -->
				</div>
				<div class="row nopadding">
					<?php
								
					$inicio = 0;
					$limite = 8	; // NUMERO DE ELEMENTOS
					$pag = 1;
					
					$sqlUser = "";
												
					if(isset($_GET['pag'])){
						if($_GET['pag'] == '' || $_GET['pag'] != 0 && !is_nan($_GET['pag']) ){
							$pag = $_GET['pag'];
							$pag = filter_var($pag, FILTER_VALIDATE_INT);
						}
					}

					$inicio = ($pag * $limite) - $limite;
							
					echo "
					<hr />
					<div id='list' class='row nopadding'>
						<table class='table table-hover'>
							<thead>
								<tr>
									<th style='width: 60%'>Nome</th>
									<th style='width: 30%'>Operações</th>
								</tr>
							</thead>
							<tbody>";
							
							$result = mysql_query("select * from lista where userId=$_SESSION[id] LIMIT $inicio, $limite"); 
/*
							$games = "";
							
							if($result != null){
								$games = "where id in ('";
								while ($row = mysql_fetch_array($result)){
									$games .= $row['gamesId']."','";
								}
								
								$games = substr($games,0,-2);
								$games .= ") ";
							}
							//echo $games;
							*/

							
							mysql_data_seek($result, 1);
							while($row = mysql_fetch_array($result)){
															
								echo   "<tr>
											<td>";
											
											
											$sql = "select nome from games where id='$row[gamesId]'";
											$row2 = mysql_fetch_array(mysql_query($sql));
											
											echo "$row2[nome]</td>
											<td class='actions'> 
											<a class='btn btn-success btn-xs' href='game.php?id=$row[gamesId]'>Visualizar</a>
											<a class='btn btn-danger btn-xs'  href='removerLista.php?id=$row[gamesId]'"; ?> onclick="return confirm('Deseja remover realmente?')">Excluir</a>
								<?php
								echo "</td>";
								echo "</tr>";
								
							}
								echo 
								"</tbody>
						</table>
					</div> <!-- /#list -->
					<div id='bottom' class='row'>
						<div class='col-md-8 col-md-offset-3'>			 
							<ul class='pagination'>";
								
							$sql = "select * from lista where userId=$_SESSION[id]";
							$query = mysql_query($sql);
							$total = mysql_num_rows($query);

							// O comando ceil() arredonda "para cima" o valor
							$pags = ceil($total/$limite);
							
							// Número máximos de botões de paginação
							$max_links = 3;
							
							echo 
							"<nav><ul class='pagination pagination-sm'>	
									<li>
										<a ";
										
							if($pag != 1){
								echo "href='lista.php?pag=1'";
							}

							echo " aria-label='Previous'><span aria-hidden='true'>&laquo;</span> Início</a></li>
								<li><a ";
									
							if($pag != 1){
								echo "href='lista.php?pag=".($pag-1)."'";
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
									echo "<li><a href='lista.php?pag=$i'>$i</a></li>";		
								}
							}
							
							$fim = 0;
							
							echo "<li class='active'><a>$pag</a></li>";
							
							for($i = $pag+1; 	$i <= $pag+$max_links+($max_links-$ini); $i++) {
								// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
								if($i > $pags) { 
								} else{
									$fim++;
									echo "<li><a href='lista.php?pag=$i'>$i</a></li> "; 
								}
							}
							
							echo "<li class='next'><a ";
							if($pag < $pags){
								echo "href='lista.php?pag=".($pag+1)."'";
							}

							echo " aria-label='Next' rel='next'>Próximo &raquo;</a></li>";
							echo "<li class='next'><a ";
							
							if($pag < $pags){
								echo "href='lista.php?pag=".$pags."'";
							}	
							
							echo "aria-label='Next' rel='end'>Fim
									<span aria-hidden='true'>&raquo;</span></a>
									</li>
								</ul>
							<nav><!-- /.pagination -->	
						</div>
					</div> <!-- /#bottom -->
				</div> <!-- /#bottom -->";
				?>		
		</div>
		
	</div>
<?php include("footer.php"); ?>