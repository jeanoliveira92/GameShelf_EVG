<?php 
		
			include("mysqlconfig.inc");
			include("header.php"); 

		?>
		
		<!-- Modal -->
		<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modalLabel">Excluir Item</h4>
			  </div>
			  <div class="modal-body">
				Deseja realmente excluir este item?
			  </div>
			  <div class="modal-footer">
				<a href='excluiUsuario.php?id=' class='btn btn-primary'>Sim</a>
				<a class='btn btn-default' data-dismiss="modal">Não</a>
			  </div>
			</div>
		  </div>
		</div> <!-- /.modal -->
		
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
				<?php include("left-sidebar.php"); ?>
					<div class="col-md-9">
						<div class="col-md-12">
							<div id="top" class="row">
								<div class="col-md-4">
									<h2>Consultar Plataformas</h2>
								</div>
								<div class="col-md-6">
									<form class="form" id="userlistform" name="userlistform" action="consulplataforma.php" method="get">
										<div class="input-group h2">
											<input name="nome" class="form-control" id="search" type="text" placeholder="Pesquisar Itens">
											<span class="input-group-btn">
												<button class="btn btn-primary" type="submit">
													<span class="glyphicon glyphicon-search"></span>
												</button>
											</span>
										</div>
									</form>
								</div>
								<div class="col-md-2">
									<a href="cadplataforma.php" class="btn btn-primary pull-right h2">Novo Genero</a>
								</div>
							 </div> <!-- /#top -->
						 
							 <?php
							
								$inicio = 0;
								$limite = 9	; // NUMERO DE ELEMENTOS
								$pag = 1;
								$nome = "";
																
								// pegar a pagina atual
								
								if(isset($_GET['nome'])){
									
									$sqlUser = "";
									
									if(!empty($_GET['nome'])){
										$nome = trim($_GET['nome']);
										$sqlUser = " where nome LIKE '%$nome%'";
									}
									
									if(isset($_GET['pag'])){
										if($_GET['pag'] == '' || $_GET['pag'] != 0 && !is_nan($_GET['pag']) ){
											$pag = $_GET['pag'];
											$pag = filter_var($pag, FILTER_VALIDATE_INT);
										}
									}

									$inicio = ($pag * $limite) - $limite;
									
									echo "
										<hr /><div id='list' class='row'>";
										
									$result = mysql_query("select * from plataformas".$sqlUser." ORDER BY nome LIMIT $inicio, $limite");   
									while ($row = mysql_fetch_array($result))   
									{ 
										echo "
										<div class='col-sm-6 col-md-4  selectorClass'>
											<div class='thumbnail' >
											  <div class='caption'>
												<h3>".$row['nome']."</h3>
												<p>".$row['descricao']."</p>";
												echo "	<a class='btn btn-success btn-xs' href='vistplataforma.php?id=".$row['id']."'>Visualizar</a>";
												echo "	<a class='btn btn-warning btn-xs' href='cadplataforma.php?id=".$row['id']."'>Editar</a>";
												//echo "	<a class='btn btn-danger btn-xs'  href='#' data-toggle='modal' data-target='#delete-modal'>Excluir</a>";
												//echo "	<a class='btn btn-danger btn-xs'  href='excluigenero.php?id=".$row['id']."' onclick='return confirm('Deseja remover realmente?')'>Excluir</a>";
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
											
										$sql = "SELECT id FROM plataformas".$sqlUser;
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
											echo "href='consulplataforma.php?pag=1&nome=$nome'";
										}

										echo " aria-label='Previous'><span aria-hidden='true'>&laquo;</span> Início</a></li>
											<li><a ";
												
										if($pag != 1){
											echo "href='consulplataforma.php?pag=".($pag-1)."&nome=$nome'";
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
												echo "<li><a href='consulplataforma.php?pag=$i&nome=$nome'>$i</a></li>";		
											}
										}
										
										$fim = 0;
										
										echo "<li class='active'><a>$pag</a></li>";
										
										for($i = $pag+1; 	$i <= $pag+$max_links+($max_links-$ini); $i++) {
											// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
											if($i > $pags) { 
											} else{
												$fim++;
												echo "<li><a href='consulplataforma.php?pag=$i&nome=$nome'>$i</a></li> "; 
											}
										}
										
										echo "<li class='next'><a ";
										if($pag < $pags){
											echo "href='consulplataforma.php?pag=".($pag+1)."&nome=$nome'";
										}

										echo " aria-label='Next' rel='next'>Próximo &raquo;</a></li>";
										echo "<li class='next'><a ";
										
										if($pag < $pags){
											echo "href='consulplataforma.php?pag=".$pags."&nome=$nome'";
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
								}
								?>
					<script language="javascript">
					function excluir(){
							var resp = confirm('Deseja realmente remover?');
							if(resp){
								Location: location.href='main.php'; 
							}	
					}
					
					$(document).ready(function () {
					  var container = document.querySelector('#list');
					  var msnry = new Masonry(container, {
									itemSelector: '.selectorClass'
								  });
					});
				</script>					
		<?php include("footer.php"); ?>