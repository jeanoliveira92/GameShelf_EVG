<?php
	// Conexão com o banco de dados 
	include("mysqlconfig.inc");
	
	// Inicia sessões 
	session_start();
	
	$nome = $_POST['nome'];
	$foto = $_FILES["foto"];
	$banner = $_FILES["banner"];
	$msg = "";	$erro = 0;
	
	if (!empty($foto["name"])) {
		
		// Largura máxima em pixels
		$largura = 300;
		
 		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
		
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){  
			$msg  = "Isso não é uma imagem.";
			$erro = 1;
   	 	} 
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			$msg  = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			$erro = 1;
		}
	}
	
	if (!empty($banner["name"])) {
		
		// Largura máxima em pixels
		$altura = 240;
		
 		// Pega as dimensões da imagem
		$dimensoes = getimagesize($banner["tmp_name"]);
		
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $banner["type"])){  
			$msg  = "Isso não é uma imagem.";
			$erro = 1;
   	 	} 
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[1] > $altura) {
			$msg  = "A Altura da imagem não deve ultrapassar ".$altura." pixels";
			$erro = 1;
		}
	}
	
	//variavel que informará a ocorrencia de erros	
	if(isset($_GET["opt"])){
		$opt 	= $_GET["opt"];
		$id 	= $_GET["id"];
		
		$sql = "select id from games";
		$query = mysql_query($sql) or die(mysql_error());

		while($ID = mysql_fetch_array($query)){
			$temp = md5(trim($ID['id']));
			
			if($id == $temp){				
				$id = $ID["id"];
				break;
			}
		}
	}else{
		
		$result = mysql_query("select nome from games");   
		while ($row = mysql_fetch_array($result)){ 
			if($row['nome'] == $nome){
				$erro = 1;
				$msg = "Game já cadastrado!";
				break;
			}
		}
	}

	if($erro == 1){ echo"<script> alert('$msg'); Location: javascript:history.back(); </script>";
	//se não há erro, exibe a msg
	}else{
			$up1 = " ";
			$up2 = " ";
			
			if (!empty($foto["name"])) {
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	 
				// Gera um nome único para a imagem
				$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	 
				// Caminho de onde ficará a imagem
				$caminho_imagem = "../img/gamesCover/" . $nome_imagem;
	 
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
				$up1 = ", capa='$nome_imagem'";
			}else{
				$nome_imagem = "default.JPG";
			}
	
		
			if (!empty($banner["name"])) {
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $banner["name"], $ext2);
	 
				// Gera um nome único para a imagem
				$nome_imagem2 = md5(uniqid(time())) . "." . $ext2[1];
	 
				// Caminho de onde ficará a imagem
				$caminho_imagem2 = "../img/gamesCover/" . $nome_imagem;
	 
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($banner["tmp_name"], $caminho_imagem);	
				
				$up2 = ", banner='$nome_imagem2'";
			}else{
				$nome_imagem2 = "defaultB.JPG";
			}
		
	
		$result = mysql_query("select id from generos");   
		$generos = "";
		
		while ($row = mysql_fetch_array($result)){ 
			$key = "g".$row['id'];
			if(isset($_POST[$key]) && $_POST[$key] == $row['id']){
				$generos .= $row['id'].",";
				
				$gen = mysql_query("select cont from generos where id=$row[id]");
				$gen2 = mysql_fetch_array($gen);
				$valor = $gen2['cont']+1;
				mysql_query("update generos set cont=$valor where id=$row[id]");
			}
		}
		
		$generos = substr($generos,0,-1);
		
		$numPlayers = $_POST['optradio'];
		$data_lanc = $_POST['date'];
		
		$result = mysql_query("select id from plataformas");   
		$plataformas = "";
		
		while ($row = mysql_fetch_array($result)){ 
			$key = "p".$row['id'];
			if(isset($_POST[$key]) && $_POST[$key] == $row['id']){
				$plataformas .= $row['id'].",";
				
				$gen = mysql_query("select cont from plataformas where id=$row[id]");
				$gen2 = mysql_fetch_array($gen);
				$valor = $gen2['cont']+1;
				mysql_query("update plataformas set cont=$valor where id=$row[id]");
			}
		}
		
		$plataformas = substr($plataformas,0,-1);
		
		$distribuidora 	= $_POST['distribuidora'];
		$criadores 		= $_POST['criadores'];
		$classIdade 	= $_POST['classIdade'];
		$ign 			= $_POST['ign'];
		$descricao 		= $_POST['descricao'];
		
	
		//aqui podemos realizar o tratamento das informações. ex: gravando em um arquivo ou banco de dados
		if(isset($_GET["opt"])){
			$sql = "update games set nome='$nome', generos='$generos', jogadores='$numPlayers', dataLanc='$data_lanc', plataformas='$plataformas', distribuidora='$distribuidora', criadores='$criadores', classIdade='$classIdade', ign='$ign', descricao='$descricao' $up1 $up2  where id='$id'";
			$msg = "Cadastro atualizado com sucesso ";
		}else{
			$sql = "insert into games values('NULL','$nome','$generos', '$numPlayers', '$data_lanc', '$plataformas', '$distribuidora', '$criadores', '$classIdade', '$ign', '$descricao', 'NULL', '$nome_imagem', '$nome_imagem2')";
			$msg = "Cadastro realizado com sucesso";
		}

		$result_id = mysql_query($sql) or die("<script> alert('Erro no banco de dados!'); Location: javascript:history.back(); </script>"); 
		
		
		echo"<script> alert('$msg'); Location: location.href='main.php';</script>";
	}
?>