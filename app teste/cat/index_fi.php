<?php
include('../db/bancodedados.php');
include('../auth/controle.php');

//Funcionalidade Gravar Categoria
if(isset($_POST['btnGravar'])){
	unset($_GET['cadastrar']);
	if(	!empty($_POST['nomeCategoria'])){
		
		$stmt = odbc_prepare($db, "	INSERT INTO Categoria
									(nomeCategoria,
									descCategoria)
									VALUES
									(?,?)");
		if(odbc_execute($stmt, array(	$_POST['nomeCategoria'],
										$_POST['descCategoria']))){
			$msg = 'Categoria gravada com sucesso!';			
		}else{
			$erro = 'Erro ao gravar Categoria';
		}								
							
	}else{
		
		$erro = 'O campo: Nome 
					&eacute; obrigat&oacute;rio';
		
	}
}
//FIM Funcionalidade Gravar Categoria

//Funcionalidade Editar Categoria
if(isset($_POST['btnAtualizar'])){
	unset($_GET['editar']);
	if(	!empty($_POST['nomeCategoria'])){
		
		$stmt = odbc_prepare($db, "	UPDATE 
										Categoria
									SET 
										nomeCategoria = ?,
										descCategoria = ?
									WHERE
										idCategoria = ?");
									
		if(odbc_execute($stmt, array(	$_POST['nomeCategoria'],
										$_POST['descCategoria'],
										$_POST['idCategoria']))){
			$msg = 'Categoria atualizada com sucesso!';			
		}else{
			$erro = 'Erro ao atualizar Categoria';
		}								
							
	}else{
		
		$erro = 'O campo: Nome 
					&eacute; obrigat&oacute;rio';
		
	}
}
//FIM Funcionalidade Editar Categoria


/*$category_sql = odbc_prepare($db, "
	DELETE FROM Categoria
	WHERE idCategoria = ?"
);

$product = odbc_exec($db, "
	SELECT idProduto FROM Produto
	WHERE idCategoria = $category_id"
);*/

//Funcionalidade Excluir
if(isset($_GET['excluir'])){
	$categoria_id = $_GET['excluir'];
	$tem_produto = odbc_exec($db, "
		SELECT idProduto FROM Produto
		WHERE idCategoria = $categoria_id"
	);
	if(odbc_num_rows($tem_produto)){
		$erro = 'Essa categoria não pode ser excluida, existre produtos relacionados na mesma!';
	}else{
		if(is_numeric($_GET['excluir'])){
			
			if(odbc_exec($db, "	DELETE FROM 
									Categoria 
								WHERE
									idCategoria = {$_GET['excluir']}")){
				$msg = 'Categoria excluida com sucesso';						
			}else{
				$erro = 'Erro ao excluir Categoria';
			}
			
		}else{
			$erro = 'C&oacute;digo inv&aacute;lido';
		}
	}
}
//FIM Funcionalidade Excluir
//Funcionalidade Listar
$q = odbc_exec($db, '	SELECT 	idCategoria, nomeCategoria,
								descCategoria
						FROM 
								Categoria');

while($r = odbc_fetch_array($q)){
	
	$categorias[$r['idCategoria']] = $r;
	
}
//FIM Funcionalidade Listar

if(isset($_GET['cadastrar'])){//FORM Cadastrar

	include('template_cadastrar.php');
	
}elseif(isset($_GET['editar'])){//FORM Editar

	if(is_numeric($_GET['editar'])){
		$q = odbc_exec($db, "	SELECT 	idCategoria, nomeCategoria,
										descCategoria
								FROM Categoria 
								WHERE idCategoria = {$_GET['editar']}");
		$dados_categoria = odbc_fetch_array($q);
	}else{
		$erro = 'Código inválido';
	}

	include('template_editar.php');
	
}else{//FORM Listar

	include('template.php');
	
}
?>