		<?php include("header.php"); 
			
			if(isset($_GET['id'])){			
				$id = $_GET['id'];

				$sql = "select id from assinantes";
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
				
				$sql ="select * from assinantes where id='$id'";		
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
									<h1> $dados[nome] </h1>
									<div class='row'>
										<div class='form-group col-md-12'>
											<div class='form-group col-md-2'>
												<label for='e-mail'>E-mail:</label>
											</div>
											<div class='form-group col-md-6'>
												<input type='email' class='form-control'  name='email' value='$dados[email]' readonly>
											</div>
										</div>
									</div>
								</fieldset>			
								<a href='cadAssinante.php?id=$id' class='btn btn-primary	'>Editar</a>";
							}else{
								echo "<div class='row'>
									<label for='e-mail'>Dado de entrada Inválido</label>
								</div>";
							}
							?>
							
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>

						<?php include("footer.php"); ?>
						