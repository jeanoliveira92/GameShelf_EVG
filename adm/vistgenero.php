		<?php include("header.php"); 
		
			if($_SESSION["tipo"] > 1){ 
				//se não há erro, exibe a msg
				echo"<script> alert('Você não possui permissões para esta ação.'); Location: javascript:history.back(); </script>";
			}
						
			if(isset($_GET['id'])){			
				$id = $_GET['id'];
				$sql = "select id from generos";
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
				
				$sql ="select * from generos where id='$id'";	
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
									<h1> Cadastro de Gêneros </h1>
									<div class='row'>
										<div class='form-group col-md-5'>
											<label for='nome'>Gênero:</label>
											<input type='text' class='form-control' value='$dados[nome]' 'name='nome' data-error='Por favor, informe um nome.' readonly>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-5'>
											  <label for='descricao'>Descricao:</label>
											  <textarea class='form-control' rows='10' id='descricao' readonly>$dados[descricao]
											</textarea>
										</div>
									</div>	
								</fieldset>	
								<a href='cadgenero.php?id=$id' class='btn btn-primary'>Editar</a>";
							}
							?>
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
							</form>

						<?php include("footer.php"); ?>
						