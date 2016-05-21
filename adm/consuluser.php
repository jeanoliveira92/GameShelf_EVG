		<?php 
		
			include("mysqlconfig.inc");
			
			include("header.php"); 
			
			if($_SESSION["tipo"] != 1){ 
				//Se não possuir permissão, será redirecionado de volta
				echo"<script> alert('Você não possui permissões para esta ação.'); Location: javascript:history.back(); </script>";
			}
		?>
		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
				<?php include("left-sidebar.php"); ?>
					<div class="col-md-9">
						<div class="col-md-12">
							<div id="top" class="row">
								<div class="col-md-4">
									<h2>Consultar Usuários</h2>
								</div>
								<div class="col-md-6">
									<form class="form" id="userlistform" name="userlistform" action="consuluser.php" method="get">
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
									<a href="caduser.php" class="btn btn-primary pull-right h2">Novo Usuário</a>
								</div>
							 </div> <!-- /#top -->
						 
							 <hr />
							 <div id="list" class="row">
							 
							 </div> <!-- /#list -->
						 
							 <div id="bottom" class="row">
							 
							 </div> <!-- /#bottom -->
							<div class="col-md-12">
							</div>
							<?php
							
								$inicio = 0;
								$limite = 10	; // NUMERO DE ELEMENTOS
								$pag = 1;
																
								// pegar a pagina atual
								
								if(isset($_GET['nome'])){
									
									$sqlUser = "";
									
									if(!empty($_GET['nome'])){
										$temp = trim($_GET['nome']);
										$sqlUser = " WHERE nome LIKE '%$temp%'";
									}
									
									if(isset($_GET['pag'])){
										if($_GET['pag'] == '' || $_GET['pag'] != 0 && !is_nan($_GET['pag']) ){
											$pag = $_GET['pag'];
											$pag = filter_var($pag, FILTER_VALIDATE_INT);
										}
									}
									
									$sql = "SELECT count(id) FROM usuarios".$sqlUser;
									$query = mysql_query($sql);
									$total = mysql_result($query, 0); 
									
									$inicio = ($pag - 1) * $limite; 
									
									echo "<table class='table table-hover'>
										<thead>
											<tr>
												<th>ID</th>
												<th>Nome</th>
												<th>E-mail</th>
												<th>Tipo</th>
												<th class='actions'>Tipo</th>
											</tr>
										</thead>
										<tbody>";
										
											$result = mysql_query("select * from usuarios".$sqlUser." LIMIT $inicio, $limite");   
											while ($row = mysql_fetch_array($result))   
											{ 
												echo "<tr><td>".$row['id']."</td>";
												echo "<td>".$row['nome']."</td>";
												echo "<td>".$row['email']."</td>";													
												if($row['tipo'] == 1){
													echo "<td>Administrador</td>";												
												}else{
													echo "<td>Moderador</td>";
												}
												
												echo "<td class='actions'>";
												echo "	<a class='btn btn-success btn-xs' href='view.html'>Visualizar</a>";
												echo "	<a class='btn btn-warning btn-xs' href='edit.html'>Editar</a>";
												echo "	<a class='btn btn-danger btn-xs'  href='#' data-toggle='modal' data-target='#delete-modal'>Excluir</a>";
												echo "</td>";
												echo "</tr>";
											}
										echo "</tbody>
										</table>";
								}
								?>
								
		<?php include("footer.php"); ?>