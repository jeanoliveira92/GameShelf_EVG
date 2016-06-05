		<?php include("header.php"); 
		
			if($_SESSION["tipo"] > 1){ 
				//se não há erro, exibe a msg
				echo"<script> alert('Você não possui permissões para esta ação.'); Location: javascript:history.back(); </script>";
			}
			
			if(isset($_GET['id'])){			
				$id = $_GET['id'];

				$sql = "select id from plataformas";
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
				
				$sql ="select * from plataformas where id='$id'";		
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
							<form method="post" data-toggle="validator"  id="cadastraUsuario" name="cadastraUsuario" 
							<?php	if(isset($id)){	echo "action='cadastraPlataforma.php?opt=update&id=$_GET[id]'";}
									else{			echo "action='cadastraPlataforma.php'";}						
							?>>
							<?php
							if(isset($id)){
								echo "
								<fieldset class='form-group'>
									<h1> Cadastro de Plataformas </h1>
									<div class='row'>
										<div class='form-group col-md-5'>
											<label for='nome'>Plataforma:</label>
											<input type='text' class='form-control' name='nome' value='$dados[nome]'>
										</div>
										<div class='form-group col-md-5'>
											  <label for='descricao'>Descricao:</label>
											  <textarea class='form-control' rows='10' id='descricao' name ='descricao' required>$dados[descricao]
											</textarea>
										</div>
									</div>	
								</fieldset>		
								<button type='submit' class='btn btn-primary'>Alterar</button>";
							}else{
								echo "<fieldset class='form-group'>
									<h1> Cadastro de Plataforma </h1>
									<div class='row'>
										<div class='form-group col-md-5'>
											<label for='nome'>Plataforma:</label>
											<input type='text' class='form-control' name='nome' data-error='Por favor, informe um nome.' required>
												<div class='help-block with-errors'></div>
										</div>
										<div class='form-group col-md-5'>
											  <label for='descricao'>Descricao:</label>
											  <textarea class='form-control' rows='10' name ='descricao' id='descricao' required>
											</textarea>
										</div>
									</div>	
								</fieldset>			
								<button type='submit' class='btn btn-primary'>Salvar</button>";
								
							}
							?>
								<a class="btn btn-default" onclick="Location: javascript:history.back();">Voltar</a>
							</form>

						<?php include("footer.php"); ?>
						