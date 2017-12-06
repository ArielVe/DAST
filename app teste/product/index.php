<?php
ini_set ('odbc.defaultlrl', 9000000);//muda configuração do PHP para trabalhar com imagens no DB
include('../db/bancodedados.php');
include('../auth/controle.php');
//Funcionalidade Gravar Cadastro

if(isset($_POST['btnGravar'])){
	unset($_GET['cadastrar']);
	if(	!empty($_POST['nomeProduto']) &&
		!empty($_POST['precProduto'])){
		
		$_POST['ativoProduto'] = 
			isset($_POST['ativoProduto']) ? true : false;
			
		//Imagem 

		//Grava a imagem em uma variável 
		$file = fopen($_FILES['imagem']['tmp_name'],'rb');

		$fileParaDB = fread($file, filesize($_FILES['imagem']['tmp_name']));

		fclose($file);
		//FIM Grava a imagem em uma variável 
		
		$stmt = odbc_prepare($db, "	INSERT INTO Produto
										(idCategoria, 
										nomeProduto,
										precProduto,
										ativoProduto,
										descProduto,
										descontoPromo,
										idUsuario,
										qtdMinEstoque,
										imagem)
									VALUES
										(?,?,?,?,?,?,?,?,?)");
		if(odbc_execute($stmt, array(	$_POST['idCategoria'],
										$_POST['nomeProduto'],
										$_POST['precProduto'],
										$_POST['ativoProduto'],
										$_POST['descProduto'],
										$_POST['descontoPromo'],
										$_POST['idUsuario'],
										$_POST['qtdMinEstoque'],
										$fileParaDB))){
			$msg = 'Produto gravado com sucesso!';			
		}else{
			$erro = 'Erro ao gravar Produto';
		}								
							
	}else{
		
		$erro = 'Os campos: Nome e Pre&ccedil;o 
					s&atilde;o obrigat&oacute;rios';
		
	}
}
//FIM Funcionalidade Gravar Cadastro

//Funcionalidade Editar Cadastro
if(isset($_POST['btnAtualizar'])){
	unset($_GET['editar']);
	if(	!empty($_POST['nomeProduto']) &&
		!empty($_POST['precProduto'])){
		
		$_POST['ativoProduto'] = 
			isset($_POST['ativoProduto']) ? true : false;

		$file = fopen($_FILES['imagem']['tmp_name'],'rb');

		$fileParaDB = fread($file, filesize($_FILES['imagem']['tmp_name']));

		fclose($file);
		
		$stmt = odbc_prepare($db, "	UPDATE 
										Produto
									SET 
										idCategoria = ?,
										nomeProduto = ?,
										precProduto = ?,
										ativoProduto = ?,
										descProduto = ?,
										descontoPromo = ?,
										idUsuario = ?,
										qtdMinEstoque = ?,
										imagem = ?
									WHERE
										idProduto = ?");
									
		if(odbc_execute($stmt, array(	$_POST['idCategoria'],
										$_POST['nomeProduto'],
										$_POST['precProduto'],
										$_POST['ativoProduto'],
										$_POST['descProduto'],
										$_POST['descontoPromo'],
										$_POST['idUsuario'],
										$_POST['qtdMinEstoque'],
										$fileParaDB,
										$_POST['idProduto']))){
			$msg = 'Produto atualizado com sucesso!';			
		}else{
			$erro = 'Erro ao atualizar Produto';
		}								
							
	}else{
		
		$erro = 'Os campos: Nome e Pre&ccedil;o 
					s&atilde;o obrigat&oacute;rios';
		
	}
}
//FIM Funcionalidade Editar Cadastro

//Funcionalidade Excluir
if(isset($_GET['excluir'])){
	if(is_numeric($_GET['excluir'])){
		
		if(odbc_exec($db, "	DELETE FROM 
								Produto 
							WHERE
								idProduto = {$_GET['excluir']}")){
			$msg = 'Produto removido com sucesso';						
		}else{
			$erro = 'Erro ao excluir Produto';
		}
		
	}else{
		$erro = 'C&oacute;digo inv&aacute;lido';
	}
}
//FIM Funcionalidade Excluir

//Campo de busca
$buscar = $_GET['buscar'];
if(isset($buscar)){
	$q = odbc_exec($db, "	SELECT 		idProduto,
										idCategoria, 
										nomeProduto,
										precProduto, 
										ativoProduto, 
										descProduto, 
										descontoPromo,
										idUsuario,
										qtdMinEstoque, 
										imagem
							FROM 		Produto 
							WHERE nomeProduto LIKE '%$buscar%' OR descProduto LIKE '%$buscar%' ");	

		while($r = odbc_fetch_array($q)){
	
			$produtos[$r['idProduto']] = $r;
	
		}
		unset($_GET['buscar']);
}else{
//Funcionalidade Listar
	$q = odbc_exec($db, '	SELECT 	idProduto,
									idCategoria, 
									nomeProduto,
									precProduto,
									ativoProduto, 
									descProduto, 
									descontoPromo,
									idUsuario,
									qtdMinEstoque, 
									imagem
							FROM 
									Produto');

	while($r = odbc_fetch_array($q)){
		
		$produtos[$r['idProduto']] = $r;
		
	}  

	//FIM Funcionalidade Listar
}

if(isset($_GET['cadastrar'])){//FORM Cadastrar

	include('template_cadastrar.php');
	
}elseif(isset($_GET['editar'])){//FORM Editar

	if(is_numeric($_GET['editar'])){
		$q = odbc_exec($db, "	SELECT 	idProduto,
										idCategoria, 
										nomeProduto,
										precProduto, 
										ativoProduto, 
										descProduto, 
										descontoPromo,
										idUsuario,
										qtdMinEstoque, 
										imagem
								FROM 	Produto 
								WHERE 	idProduto = {$_GET['editar']}");
		$dados_produto = odbc_fetch_array($q);
	}else{
		$erro = 'Código inválido';
	}

	include('template_editar.php');
	
}else{//FORM Listar

	include('template.php');
	
}

?>