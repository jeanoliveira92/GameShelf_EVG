<?php 
		
			include("mysqlconfig.inc");
			include("header.php"); 
			?>

		<script type="text/javascript">
		google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
	//GENEROS
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ]
		<?php
				$result = mysql_query("select nome, cont from generos");				
				while ($row = mysql_fetch_array($result)){ 
					echo ",['$row[nome]', $row[cont], '#76A7FA']\n";
					
				}
		?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Generos Cadastrados",
        width: 400,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
	  
	  // PLATAFORMAS
	  var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ]
		<?php
				$result = mysql_query("select nome, cont from plataformas");				
				while ($row = mysql_fetch_array($result)){ 
					echo ",['$row[nome]', $row[cont], '#76A7FA']\n";
					
				}
		?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Plataformas Cadastradas",
        width: 400,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
      chart.draw(view, options);
  }
  </script>

		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
				<?php include("left-sidebar.php"); ?>
					<div class="col-md-9">
						<div class="col-md-12">
							<div id="top" class="row">
									<h2>Relatorio Geral de Games</h2>
							</div>
						<div id="top" class="row">
							 </div> <!-- /#top -->
						 
							 <?php
							
								$inicio = 0;
								$limite = 8	; // NUMERO DE ELEMENTOS
								$pag = 1;
								$nome = "";
																
								// pegar a pagina atual
								
									
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
										<hr />
											<div id='list' class='row'>
												<table class='table table-hover'>
													<thead>
														<tr>
															<th>ID</th>
															<th>Nome</th>
															<th>Genero</th>
															<th>Plataforma</th>
														</tr>
													</thead>
													<tbody>";
										
									$result = mysql_query("select * from games".$sqlUser." ORDER BY nome");  
									$cont = 0;									
									while ($row = mysql_fetch_array($result))   
									{ 
										$cont++;
										echo "<tr><td>".$row['id']."</td>";
										echo "<td>".$row['nome']."</td>";
										echo "<td>";
																												
										if($row['generos'] != ""){
										
											$vec = explode(",", $row["generos"]);
											
											$sqlg = "select id, nome from generos where ";
											 
											foreach ($vec as $var){
												$sqlg .= "id = ".$var." or ";
											}
											
											$sqlg = substr($sqlg,0,-4);
											$gen = mysql_query($sqlg);
											$str = "";
											
											while ($row2 = mysql_fetch_array($gen)){
												$str .= $row2['nome'].", ";
											}
										}
										
										echo substr($str,0,-2);
										echo "</td>";			
										echo "<td>";
																												
										if($row['plataformas'] != ""){
										
											$vec = explode(",", $row["plataformas"]);
											
											$sqlg = "select id, nome from plataformas where ";
											 
											foreach ($vec as $var){
												$sqlg .= "id = ".$var." or ";
											}
											
											$sqlg = substr($sqlg,0,-4);
											$gen = mysql_query($sqlg);
											$str = "";
											
											while ($row2 = mysql_fetch_array($gen)){
												$str .= $row2['nome'].", ";
											}
										}
										
										echo substr($str,0,-2);

										
										echo "</td>";			
										echo "</tr>";
									}
												echo "</tbody>
												</table>";	echo "</div> <!-- /#list -->
										 <div id='bottom' class='row'>
												<div class='col-md-10 col-md-offset-2'>
												<ul class='pagination'>";
													
												$sql = "SELECT id FROM games".$sqlUser;
												$query = mysql_query($sql);
												$total = mysql_num_rows($query); 
												
												// O comando ceil() arredonda "para cima" o valor
												$pags = ceil($total/$limite);
												
												// Número máximos de botões de paginação
												$max_links = 3;
												setlocale (LC_ALL, 'pt_BR');
												echo "
											</div>
										</div> <!-- /#bottom -->
										<div class='row'><h4>".date('j F Y g:i A')."</h4></div>
										<div class='row'><h4>JOGOS CADASTRADOS: $cont</h4></div>";?>
										<div class="row">
											<div class="col-md-6"><div id="columnchart_values"></div></div>
											<div class="col-md-6" ><div id="columnchart_values2"></div></div>
										</div>
										
						</div> <!-- /#bottom -->
								
					<script language="javascript">
					function excluir(){
							var resp = confirm('Deseja realmente remover?');
							if(resp){
								Location: location.href='main.php'; 
							}	
					}
				</script>					
		<?php include("footer.php"); ?>